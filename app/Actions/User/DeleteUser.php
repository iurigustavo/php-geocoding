<?php


    namespace App\Actions\User;


    use App\Models\User;

    class DeleteUser
    {

        public function __construct(private User $user)
        {
        }

        /**
         * @throws \Exception
         */
        public function handle()
        {
            $this->user->delete();
        }
    }