<?php

namespace App\DataTables;

use App\Models\EmailTemplate;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EmailTemplateDataTable extends DataTable
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
            ->editColumn('updated_at', function($record) {
                return (!is_null($record->updated_at)) ? $record->updated_at->format(config('app.date_format')) : "";
            })
            ->editColumn('name', function($record) {
                return $record->name ?? "";
            })
            ->editColumn('subject', function($record) {
                return $record->subject ?? "";
            })   
            // ->editColumn('status', function ($record) {
            //     $checkedStatus = ($record->status == 1 ? 'checked' : '');
            //     $currentStatus = ($record->status == 1 ? trans("cruds.global.active") : trans("cruds.global.in_active"));
            //     $status = 1;
            //     if ($record->status == 1) {
            //         $status = 0;
            //     }

            //     $html = ' <div class="form-group custom-control custom-switch custom-switch-off-danger custom-switch-on-success"><input class="emailTemp_status custom-control-input" id="normal' . $record->id . '"  value="' . $status . '" ' . $checkedStatus . ' type="checkbox" name="status" data-status-id="' . $record->id . '"> <label class="custom-control-label" for="normal' . $record->id . '">'.$currentStatus.'</label></div>';

            //     return $html;
            // })             
                        
            ->addColumn('action', function($record) {
                $action  = '<div class="d-flex">';
            
                $action .= '<a class="btn btn-info btn-sm" title="'. trans("cruds.global.edit") .'" href="'.route("admin.email-templates.edit", $record->id).'">
                    <i class="fas fa-pencil-alt"></i>
                </a>';
                $action .= '</div>';
                return $action;
            })
            // ->filterColumn('created_at', function ($query, $keyword) {
            //     $query->whereRaw("DATE_FORMAT(created_at,'%d-%M-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
            // })
            //'status'
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\EmailTemplate $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(EmailTemplate $model)
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
            ->setTableId('email-template-table')
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
            Column::make('name')->title(trans("cruds.email_template.fields.name")),
            Column::make('subject')->title(trans("cruds.email_template.fields.subject")),
            //Column::computed('status')->title(trans("cruds.global.status"))->orderable(false)->searchable(false),
            Column::make('created_at')->title(trans("cruds.global.created_date"))->orderable(false)->searchable(false),
            Column::make('updated_at')->title(trans("cruds.global.updated_date"))->orderable(false)->searchable(false),
            Column::computed('action')->title(trans("cruds.global.action"))
                    ->exportable(false)
                    ->printable(false)
                    ->addClass('datatable_action'),
        ];
        
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'EmailTemplate_' . date('YmdHis');
    }
}
