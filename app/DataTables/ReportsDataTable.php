<?php

namespace App\DataTables;

use App\Models\Report;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReportsDataTable extends DataTable
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
            ->eloquent($query->with("userData", "PosterData")->select('reports.*'))
            ->addIndexColumn()
            ->editColumn('created_at', function ($record) {
                return $record->created_at->format(config('app.date_format'));
            })
            ->addColumn('username', function ($record) {
                return $record->userData->user_name ?? "N/A";
            })
            // ->addColumn('PosterData.title', function ($record) {
            //     $html = '<a href="' . route("post.details", $record->PosterData->slug) . '">' . $record->PosterData->title ?? "N/A" . '</a>';
            //     return $html;
            // })

            ->addColumn('PosterData.title', function ($record) {
                $lang = app()->getLocale();

                $titleField = $lang === 'ch' ? 'title_ch' : 'title_en';
                $title = $record->PosterData->{$titleField} ?? 'N/A';
                $slug = $record->PosterData->slug ?? '#';
                $html = '<a href="' . route("post.details", $slug) . '">' . $title . '</a>';
                return $html;
            })

            ->editColumn('reason', function ($record) {
                return $record->reason ?? "N/A";
            })
            ->editColumn('description', function ($record) {
                return $record->description ?? "N/A";
            })

            ->filterColumn('username', function ($query, $keyword) {
                $query->whereHas('userData', function ($query) use ($keyword) {
                    $query->where('user_name', 'like', "%{$keyword}%");
                });
            })

            ->filterColumn('PosterData.title', function ($query, $keyword) {
                $query->whereHas('PosterData', function ($query) use ($keyword) {
                    $query->where('title_en', 'like', "%{$keyword}%")
                          ->orWhere('title_ch', 'like', "%{$keyword}%")
                          ->orWhere('slug', 'like', "%{$keyword}%");
                });
            })

            ->addColumn('action', function ($record) {
                $action  = '<div class="d-flex">';

                $action .= '<form action="' . route('admin.report.destroy', $record->id) . '" method="POST" class="deleteForm">
                        <input type="hidden" name="_method" value="DELETE"> 
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <button class="btn btn-danger record_delete_btn btn-sm" title="' . trans("cruds.global.delete") . '"><i class="fas fa-trash-alt"></i></button></form>';
                $action .= '</div>';
                return $action;
            })
            ->rawColumns(['username', 'PosterData.title', 'reason', 'description', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Report $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Report $model)
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
            ->setTableId('reports-table')
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
            Column::make('username')->title(trans("cruds.reports.fields.username")),
            Column::make('PosterData.title')->title(trans("cruds.reports.fields.poster")),
            Column::make('reason')->title(trans("cruds.reports.fields.reason")),
            Column::make('description')->title(trans("cruds.reports.fields.description")),
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
        return 'Reports_' . date('YmdHis');
    }
}
