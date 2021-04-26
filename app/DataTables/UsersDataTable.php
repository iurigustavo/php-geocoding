<?php


    namespace App\DataTables;


    use App\Http\Helpers\FormUtils;
    use App\Models\User;
    use App\Traits\DataTable;
    use Illuminate\Database\Eloquent\Builder;
    use Yajra\DataTables\DataTableAbstract;
    use Yajra\DataTables\Html\Column;
    use Yajra\DataTables\Services\DataTable as YajraDataTable;

    class UsersDataTable extends YajraDataTable
    {
        use DataTable;

        public function dataTable($query): DataTableAbstract
        {
            return datatables()
                ->eloquent($query)
                ->addColumn('action', function ($q) {
                    return FormUtils::btnShow('users.show', $q->id);
                })
                ->rawColumns([
                    'action',
                ])
                ->order(function ($query) {
                    $query->orderBy('id', 'desc');
                });

        }

        public function query(User $model): Builder|User
        {
            return $model->newQuery();
        }


        protected function getColumns(): array
        {
            return [

                Column::make('id')->title('ID'),
                Column::make('name')->title('Nome'),
                Column::make('email')->title('E-Mail'),
                Column::computed('action')
                      ->exportable(FALSE)
                      ->printable(FALSE)
                      ->width(160)
                      ->title('Ação')
                      ->addClass('text-center'),
            ];
        }
    }
