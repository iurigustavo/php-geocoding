<?php


    namespace App\Actions\CEP;


    use App\Http\Helpers\CallAPI;

    class SearchCep
    {

        /**
         * Search constructor.
         */
        public function __construct(private string $cep)
        {
        }

        public function handle(): mixed
        {

            $url = "https://viacep.com.br/ws/{$this->cep}/json/";

            return CallAPI::request('get', $url);

        }

    }