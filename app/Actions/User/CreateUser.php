<?php


    namespace App\Actions\User;


    use App\Http\Requests\User\CreateUserRequest;
    use App\Models\User;
    use JetBrains\PhpStorm\Pure;

    class CreateUser
    {

        public function __construct(
            private string $name,
            private string $email,
            private string $password,
            private string $enabled,
            private array $roles
        ) {
        }


        #[Pure] public static function fromRequest(CreateUserRequest $request): self
        {
            return new static(
                name: $request->name,
                email: $request->email,
                password: $request->password,
                enabled: $request->enabled,
                roles: $request->roles
            );
        }

        public function handle(): User
        {
            $user = new User([
                'name'     => $this->name,
                'email'    => $this->email,
                'password' => bcrypt($this->password),
                'enabled'   => $this->enabled,
            ]);

            $user->save();

            $user->assignRole($this->roles);

            return $user;
        }

    }