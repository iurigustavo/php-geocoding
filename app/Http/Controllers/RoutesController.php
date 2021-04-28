<?php

    namespace App\Http\Controllers;

    use App\Actions\Routes\DeleteRoute;
    use App\DataTables\RoutesDataTables;
    use App\Models\ClientAddress;
    use App\Models\Route;
    use Exception;
    use Throwable;

    class RoutesController extends Controller
    {
        public function index(RoutesDataTables $dataTable)
        {
            $data['title'] = "Lista de Rotas de Entregas";
            $data['new']   = route('routes.create');

            return $dataTable->render('template.datatables', ['data' => $data, 'page_title' => 'Rotas de Entregas']);
        }

        public function create()
        {
            return view('pages.routes.create', [
                'page_title'           => 'Criar Rota de Entrega',
                'model'                => new Route(),
                'listClientsAddresses' => ClientAddress::query()->with('client')->get()
            ]);
        }

        public function show(Route $route)
        {
            return view('pages.routes.show', compact('route'));
        }

        public function map($uuid)
        {
            $route      = Route::whereUuid($uuid)->first();
            $routes     = $route->route;
            $page_title = 'Rota: '.$uuid;
            return view('pages.routes.map', compact('route', 'routes', 'page_title'));
        }

        public function destroy(Route $route)
        {
            try {
                $this->dispatchNow(new DeleteRoute($route));
                return redirect()->route('routes.index')->with('success', 'Registro excluído com sucesso!!!');
            } catch (Exception | Throwable) {
                return redirect()->route('routes.index.index')->with('errors', 'Erro ao remover o registro');
            }
        }
    }
