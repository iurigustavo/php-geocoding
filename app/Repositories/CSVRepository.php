<?php

    namespace App\Repositories;

    use Illuminate\Support\Facades\Storage;

    class CSVRepository {

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
         * @return mixed
         */
        public function uploadCSV($file, $extension){
            return $this->upload($file, $extension);
        }

        /**
         * @param $file
         * @param $extension
         * @return mixed
         */
        private function upload($file, $extension){
            $path = Storage::putFileAs("myFileName", $file, uniqid().".".$extension);
            $uploadedFile = Invoice::create([
                'path' => $path,
                'processed' => false,
            ]);

            return $uploadedFile;
        }
    }