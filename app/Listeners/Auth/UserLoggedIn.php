<?php

    namespace App\Listeners\Auth;

    use Illuminate\Auth\Events\Login;
    use Session;

    class UserLoggedIn
    {
        /**
         * Create the event listener.
         *
         * @return void
         */
        public function __construct()
        {
            //
        }

        /**
         * Handle the event.
         *
         * @param  Login  $event
         *
         * @return void
         */
        public function handle(Login $event)
        {
            Session::put('current_role', $event->user->lastRole);
            Session::put('user_roles', $event->user->roles()->pluck('name', 'id')->all());
        }
    }
