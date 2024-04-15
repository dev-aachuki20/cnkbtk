<?php

namespace App\DataTables;

use App\Models\Plan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PlansDataTable extends DataTable
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
                if(!empty($record->created_at)){
                    return $record->created_at->format(config('app.date_format')) ;
                }
                return  "N/A";
                
            })
            ->editColumn('title_en', function($record) {
                return $record->title_en ?? "N/A";
            }) 

            ->editColumn('title_ch', function($record) {
                return $record->title_ch ?? "N/A";
            }) 
           
            ->editColumn('status', function ($record) {
                $checkedStatus = ($record->status == 1 ? 'checked' : '');
                $currentStatus = ($record->status == 1 ? trans("cruds.global.active") : trans("cruds.global.in_active"));
                $status = 1;
                if ($record->status == 1) {
                    $status = 0;
                }

                $html = ' <div class="form-group custom-control custom-switch custom-switch-off-danger custom-switch-on-success"><input class="user_status custom-control-input" id="normal' . $record->id . '"  value="' . $status . '" ' . $checkedStatus . ' type="checkbox" name="status" data-status-id="' . $record->id . '"> <label class="custom-control-label" for="normal' . $record->id . '">'.$currentStatus.'</label></div>';
                return $html;
            })
            ->addColumn('action', function($record) {
                $action  = '<div class="d-flex">';
                $action .= '<a class="btn btn-info btn-sm" title="'. trans("cruds.global.edit") .'" href="'.route("admin.plan.edit", $record->id).'">
                    <i class="fas fa-pencil-alt"></i>
                </a>';
                // $action .= '<form action="'.route('admin.tag.destroy', $record->id).'" method="POST" class="deleteForm">
                //             <input type="hidden" name="_method" value="DELETE"> 
                //             <input type="hidden" name="_token" value="'.csrf_token().'">
                //             <button class="btn btn-danger record_delete_btn btn-sm" title="'. trans("cruds.global.delete") .'"><i class="fas fa-trash-alt"></i></button></form>';
                $action .= '</div>';
                //$action .= '</div>';
                return $action;
            })
            ->rawColumns(['title','status','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Plan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Plan $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('plans-table')
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
        // return [
        //     Column::computed('action')
        //           ->exportable(false)
        //           ->printable(false)
        //           ->width(60)
        //           ->addClass('text-center'),
        //     Column::make('id'),
        //     Column::make('add your columns'),
        //     Column::make('created_at'),
        //     Column::make('updated_at'),
        // ];

        return [
            Column::make('DT_RowIndex')->title('#')->orderable(false)->searchable(false),
            Column::make('title_en')->title(trans("cruds.plan.fields.title").' <small>('. trans('cruds.lang.english') .')</small>'),
            Column::make('title_ch')->title(trans("cruds.plan.fields.title").' <small>('. trans('cruds.lang.chinese') .')</small>'),
            Column::make('amount')->title(trans("cruds.plan.fields.amount")),
            Column::make('points')->title(trans("cruds.plan.fields.points")),
            Column::computed('status')->title(trans("cruds.global.status"))->orderable(false)->searchable(false),
            Column::make('created_at')->title(trans("cruds.global.created_date"))->orderable(false)->searchable(false),
            Column::computed('action')->title(trans("cruds.global.action"))->orderable(false)->searchable(false)
        ];  
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Plans_' . date('YmdHis');
    }
}
