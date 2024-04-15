<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('created_at', function($record) {
                return $record->created_at->format(config('app.date_format'));
            })
            ->editColumn('user_name', function($record) {
                return $record->user_name ?? "N/A";
            }) 
            ->editColumn('email', function($record) {
                return $record->email ?? "N/A";
            })  
            ->editColumn('role_id', function($record) {
                return $record->role_id == config("constant.role.creator")  ? "Creator"  : "User";
            }) 
            
            ->editColumn('status', function ($record) {
                $checkedStatus = ($record->status == 1 ? 'checked' : '');
                $currentStatus = ($record->status == 1 ?  trans("cruds.global.active") :  trans("cruds.global.in_active"));
                $status = 1;
                if ($record->status == 1) {
                    $status = 0;
                }

                $html = ' <div class="form-group custom-control custom-switch custom-switch-off-danger custom-switch-on-success"><input class="user_status custom-control-input" id="normal' . $record->id . '"  value="' . $status . '" ' . $checkedStatus . ' type="checkbox" name="status" data-status-id="' . $record->id . '"> <label class="custom-control-label" for="normal' . $record->id . '">'.$currentStatus.'</label></div>';
                return $html;
            })  
            
            
            ->addColumn('action', function($record) {
                $action  = '<div class="d-flex">';
                $action .= '<a class="btn btn-primary btn-sm" title="'. trans("cruds.global.view") .'" href="'.route('admin.users.show', $record->id).'">
                                <i class="fas fa-eye"></i>
                            </a>';
                $action .= '<a class="btn btn-info btn-sm" title="'. trans("cruds.global.edit") .'" href="'.route("admin.users.edit", $record->id).'">
                    <i class="fas fa-pencil-alt"></i>
                </a>';
            
                $action .= '</div>';
                return $action;
            })
            ->rawColumns(['status','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $query = $model->newQuery();
        $query->where('role_id', '!=', 1);
        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->setTableId('users-table')
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->dom('lfrtip')
        ->orderBy(1)
        ->buttons(
            Button::make('export'),
            Button::make('reset'),
            Button::make('reload')
        )
        ->parameters([
            'stateSave' => false,
            'buttons' => ['pageLength'],
            'responsive' => true,
            'autoWidth' => true,
            'width' => '100%',
            'language' => ['url' => getLangUrl()]
        ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title('#')->orderable(false)->searchable(false),
            Column::make('user_name')->title(trans("cruds.user.fields.user_name")),
            Column::make('email')->title(trans("cruds.user.fields.email")),
            Column::make('role_id')->title(trans("cruds.user.fields.role"))->orderable(false)->searchable(false),
            Column::computed('status')->title(trans("cruds.global.status"))->orderable(false)->searchable(false),
            Column::make('created_at')->title(trans("cruds.global.created_date"))->orderable(false)->searchable(false),
            Column::computed('action')->title(trans("cruds.global.action"))->orderable(false)->searchable(false),

            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->addClass('datatable_action'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
