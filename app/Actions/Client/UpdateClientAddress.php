<?php


    namespace App\Actions\Client;


    use App\Http\Requests\ClientAddress\ClientAddressRequest;
    use App\Models\Client;
    use App\Models\ClientAddress;
    use JetBrains\PhpStorm\Pure;

    class UpdateClientAddress
    {
        public function __construct(
            private Client $client,
            private ClientAddress $address,
            private string $street_address,
            private string $number,
            private string $complement,
            private ?string $neighborhood,
            private string $zipcode,
            private string $city,
            private string $state,
        ) {
        }


        #[Pure] public static function fromRequest(Client $client, ClientAddress $address, ClientAddressRequest $request): self
        {
            return new static(
                client: $client,
                address: $address,
                street_address: $request->street_address,
                number: $request->number,
                complement: $request->complement,
                neighborhood: $request->neighborhood,
                zipcode: $request->zipcode,
                city: $request->city,
                state: $request->state
            );
        }

        #[Pure] public static function fromModel(Client $client, ClientAddress $address): self
        {
            return new static(
                client: $client,
                address: $address,
                street_address: $address->street_address,
                number: $address->number,
                complement: $address->complement,
                neighborhood: $address->neighborhood,
                zipcode: $address->zipcode,
                city: $address->city,
                state: $address->state
            );
        }


        public function handle(): ClientAddress
        {

            $this->address->update([
                'street_address' => $this->street_address,
                'number'         => $this->number,
                'complement'     => $this->complement,
                'neighborhood'   => $this->neighborhood,
                'zipcode'        => $this->zipcode,
                'city'           => $this->city,
                'state'          => $this->state,
                'client_id'      => $this->client->id,
            ]);

            return $this->address;
        }
    }