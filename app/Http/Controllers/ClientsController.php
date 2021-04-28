<?php

    namespace App\Http\Controllers;

    use App\Actions\Client\CreateClient;
    use App\Actions\Client\DeleteClient;
    use App\Actions\Client\UpdateClient;
    use App\DataTables\ClientsDataTable;
    use App\Http\Requests\Client\CreateClientRequest;
    use App\Http\Requests\Client\UpdateClientRequest;
    use App\Models\Client;
    use App\Models\ClientAddress;
    use Exception;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Contracts\View\View;
    use Throwable;

    class ClientsController extends Controller
    {
        public function __construct(
            private string $titulo = 'Clientes',
        ) {
        }

        public function index(ClientsDataTable $dataTable)
        {
            $data['title'] = "Lista de Clientes";
            $data['new']   = route('clients.create');

            return $dataTable->render('template.datatables', ['data' => $data, 'page_title' => $this->titulo]);

        }

        public function create(): Factory|View|Application
        {


            return view('pages.clients.create', [
                'page_title'           => $this->titulo,
                'model'                => new Client(),
            ]);

        }

        public function store(CreateClientRequest $request)
        {
            /** @var Client $client */
            $client = $this->dispatchNow(CreateClient::fromRequest($request));

            return redirect()->route('clients.show', $client->id)->with('success', 'Registro cadastrado com sucesso');
        }

        public function show(Client $client): Factory|View|Application
        {

            return view('pages.clients.show', [
                'page_title' => $client->name,
                'model'      => $client,
            ]);
        }


        public function update(UpdateClientRequest $request, Client $client)
        {
            $client = $this->dispatchNow(UpdateClient::fromRequest($client, $request));

            return redirect()->route('clients.index')->with('success', 'Registro atualizado com sucesso');
        }

        public function destroy(Client $client)
        {
            try {
                $this->dispatchNow(new DeleteClient($client));
                return redirect()->route('clients.index')->with('success', 'Registro excluído com sucesso!!!');
            } catch (Exception | Throwable) {
                return redirect()->route('clients.index')->with('errors', 'Erro ao remover o registro');
            }
        }
    }
