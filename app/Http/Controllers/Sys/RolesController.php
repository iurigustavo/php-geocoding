<?php

    namespace App\Http\Controllers\Sys;

    use App\DataTables\RolesDataTable;
    use App\Http\Controllers\Controller;
    use DB;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Contracts\View\View;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Spatie\Permission\Models\Role;
    use Spatie\Permission\Models\Permission;

    class RolesController extends Controller
    {
        public function __construct(
            private string $titulo = 'Perfis'
        ) {
        }

        public function index(RolesDataTable $dataTable)
        {
            $page_title = $this->titulo;

            $data['title'] = "Lista de Perfis";
            $data['new']   = route('perfis.create');

            return $dataTable->render('template.datatables', ['data' => $data, 'page_title' => $page_title]);

        }

        public function create(): Factory|View|Application
        {
            $page_title      = $this->titulo;
            $model           = new Role();
            $permission      = Permission::get();
            $rolePermissions = [];
            return view('pages.perfis.show', compact('page_title', 'permission', 'model', 'rolePermissions'));
        }


        public function store(Request $request): Response|RedirectResponse
        {
            $this->validate($request, [
                'name'       => 'required|unique:roles,name',
                'permission' => 'nullable',
            ]);

            $role = Role::create(['name' => $request->input('name')]);
            if ($request->has('permission')) {
                $role->syncPermissions($request->input('permission'));
            }

            return redirect()->route('perfis.index')->with('success', 'Perfil criado com sucesso');
        }

        public function show($id): Factory|View|Application
        {
            $page_title      = $this->titulo;
            $model           = Role::find($id);
            $permission      = Permission::get();
            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
                                 ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                                 ->all();

            return view('pages.perfis.show', compact('page_title', 'permission', 'model', 'rolePermissions'));
        }

        public function update(Request $request, $id): RedirectResponse
        {
            $this->validate($request, [
                'name'       => 'required',
                'permission' => 'nullable',
            ]);

            $role       = Role::find($id);
            $role->name = $request->input('name');
            $role->save();

            if ($request->has('permission')) {
                $role->syncPermissions($request->input('permission'));
            }

            return redirect()->route('perfis.index')->with('success', 'Perfil alterado com sucesso');
        }

        public function destroy($id): RedirectResponse
        {
            DB::table("roles")->where('id', $id)->delete();
            return redirect()->route('perfis.index')->with('success', 'Perfil deletado com sucesso');
        }
    }
