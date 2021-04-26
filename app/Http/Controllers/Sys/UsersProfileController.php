<?php

    namespace App\Http\Controllers\Sys;

    use App\Actions\Profile\ChangeRole;
    use App\Actions\Profile\UpdateProfile;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\User\UpdateProfileRequest;
    use Exception;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Contracts\View\View;
    use Illuminate\Http\RedirectResponse;

    class UsersProfileController extends Controller
    {
        public function __construct()
        {
        }

        public function show(): Factory|View|Application
        {
            $page_title = 'Informações Pessoais';
            $model      = auth()->user();

            return view('pages.usuarios.perfil.profile', compact('page_title', 'model'));
        }

        /**
         * @throws \Throwable
         */
        public function update(UpdateProfileRequest $request): RedirectResponse
        {
            $usuario = $this->dispatchNow(UpdateProfile::fromRequest(auth()->user(), $request));

            return redirect()->route('home')->with('success', 'Perfil atualizado com sucesso');
        }

        public function changeRole(int $id): RedirectResponse
        {

            try {
                $this->dispatchNow(new ChangeRole($id));
            } catch (Exception $e) {
                return redirect()->back()->with('errors', $e->getMessage());
            }

            return redirect()->route('home')->with('success', 'Perfil alterado com sucesso');
        }

    }
