<?php


    namespace App\DataTables;


    use App\Http\Helpers\DateUtils;
    use App\Http\Helpers\FormUtils;
    use App\Models\Import;
    use App\Models\Route;
    use App\Traits\DataTable;
    use Illuminate\Database\Eloquent\Builder;
    use Yajra\DataTables\DataTableAbstract;
    use Yajra\DataTables\Html\Column;
    use Yajra\DataTables\Services\DataTable as YajraDataTable;

    class RoutesDataTables extends YajraDataTable
    {
        use DataTable;

        public function dataTable($query): DataTableAbstract
        {
            return datatables()
                ->eloquent($query)
                ->addColumn('action', function ($q) {
                    return FormUtils::btnShow('routes.show', $q->id).FormUtils::btnDestroy('routes.destroy', $q->id);
                })
                ->editColumn('created_at', function ($q) {
                    return DateUtils::DataHoraParaString($q->created_at);
                })
                ->rawColumns([
                    'action',
                ])
                ->order(function ($query) {
                    $query->orderBy('id', 'desc');
                });

        }

        public function query(Route $model): Builder
        {
            return $model->newQuery();
        }


        protected function getColumns(): array
        {
            return [

                Column::make('id')->title('ID'),
                Column::make('uuid')->title('Código'),
                Column::make('created_at')->title('Criado em'),
                Column::computed('action')
                      ->exportable(FALSE)
                      ->printable(FALSE)
                      ->width(160)
                      ->title('Ação')
                      ->addClass('text-center'),
            ];
        }
    }
