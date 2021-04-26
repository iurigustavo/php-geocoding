<?php


    namespace App\Actions\Profile;


    use App\Models\User;
    use Session;

    class ChangeRole
    {


        /**
         * ChangeRole constructor.
         */
        public function __construct(private int $role_id)
        {
        }

        /**
         * @throws \Exception
         */
        public function handle(): void
        {
            if (!auth()->user()->hasRole($this->role_id)) {
                throw new \Exception('Sem permissão!');
            }

            auth()->user()->last_role_id = $this->role_id;
            auth()->user()->save();
            Session::put('current_role', auth()->user()->lastRole);
        }
    }