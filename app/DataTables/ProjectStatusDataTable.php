<?php

namespace App\DataTables;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProjectStatusDataTable extends DataTable
{
    public function dataTable($query)
    {

        return datatables()
            ->eloquent($query->with('creators'))
            ->addIndexColumn()
            ->editColumn('created_at', function ($record) {
                return $record->created_at->format(config('app.date_format'));
            })


            ->addColumn('action', function ($record) {
                $action  = '<div class="d-flex">';
                $action .= '<a class="btn btn-primary btn-sm" title="' . trans("cruds.global.view") . '" href="' . route('user.project.show', $record->id) . '">
                <i class="fa fa-pencil"></i>
            </a>';
                $action .= '</div>';
                return $action;
            })
            ->rawColumns(['tags_id', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Project $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Project $model)
    {
        $auth = Auth::user()->id;
        return $model->where('user_id', $auth)->where('project_status', 1)->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('tag-table')
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
            // Column::make('creators.creator_id')->title(trans("Creator name")),
            // Column::make('creators.bid')->title(trans("Creator name")),
            Column::make('created_at')->title(trans("cruds.global.created_date"))->orderable(false)->searchable(false),
            Column::computed('action')->title(trans("cruds.global.action"))->orderable(false)->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'BlacklistTag_' . date('YmdHis');
    }
}
