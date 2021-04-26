<?php

    namespace App\Http\Controllers;

    use App\DataTables\AddressesDataTable;

    class AddressesController extends Controller
    {
        public function __invoke(AddressesDataTable $dataTable)
        {
            $data['title'] = "Lista de Endereços";
            $data['new']   = route('clients.create');

            return $dataTable->render('template.datatables', ['data' => $data, 'page_title' => 'Endereços']);
        }
    }
