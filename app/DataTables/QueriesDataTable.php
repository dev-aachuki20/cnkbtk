<?php

namespace App\DataTables;

use App\Models\Query;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class QueriesDataTable extends DataTable
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
            ->editColumn('email', function($record) {
                return $record->email ?? "N/A";
            }) 
            ->editColumn('subject', function($record) {
                return $record->subject ?? "N/A";
            }) 
            ->editColumn('message', function($record) {
                return $record->message ?? "N/A";
            }) 
           
            ->addColumn('action', function($record) {
                $action  = '<div class="d-flex">';

                $action .= '<form action="'.route('admin.query.destroy', $record->id).'" method="POST" class="deleteForm">
                            <input type="hidden" name="_method" value="DELETE"> 
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <button class="btn btn-danger record_delete_btn btn-sm" title="'. trans("cruds.global.delete") .'"><i class="fas fa-trash-alt"></i></button></form>';
            
                $action .= '</div>';
                return $action;
            })
            ->rawColumns(['email','subject','message','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Query $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Query $model)
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
        ->setTableId('enquiries-table')
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
            Column::make('email')->title(trans("cruds.enquiries.fields.email")),
            Column::make('subject')->title(trans("cruds.enquiries.fields.subject")),
            Column::make('message')->title(trans("cruds.enquiries.fields.message")),
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
        return 'Queries_' . date('YmdHis');
    }
}
