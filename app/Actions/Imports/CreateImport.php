<?php


    namespace App\Actions\Imports;


    use App\Models\Import;
    use JetBrains\PhpStorm\Pure;

    class CreateImport
    {

        public function __construct(
            private string $path
        ) {
        }


        #[Pure] public static function fromPath($path): self
        {
            return new static(
                path: $path,
            );
        }

        public function handle(): Import
        {
            $import = new Import([
                'path'      => $this->path,
                'processed' => FALSE,
                'user_id'   => auth()->id(),
            ]);

            $import->save();

            return $import;
        }
    }