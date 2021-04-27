<?php

    namespace App\Http\Controllers;

    use App\DataTables\ImportsDataTables;
    use App\Models\Import;
    use App\Repositories\CSVRepository;
    use Artisan;
    use Exception;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Contracts\View\View;
    use Illuminate\Http\Request;
    use Storage;

    class ImportsController extends Controller
    {
        public function __construct(
            private string $titulo = 'Importações de Arquivos',
        ) {
        }

        public function index(ImportsDataTables $dataTable)
        {
            $data['title'] = "Lista de Importações";
            $data['new']   = route('imports.create');

            return $dataTable->render('template.datatables', ['data' => $data, 'page_title' => $this->titulo]);
        }

        public function create(): Factory|View|Application
        {

            return view('pages.imports.create', [
                'page_title' => $this->titulo,
                'model'      => new Import(),
            ]);

        }

        public function store(CSVRepository $CSVRepository, Request $request)
        {
            try {
                $file      = $request->file('file');
                $extension = strtolower($file->getClientOriginalExtension());
                if ($extension !== 'csv') {
                    $errors['file'] = 'Não é um arquivo CSV';
                    return redirect()->back()->withInput()->withErrors($errors);
                }
                $CSVRepository->uploadCSV($file, $extension);

                /*
                 * Executa o processamento do arquivo, ideal que seja um job
                 * Pode executar também via: php artisan csv:process
                 */
                Artisan::call('csv:process');

                return redirect()->route('imports.index')->with('success', 'Seu arquivo foi processado, esperar a execução do mesmo!');
            } catch (Exception $exception) {
                return redirect()->route('imports.index')->with('errors', $exception->getMessage());
            }
        }

        public function show(Import $import)
        {
            return view('pages.imports.show', [
                'model' => $import,
            ]);
        }

        public function downloadFile(Import $import)
        {
            return Storage::disk('local')->download($import->path);
        }
    }
