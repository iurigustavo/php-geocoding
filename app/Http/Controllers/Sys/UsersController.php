<?php

    namespace App\Http\Controllers\Sys;

    use App\Actions\User\CreateUser;
    use App\Actions\User\DeleteUser;
    use App\Actions\User\UpdateUser;
    use App\DataTables\UsersDataTable;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\User\CreateUserRequest;
    use App\Http\Requests\User\UpdateUserRequest;
    use App\Models\User;
    use Exception;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Contracts\View\View;
    use Illuminate\Http\RedirectResponse;
    use Spatie\Permission\Models\Role;
    use Throwable;

    /**
     * Class UsersController
     *
     * @package App\Http\Controllers\Sys
     */
    class UsersController extends Controller
    {

        public function __construct(
            private string $titulo = 'Usuarios',
        ) {
        }


        public function index(UsersDataTable $dataTable)
        {
            $data['title'] = "Lista de Usuários";
            $data['new']   = route('users.create');

            return $dataTable->render('template.datatables', ['data' => $data, 'page_title' => $this->titulo]);

        }

        public function create(): Factory|View|Application
        {

            return view('pages.users.show', [
                'page_title' => $this->titulo,
                'model'      => new User(),
                'roles'      => Role::query()->pluck('name', 'name')->all(),
                'userRole'   => []
            ]);

        }

        public function show(User $user): Factory|View|Application
        {

            return view('pages.users.show', [
                'page_title' => $this->titulo,
                'model'      => $user,
                'roles'      => Role::query()->pluck('name', 'name')->all(),
                'userRole'   => $user->roles->pluck('name', 'name')->all()
            ]);

        }

        public function store(CreateUserRequest $request): RedirectResponse
        {
            try {
                $usuario = $this->dispatchNow(CreateUser::fromRequest($request));
            } catch (Exception | Throwable) {
                return redirect()->route('users.create')->with('errors', 'Erro ao adicionar registro');
            }


            return redirect()->route('users.index')->with('success', 'Registro cadastrado com sucesso');
        }

        public function update(UpdateUserRequest $request, User $user): RedirectResponse
        {
            $usuario = $this->dispatchNow(UpdateUser::fromRequest($user, $request));

            return redirect()->route('users.index')->with('success', 'Registro atualizado com sucesso');
        }

        /**
         * @throws \Throwable
         */
        public function destroy(User $user): RedirectResponse
        {
            try {
                $this->dispatchNow(new DeleteUser($user));
                return redirect()->route('users.index')->with('success', 'Registro excluído com sucesso!!!');
            } catch (Exception | Throwable) {
                return redirect()->route('users.index')->with('errors', 'Erro ao remover o registro');
            }
        }

    }
