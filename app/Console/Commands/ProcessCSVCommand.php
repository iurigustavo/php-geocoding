<?php

    namespace App\Console\Commands;

    use App\Actions\CEP\SearchCep;
    use App\Actions\Client\CreateClient;
    use App\Actions\Client\CreateClientAddress;
    use App\Actions\Client\UpdateClient;
    use App\Actions\Client\UpdateClientAddress;
    use App\Http\Helpers\DateUtils;
    use App\Models\Client;
    use App\Models\ClientAddress;
    use App\Models\Import;
    use Exception;
    use Illuminate\Console\Command;
    use Illuminate\Foundation\Bus\DispatchesJobs;
    use stdClass;
    use Str;

    class ProcessCSVCommand extends Command
    {
        use DispatchesJobs;
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'csv:process';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Process an uploaded CSV file';

        /**
         * Create a new command instance.
         *
         * @return void
         */
        public function __construct()
        {
            parent::__construct();
        }

        public function handle()
        {
            try {
                /** @var Import[]|\Illuminate\Database\Eloquent\Collection $imports */
                $imports = Import::notProcessed()->get();
                if (count($imports) < 1) {
                    $this->info('No files found');
                    return;
                }
                //Process the files:
                $imports->map(function ($import) {
                    $file        = fopen("storage/app/".$import->path, "r");
                    $currentLine = 0;
                    $total_rows  = 0;
                    while (!feof($file)) {
                        $line = fgets($file);
                        if (strlen($line) > 0) {
                            $currentLine++;
                            if (Str::startsWith($line, 'nome;email')) {
                                $this->alert("Linha {$currentLine} formato header, pulando...");
                                continue;
                            }
                            $this->info("Processando linha: {$currentLine}");
                            $endereco = explode(';', $line);
                            if (sizeof($endereco) != 6) {
                                $this->alert("Linha {$currentLine} Formato inválido");
                                continue;
                            }

                            $linha             = new stdClass();
                            $linha->zipcode    = trim(preg_replace('/\s+/', ' ', $endereco[5]));
                            $linha->name       = $endereco[0];
                            $linha->email      = $endereco[1];
                            $linha->birth_date = DateUtils::StringParaData($endereco[2]);
                            $linha->cpf        = $endereco[3];


                            /** @var \App\Classes\Cep $cep */
                            $cep = $this->dispatchNow(new SearchCep($linha->zipcode));
                            if (!$cep) {
                                $this->info('CEP inválido');
                                continue;
                            }

                            // MONTA ENDEREÇO
                            preg_match_all("/([^,]+)/", $endereco[4], $matches);
                            $endereco             = new stdClass();
                            $endereco->logradouro = $matches[0][0];

                            preg_match_all(" /^[^\d]*(\d+)/", ltrim($matches[0][1]), $numero);
                            $endereco->numero = $numero[0][0];

                            preg_match_all("/([^-]+)/", Str::after($matches[0][1], $endereco->numero), $complCidadeEstado);
                            $endereco->complemento = trim($complCidadeEstado[0][0]);
                            $endereco->bairro      = trim($complCidadeEstado[0][1]);
                            $endereco->cidade      = trim($complCidadeEstado[0][2]);


                            $client             = Client::whereCpf($linha->cpf)->firstOrNew();
                            $client->name       = $linha->name;
                            $client->cpf        = $linha->cpf;
                            $client->email      = $linha->email;
                            $client->birth_date = $linha->birth_date;

                            if ($client->id > 0) {
                                $this->alert('CPF localizado: '.$client->cpf);
                                $client = $this->dispatchNow(UpdateClient::fromModel($client));
                            } else {
                                $client = $this->dispatchNow(CreateClient::fromModel($client));
                            }

                            $clientAddress = ClientAddress::whereClientId($client->id)->where('zipcode', $linha->zipcode)->where('number', $endereco->numero)->firstOrNew();
                            // IMPORTA O QUÊ VEM NO ARQUIVO
                            $clientAddress->zipcode        = $linha->zipcode;
                            $clientAddress->street_address = $endereco->logradouro;
                            $clientAddress->number         = $endereco->numero;
                            $clientAddress->complement     = $endereco->complemento;
                            $clientAddress->neighborhood   = $endereco->bairro;
                            $clientAddress->city           = $endereco->cidade;
                            $clientAddress->state          = $cep->uf;
                            if ($clientAddress->id > 0) {
                                $this->alert('Endereço e número localizado: '.$clientAddress->zipcode);
                                $this->dispatchNow(UpdateClientAddress::fromModel($client, $clientAddress));
                            } else {
                                $this->dispatchNow(CreateClientAddress::fromModel($client, $clientAddress));
                            }
                            $total_rows++;
                            $this->info("Fim de processamento da linha: {$currentLine}");
                        }
                        $import->processed  = TRUE;
                        $import->total_rows = $total_rows;
                        $import->save();
                    }
                });
            } catch (Exception $exception) {
                $this->error($exception->getMessage());
                return $exception->getMessage();
            }
        }
    }
