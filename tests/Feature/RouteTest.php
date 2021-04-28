<?php

    namespace Tests\Feature;

    use App\Actions\Client\CreateClient;
    use App\Actions\Client\CreateClientAddress;
    use App\Actions\Routes\CreateRoute;
    use App\Actions\Routes\DeleteRoute;
    use App\Http\Requests\Client\CreateClientRequest;
    use App\Models\Client;
    use App\Models\ClientAddress;
    use App\Models\Route;
    use App\Models\RouteAddress;
    use Tests\TestCase;

    class RouteTest extends TestCase
    {
        /** @test */
        public function create_route()
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

            $clientAddress                 = ClientAddress::whereClientId($client->id)->where('zipcode', '76820-050')->where('number', '4170')->firstOrNew();
            $clientAddress->zipcode        = '76820-050';
            $clientAddress->street_address = 'AV RIO DE JANEIRO';
            $clientAddress->number         = '4170';
            $clientAddress->complement     = '';
            $clientAddress->neighborhood   = 'NOVA PORTO VELHO';
            $clientAddress->city           = 'PORTO VELHO';
            $clientAddress->state          = 'RO';

            $clientAddress = $this->dispatch(CreateClientAddress::fromModel($client, $clientAddress));
            $this->assertInstanceOf(ClientAddress::class, $clientAddress);

            $clientAddress = ClientAddress::whereClientId($client->id)->where('zipcode', '76820-050')->where('number', '4170')->get()->pluck('id', 'id')->toArray();

            $route = $this->dispatch(CreateRoute::fromArray($clientAddress));
            $this->assertInstanceOf(Route::class, $route);
        }

        /** @test */
        public function delete_route()
        {
            $routeAddress = RouteAddress::whereDistance(2453198.8456826)->first();
            $route        = Route::find($routeAddress->route_id);
            foreach ($route->addresses as $address) {
                $this->assertTrue($address->forceDelete());
            }
            $return = $this->dispatch(new DeleteRoute($route));
            $route->forceDelete();
            $this->assertTrue($return);
        }

        /** @test */
        public function clean_up_teste()
        {
            $client        = Client::whereCpf('999.999.999-99')->first();
            $clientAddress = ClientAddress::whereClientId($client->id)->where('zipcode', '76820-050')->where('number', '4170')->firstOrNew();
            $this->assertTrue($clientAddress->forceDelete());
            $this->assertTrue($client->forceDelete());
        }
    }
