<?php


    namespace App\Actions\User;


    use App\Http\Requests\User\UpdateUserRequest;
    use App\Models\User;
    use Illuminate\Support\Facades\DB;
    use JetBrains\PhpStorm\Pure;

    class UpdateUser
    {
        public function __construct(
            private User $user,
            private string $name,
            private string $email,
            private string $password,
            private string $enabled,
            private array $roles
        ) {
        }


        #[Pure] public static function fromRequest(User $user, UpdateUserRequest $request): self
        {
            return new static(
                user: $user,
                name: $request->name,
                email: $request->email,
                password: $request->password,
                enabled: $request->enabled,
                roles: $request->roles
            );
        }

        public function handle(): User
        {

            if ($this->user->password != $this->password) {
                $this->password = bcrypt($this->password);
            }


            $this->user->update([
                'name'     => $this->name,
                'email'    => $this->email,
                'password' => bcrypt($this->password),
                'enabled'  => $this->enabled,
            ]);

            DB::table('model_has_roles')->where('model_id', $this->user->id)->delete();
            $this->user->assignRole($this->roles);

            return $this->user;
        }

    }