<?php


    namespace App\DataTables;


    use App\Http\Helpers\DateUtils;
    use App\Http\Helpers\FormUtils;
    use App\Models\Client;
    use App\Models\ClientAddress;
    use App\Traits\DataTable;
    use Illuminate\Database\Eloquent\Builder;
    use Yajra\DataTables\DataTableAbstract;
    use Yajra\DataTables\Html\Column;
    use Yajra\DataTables\Services\DataTable as YajraDataTable;

    class AddressesDataTable extends YajraDataTable
    {
        use DataTable;

        public function dataTable($query): DataTableAbstract
        {
            return datatables()
                ->eloquent($query)
                ->addColumn('action', function ($q) {
                    return FormUtils::btnShow('clients.show', $q->client_id);
                })
                ->editColumn('birth_date', function ($q) {
                    return DateUtils::DataParaString($q->birth_date);
                })
                ->rawColumns([
                    'action',
                ])
                ->order(function ($query) {
                    $query->orderBy('id', 'desc');
                });

        }

        public function query(ClientAddress $model): Builder|Client
        {
            return $model->newQuery()->with('client');
        }


        protected function getColumns(): array
        {
            return [

                Column::make('id')->title('ID'),
                Column::make('client.name')->title('Nome'),
                Column::make('client.cpf')->title('CPF'),
                Column::make('birth_date')->title('Data de Nascimento')->hidden(),
                Column::make('street_address')->title('Logradouro'),
                Column::make('number')->title('Número'),
                Column::make('complement')->title('Complemento')->hidden(),
                Column::make('zipcode')->title('CEP'),
                Column::make('city')->title('Cidade'),
                Column::make('state')->title('Estado'),
                Column::computed('action')
                      ->exportable(FALSE)
                      ->printable(FALSE)
                      ->width(160)
                      ->title('Ação')
                      ->addClass('text-center'),
            ];
        }
    }
