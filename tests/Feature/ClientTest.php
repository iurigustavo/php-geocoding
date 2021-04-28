<?php

    namespace Tests\Feature;

    use App\Actions\Client\CreateClient;
    use App\Actions\Client\CreateClientAddress;
    use App\Actions\Client\DeleteClient;
    use App\Actions\Client\DeleteClientAddress;
    use App\Actions\Client\UpdateClient;
    use App\Actions\Client\UpdateClientAddress;
    use App\Http\Requests\Client\CreateClientRequest;
    use App\Http\Requests\Client\UpdateClientRequest;
    use App\Models\Client;
    use App\Models\ClientAddress;
    use Tests\TestCase;

    class ClientTest extends TestCase
    {
        /** @test */
        public function create_client()
        {
            $request = new CreateClientRequest();
            $request->replace(
                [
                    'name'       => 'Iuri Gustavo',
                    'email'      => 'gustavo.iuri@gmail.com',
                    'cpf'        => '999.999.999-99',
                    'birth_date' => '1988-12-05'
                ]
            );

            $client = $this->dispatch(CreateClient::fromRequest($request));

            $this->assertInstanceOf(Client::class, $client);
        }

        /** @test */
        public function update_client()
        {
            $client  = Client::whereCpf('999.999.999-99')->first();
            $request = new UpdateClientRequest();
            $request->replace(
                [
                    'name'       => 'Iuri Gustavo Santos',
                    'email'      => 'gustavo.iuri@gmail.com',
                    'cpf'        => '999.999.999-99',
                    'birth_date' => '1988-12-05'
                ]
            );

            $client = $this->dispatch(UpdateClient::fromRequest($client, $request));

            $this->assertInstanceOf(Client::class, $client);
        }

        /** @test */
        public function create_client_address()
        {
            $client = Client::whereCpf('999.999.999-99')->first();

            $clientAddress = ClientAddress::whereClientId($client->id)->where('zipcode', '76820-050')->where('number', '4170')->firstOrNew();

            $clientAddress->zipcode        = '76820-050';
            $clientAddress->street_address = 'AV RIO DE JANEIRO';
            $clientAddress->number         = '4170';
            $clientAddress->complement     = '';
            $clientAddress->neighborhood   = 'NOVA PORTO VELHO';
            $clientAddress->city           = 'PORTO VELHO';
            $clientAddress->state          = 'RO';


            $clientAddress = $this->dispatch(CreateClientAddress::fromModel($client, $clientAddress));

            $this->assertInstanceOf(ClientAddress::class, $clientAddress);
        }

        /** @test */
        public function update_client_address()
        {
            $client = Client::whereCpf('999.999.999-99')->first();

            $clientAddress = ClientAddress::whereClientId($client->id)->where('zipcode', '76820-050')->where('number', '4170')->firstOrNew();

            $clientAddress->zipcode        = '76820-050';
            $clientAddress->street_address = 'AVENIDA RIO DE JANEIRO';
            $clientAddress->number         = '4170';
            $clientAddress->complement     = '';
            $clientAddress->neighborhood   = 'NOVA PORTO VELHO';
            $clientAddress->city           = 'PORTO VELHO';
            $clientAddress->state          = 'RO';

            $clientAddress = $this->dispatch(UpdateClientAddress::fromModel($client, $clientAddress));

            $this->assertInstanceOf(ClientAddress::class, $clientAddress);
        }

        /** @test */
        public function delete_client_address()
        {
            $client        = Client::whereCpf('999.999.999-99')->first();
            $clientAddress = ClientAddress::whereClientId($client->id)->where('zipcode', '76820-050')->where('number', '4170')->firstOrNew();

            $return = $this->dispatch(new DeleteClientAddress($clientAddress));
            $clientAddress->forceDelete();
            $this->assertTrue($return);
        }


        /** @test */
        public function delete_client()
        {
            $client = Client::whereCpf('999.999.999-99')->first();

            $return = $this->dispatch(new DeleteClient($client));
            $client->forceDelete();
            $this->assertTrue($return);
        }
    }
