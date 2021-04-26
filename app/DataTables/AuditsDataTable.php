<?php

    namespace App\DataTables;

    use App\Http\Helpers\DateUtils;
    use App\Http\Helpers\FormUtils;
    use App\Models\Audit;
    use App\Traits\DataTable;
    use Yajra\DataTables\DataTableAbstract;
    use Yajra\DataTables\EloquentDataTable;
    use Yajra\DataTables\Html\Column;
    use Yajra\DataTables\Services\DataTable as YajraDataTable;

    class AuditsDataTable extends YajraDataTable
    {
        use DataTable;

        public function dataTable($query): EloquentDataTable|DataTableAbstract
        {
            return datatables()
                ->eloquent($query)
                ->addColumn('action', function ($q) {
                    if ($q->old_value or $q->new_values) {
                        return FormUtils::btnModal($q->id);
                    }
                })
                ->editColumn('user', function ($q) {
                    if ($q->user) {
                        return $q->user->username.' - '.$q->user->name;
                    }
                    return '';
                })
                ->addColumn('#', function ($q) {
                    if ($q->old_value or $q->new_values) {
                        return view('template.audits', ['model' => $q]);
                    }
                })
                ->editColumn('created_at', function ($q) {
                    return DateUtils::DataHoraParaString($q->created_at);
                })
                ->editColumn('updated_at', function ($q) {
                    return DateUtils::DataHoraParaString($q->updated_at);
                })
                ->filterColumn('created_at', function ($query, $keyword) {
                    $query->whereRaw("to_char(created_at,'DD/MM/YYYY HH:MI:SS') like ?", ["%$keyword%"]);
                })
                ->filterColumn('updated_at', function ($query, $keyword) {
                    $query->whereRaw("to_char(updated_at,'DD/MM/YYYY HH:MI:SS') like ?", ["%$keyword%"]);
                })
                ->filter(function ($query) {
                    if (request('auditable_type')) {
                        $query->where('auditable_type', request('auditable_type'));
                    }
                    if (request('event')) {
                        $query->where('event', request('event'));
                    }
                    if (request('user_id')) {
                        $query->where('user_id', request('user_id'));
                    }

                }, TRUE)
                ->rawColumns([
                    'action',

                ]);

        }


        public function query(Audit $model)
        {

            return $model->newQuery()->with('user');
        }

        protected function getColumns(): array
        {
            return [

                Column::make('id')->title('ID'),
                Column::make('event')->title('Tipo'),
                Column::make('auditable_type')->title('Model'),
                Column::make('user')->name('user.username')->title('Modificado Por'),
                Column::make('user')->name('user.name')->title('Modificado Por')->hidden(),
                Column::make('created_at')->title('Criado'),
                Column::make('updated_at')->title('Atualização'),
                Column::make('#')->addClass('d-none d-sm-table-cell')->searchable(FALSE)->orderable(FALSE),
                Column::computed('action')
                      ->exportable(FALSE)
                      ->printable(FALSE)
                      ->width(120)
                      ->title('Ação')
                      ->addClass('text - center'),
            ];
        }


    }
