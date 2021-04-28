<?php

    namespace Tests\Feature;

    use App\Models\User;

    class AuthTest extends BrowserKitTestCase
    {
        /** @test */
        public function users_can_login()
        {
            $this->createUser();

            $this->visit('/login')
                 ->type('john@example.com', 'email')
                 ->type('password', 'password')
                 ->press('Sign In')
                 ->seePageIs('/home')
                 ->see('John Doe');
        }

        /** @test */
        public function login_fails_when_a_required_field_is_not_filled_in()
        {
            $this->createUser();

            $this->visit('/login')
                 ->press('Sign In')
                 ->seePageIs('/login')
                 ->see('O campo email é obrigatório.')
                 ->see('O campo senha é obrigatório.');
        }

        /** @test */
        public function login_fails_when_password_is_incorrect()
        {
            $this->createUser();

            $this->visit('/login')
                 ->type('johndoe', 'email')
                 ->type('invalidpass', 'password')
                 ->press('Sign In')
                 ->seePageIs('/login')
                 ->see('Essas credenciais não foram encontradas em nossos registros.');
        }

        /** @test */
        public function delete_user()
        {
            $this->assertTrue(User::whereEmail('john@example.com')->first()->forceDelete());
        }


    }
