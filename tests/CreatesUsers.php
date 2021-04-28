<?php

    namespace Tests;

    use App\Models\User;

    trait CreatesUsers
    {
        protected function login(array $attributes = []): User
        {
            $user = $this->createUser($attributes);

            $this->be($user);

            return $user;
        }

        protected function createUser(array $attributes = []): User
        {
            $user = User::whereEmail('john@example.com')->first();

            if (!$user) {

                $user = User::factory()->create(array_merge([
                    'name'     => 'John Doe',
                    'email'    => 'john@example.com',
                    'password' => bcrypt('password'),
                    'enabled'  => 1
                ], $attributes));

                $user->assignRole(1);
            }

            return $user;
        }

        protected function loginAs(User $user)
        {
            $this->be($user);
        }
    }
