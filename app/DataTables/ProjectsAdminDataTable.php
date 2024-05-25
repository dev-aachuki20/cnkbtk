<?php

namespace App\DataTables;

use App\Models\Project;
use App\Models\Report;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;

class ProjectsAdminDataTable extends DataTable
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
            ->eloquent($query->with('user', 'tags')->select('projects.*'))
            ->addIndexColumn()
            ->editColumn('title', function ($record) {
                return ucfirst($record->title) ?? '';
            })
            ->editColumn('created_at', function ($record) {
                return $record->created_at->format(config('app.date_format'));
            })
            ->addColumn('user.username', function ($record) {
                return ucfirst($record->user->user_name) ?? "";
            })
            // ->editColumn('tags_id', function ($record) {
            //     $language = app()->getLocale();
            //     if ($record->tags) {
            //         return $language === 'en' ? ucfirst($record->tags->name_en) : ucfirst($record->tags->name_ch);
            //     }
            //     return '';
            // })

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

                if ($record->project_status != 1) {
                    $html = ' <div class="form-group custom-control custom-switch custom-switch-off-danger custom-switch-on-success"><input class="user_status custom-control-input" id="normal' . $record->id . '"  value="' . $status . '" ' . $checkedStatus . ' type="checkbox" name="status" data-status-id="' . $record->id . '"> <label class="custom-control-label" for="normal' . $record->id . '">' . $currentStatus . '</label></div>';
                } else {
                    $html = '';
                }
                return $html;
            })

            ->filterColumn('status', function ($query, $keyword) {
                $statusSearch  = null;
                if (Str::contains("{{__('cruds.status.active')}}", strtolower($keyword))) {
                    $statusSearch = 1;
                } else if (Str::contains("{{__('cruds.status.inactive')}}", strtolower($keyword))) {
                    $statusSearch = 0;
                }
                $query->where('projects.status', $statusSearch);
            })



            // ->filterColumn('tags_id', function ($query, $keyword) {
            //     $query->whereHas('tags', function ($query) use ($keyword) {
            //         $query->where('name_en', 'like', "%$keyword%")
            //             ->orWhere('name_ch', 'like', "%$keyword%");
            //     });
            // })
            ->addColumn('action', function ($record) {
                $action  = '<div class="d-flex">';

                $action .= '<a class="btn btn-primary btn-sm" title="' . trans("cruds.global.view") . '" href="' . route('admin.projects.show', $record->id) . '">
                <i class="fas fa-eye"></i>
            </a>';

                if ($record->project_status == 1) {
                    $svg = '
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 8.56667H17.1V8.46667V1V0.9H17H1H0.9V1V13.8V13.9H1H12.1697L16.9445 17.0832L17.1 17.1869V17V12.7333V12.6333H17H15.9333H15.8333V12.7333V14.6798L12.7888 12.6501L12.7636 12.6333H12.7333H2.16667V2.16667H15.8333V8.46667V8.56667H15.9333H17ZM17.1 9.53333V9.43333H17H15.9333H15.8333V9.53333V11.6667V11.7667H15.9333H17H17.1V11.6667V9.53333ZM13.4931 3.75169L13.4224 3.68097L13.3517 3.7517L8.38566 8.71878L5.61761 6.87307L5.53436 6.81755L5.4789 6.90084L4.88796 7.78831L4.83257 7.87151L4.91574 7.92694L8.47947 10.3024L8.54767 10.3479L8.60564 10.2899L14.2483 4.64832L14.319 4.57761L14.2483 4.50689L13.4931 3.75169Z" fill="white" stroke="white" stroke-width="0.2"/>
                    </svg>';
                    $action .= '<a class="btn btn-primary btn-sm" title="' . trans("cruds.global.read_chat") . '" href="' . route('admin.projects.readChat', $record->id) . '">' . $svg . '
            </a>';
                }

                $action .= '</div>';
                return $action;
            })
            ->rawColumns(['tags', 'status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Project $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Project $model)
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
            Column::make('user.user_name')->title(trans("cruds.create_project.fields.user_name")),
            Column::make('title')->title(trans("cruds.create_project.fields.title")),
            Column::make('type')->title(trans("cruds.create_project.fields.type")),
            // Column::make('tags_id')->title(trans("cruds.create_project.fields.tags")),
            Column::make('user_ip')->title(trans("cruds.create_project.fields.user_ip")),
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
        return 'Reports_' . date('YmdHis');
    }
}
