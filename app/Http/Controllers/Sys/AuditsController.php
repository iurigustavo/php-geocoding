<?php

    namespace App\Http\Controllers\Sys;

    use App\DataTables\AuditsDataTable;
    use App\Http\Controllers\Controller;


    class AuditsController extends Controller
    {


        public function __construct(
            private array $data = ['title' => 'Log']
        ) {
        }

        public function index(AuditsDataTable $dataTable)
        {

            $this->data['subTitle'] = 'Lista de Logs';
            $this->data['new']      = FALSE;

            return $dataTable->render('template.datatables', ['data' => $this->data, 'page_title' => 'Auditoria']);
        }


    }
