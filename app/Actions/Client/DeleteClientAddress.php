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
            $this->clientAddress->delete();
        }
    }