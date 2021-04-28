<?php


    namespace App\Actions\Routes;


    use App\Models\Route;

    class DeleteRoute
    {
        public function __construct(private Route $route)
        {
        }

        /**
         * @throws \Exception
         */
        public function handle()
        {
            return $this->route->delete();
        }
    }