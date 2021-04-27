<?php


    namespace App\Actions\CEP;


    use App\Classes\Cep;
    use App\Http\Helpers\CallAPI;

    class SearchCep
    {

        /**
         * Search constructor.
         */
        public function __construct(private string $cep)
        {
        }

        public function handle(): ?Cep
        {

            $url = "https://viacep.com.br/ws/{$this->cep}/json/";

            $address = CallAPI::request('get', $url);
            if (optional($address)->erro === TRUE) {
                return NULL;
            } else {
                return Cep::fromObject($address);
            }
        }

    }