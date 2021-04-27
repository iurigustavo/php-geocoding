<?php


    namespace App\Actions\Client;


    use App\Http\Requests\Client\UpdateClientRequest;
    use App\Models\Client;
    use JetBrains\PhpStorm\Pure;

    class UpdateClient
    {
        public function __construct(
            private Client $client,
            private string $name,
            private string $email,
            private string $cpf,
            private string $birth_date,
        ) {
        }


        #[Pure] public static function fromRequest(Client $client, UpdateClientRequest $request): self
        {
            return new static(
                client: $client,
                name: $request->name,
                email: $request->email,
                cpf: $request->cpf,
                birth_date: $request->birth_date
            );
        }

        #[Pure] public static function fromModel(Client $client): self
        {
            return new static(
                client: $client,
                name: $client->name,
                email: $client->email,
                cpf: $client->cpf,
                birth_date: $client->birth_date
            );
        }

        public function handle(): Client
        {

            $this->client->update([
                'name'       => $this->name,
                'email'      => $this->email,
                'cpf'        => $this->cpf,
                'birth_date' => $this->birth_date,
            ]);

            return $this->client;
        }
    }