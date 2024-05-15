<?php

namespace App\DataTables;

use App\Models\BlacklistTag;
use App\Models\BlacklistUser;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;

class ProjectUserDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query->with('tags'))
            ->addIndexColumn()

            ->editColumn('title', function ($record) {
                return ucfirst($record->title) ?? '';
            })

            ->editColumn('created_at', function ($record) {
                return $record->created_at->format(config('app.date_format'));
            })
            ->editColumn('tags_id', function ($record) {
                $language = app()->getLocale();
                if ($record->tags) {
                    return $language === 'en' ? ucfirst($record->tags->name_en) : ucfirst($record->tags->name_ch);
                }
                return '';
            })

            ->editColumn('budget', function ($record) {
                return $record->budget . config("constant.currency.rmb") ?? '0.00';
            })

            ->editColumn('status', function ($record) {
                $checkedStatus = ($record->status == 1 ? 'checked' : '');
                $currentStatus = ($record->status == 1 ? trans("cruds.global.active") : trans("cruds.global.in_active"));
                $status = 1;
                if ($record->status == 1) {
                    $status = 0;
                }

                $html = ' <div class="form-group custom-control custom-switch custom-switch-off-danger custom-switch-on-success"><label class="custom-control-label" for="normal' . $record->id . '">' . $currentStatus . '</label></div>';
                return $html;
            })

            ->filterColumn('status', function ($query, $keyword) {
                $statusSearch  = null;
                if (Str::contains('active', strtolower($keyword))) {
                    $statusSearch = 1;
                } else if (Str::contains('inactive', strtolower($keyword))) {
                    $statusSearch = 0;
                }
                $query->where('projects.status', $statusSearch);
            })

            ->filterColumn('tags_id', function ($query, $keyword) {
                $query->whereHas('tags', function ($query) use ($keyword) {
                    $query->where('name_en', 'like', "%$keyword%")
                        ->orWhere('name_ch', 'like', "%$keyword%");
                });
            })

            ->addColumn('action', function ($record) {
                $action  = '<div class="d-flex">';
                $action .= '<a class="btn btn-success btn-sm" title="' . trans("cruds.global.view") . '" href="' . route('message.index', ['projectId' => $record->id]) . '">
                Message
            </a>';
                $action .= '<a class="btn btn-primary btn-sm" title="' . trans("cruds.global.view") . '" href="' . route('user.project.show', $record->id) . '">
                <i class="fa fa-eye"></i>
            </a>';
                if ($record->project_status != 1) {
                    $action .= '<a class="btn btn-primary btn-sm" title="' . trans("cruds.global.view") . '" href="' . route("user.project.edit", $record->id) . '">
                <i class="fa fa-pencil"></i>
            </a>';
                }
                $action .= '<form action="' . route('user.project.destroy', $record->id) . '" method="POST" class="deleteProject">
            <input type="hidden" name="_method" value="DELETE"> 
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button class="btn btn-danger record_delete_btn btn-sm" title="' . trans("cruds.global.delete") . '"><i class="fa fa-trash-o"></i></button></form>';
                $action .= '</div>';
                $action .= '</div>';
                return $action;
            })
            ->rawColumns(['tags_id', 'status', 'action']);
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
        return $model->where('user_id', $auth)->newQuery();
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
            Column::make('title')->title(trans("cruds.create_project.fields.title")),
            Column::make('type')->title(trans("cruds.create_project.fields.type")),
            Column::make('tags_id')->title(trans("cruds.create_project.fields.tags")),
            Column::make('budget')->title(trans("cruds.create_project.fields.budget")),
            Column::computed('status')->title(trans("cruds.global.status"))->orderable(false)->searchable(true),
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
