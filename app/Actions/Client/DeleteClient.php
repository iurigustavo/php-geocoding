<?php


    namespace App\Actions\Client;


    use App\Models\Client;

    class DeleteClient
    {
        public function __construct(private Client $client)
        {
        }

        /**
         * @throws \Exception
         */
        public function handle()
        {
            $this->client->delete();
        }
    }