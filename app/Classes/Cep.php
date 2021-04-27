<?php


    namespace App\Classes;


    use JetBrains\PhpStorm\Pure;

    class Cep
    {

        public string  $cep;
        public string  $logradouro;
        public ?string $complemento;
        public string  $bairro;
        public string  $localidade;
        public string  $uf;

        #[Pure] public static function fromObject($obj): Cep
        {
            $cep              = new Cep();
            $cep->cep         = $obj->cep;
            $cep->logradouro  = $obj->logradouro;
            $cep->complemento = $obj->complemento;
            $cep->bairro      = $obj->bairro;
            $cep->localidade  = $obj->localidade;
            $cep->uf          = $obj->uf;

            return $cep;
        }

    }