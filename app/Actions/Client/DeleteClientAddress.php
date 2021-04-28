<?php


    namespace App\Actions\Client;


    use App\Models\ClientAddress;

    class DeleteClientAddress
    {
        public function __construct(private ClientAddress $clientAddress)
        {
        }

        /**
         * @throws \Exception
         */
        public function handle()
        {
            return $this->clientAddress->delete();
        }
    }