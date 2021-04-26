<?php


    namespace App\Actions\Client;


    use App\Http\Requests\Client\CreateClientRequest;
    use App\Models\Client;
    use JetBrains\PhpStorm\Pure;

    class CreateClient
    {

        public function __construct(
            private string $name,
            private string $email,
            private string $cpf,
            private string $birth_date,
        ) {
        }


        #[Pure] public static function fromRequest(CreateClientRequest $request): self
        {
            return new static(
                name: $request->name,
                email: $request->email,
                cpf: $request->cpf,
                birth_date: $request->birth_date
            );
        }

        public function handle(): Client
        {
            $client = new Client([
                'name'       => $this->name,
                'email'      => $this->email,
                'cpf'        => $this->cpf,
                'birth_date' => $this->birth_date,
            ]);

            $client->save();


            return $client;
        }
    }