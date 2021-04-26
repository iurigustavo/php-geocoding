<?php


    namespace App\DataTables;


    use App\Http\Helpers\DateUtils;
    use App\Http\Helpers\FormUtils;
    use App\Models\Client;
    use App\Traits\DataTable;
    use Illuminate\Database\Eloquent\Builder;
    use Yajra\DataTables\DataTableAbstract;
    use Yajra\DataTables\Html\Column;
    use Yajra\DataTables\Services\DataTable as YajraDataTable;

    class ClientsDataTable extends YajraDataTable
    {
        use DataTable;

        public function dataTable($query): DataTableAbstract
        {
            return datatables()
                ->eloquent($query)
                ->addColumn('action', function ($q) {
                    return FormUtils::btnShow('clients.show', $q->id);
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

        public function query(Client $model): Builder|Client
        {
            return $model->newQuery();
        }


        protected function getColumns(): array
        {
            return [

                Column::make('id')->title('ID'),
                Column::make('name')->title('Nome'),
                Column::make('cpf')->title('CPF'),
                Column::make('birth_date')->title('Data de Nascimento'),
                Column::computed('action')
                      ->exportable(FALSE)
                      ->printable(FALSE)
                      ->width(160)
                      ->title('Ação')
                      ->addClass('text-center'),
            ];
        }
    }
