<?php


    namespace App\Actions\Imports;


    use App\Models\Import;
    use Illuminate\Database\Eloquent\Model;

    class ProcessImport
    {
        public function __construct(
            private Import $import
        ) {
        }

        public function handle(): Import
        {
            $this->import->path;


            return $import;
        }
    }