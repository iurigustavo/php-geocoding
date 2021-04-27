<?php

    namespace App\Repositories;

    use App\Actions\Imports\CreateImport;
    use App\Models\Import;
    use Illuminate\Foundation\Bus\DispatchesJobs;
    use Illuminate\Support\Facades\Storage;

    class CSVRepository
    {
        use DispatchesJobs;

        /**
         * CSVRepository constructor.
         */
        public function __construct()
        {
            //
        }

        /**
         * @param $file
         * @param $extension
         *
         * @return mixed
         */
        public function uploadCSV($file, $extension)
        {
            return $this->upload($file, $extension);
        }

        /**
         * @param $file
         * @param $extension
         *
         * @return mixed
         */
        private function upload($file, $extension): Import
        {
            $path = Storage::putFileAs("importacao", $file, uniqid().".".$extension);
            return $this->dispatchNow(new CreateImport($path));
        }
    }