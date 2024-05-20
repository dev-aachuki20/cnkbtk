<?php

namespace App\DataTables;
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

            // ->filterColumn('tags_id', function ($query, $keyword) {
            //     $query->whereHas('tags', function ($query) use ($keyword) {
            //         $query->where('name_en', 'like', "%$keyword%")
            //             ->orWhere('name_ch', 'like', "%$keyword%");
            //     });
            // })

            ->addColumn('action', function ($record) {
                $action  = '<div class="grid-icon">';

                if ($record->status == 1) {
                    $action .= '<a class="btn btn-primary btn-sm" title="' . trans("cruds.global.message") . '" href="' . route('message.index', ['projectId' => $record->id]) . '">
                    <i class="fa fa-commenting-o" aria-hidden="true"></i>
                </a>';
                }

                $action .= '<a class="btn btn-primary btn-sm" title="' . trans("cruds.global.view") . '" href="' . route('user.project.show', $record->id) . '">
                <i class="fa fa-eye"></i>
            </a>';
                if ($record->project_status != 1) {
                    $action .= '<a class="btn btn-primary btn-sm" title="' . trans("cruds.global.edit") . '" href="' . route("user.project.edit", $record->id) . '">
                <i class="fa fa-pencil"></i>
            </a>';

                    $action .= '<form action="' . route('user.project.destroy', $record->id) . '" method="POST" class="deleteProject">
            <input type="hidden" name="_method" value="DELETE"> 
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button class="btn btn-primary record_delete_btn btn-sm" title="' . trans("cruds.global.delete") . '"><i class="fa fa-trash-o"></i></button></form>';
                }
                if ($record->project_status == 1) {
                    $isFinished = $record->finish_status == 1;
                    $buttonTitle = trans("cruds.global.finish");
                    $svg = '
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7511 1.83817C11.0543 1.61011 10.1053 1.60003 7.99998 1.60003C6.87079 1.60003 6.06394 1.60046 5.4281 1.64385C4.79944 1.68673 4.39658 1.76893 4.06926 1.90451C3.08915 2.31048 2.31045 3.08918 1.90448 4.06929C1.76889 4.39662 1.68671 4.79947 1.64381 5.42813C1.60043 6.06397 1.6 6.87082 1.6 8.00002C1.6 9.12921 1.60043 9.93609 1.64381 10.5719C1.68671 11.2006 1.76889 11.6034 1.90448 11.9307C2.31045 12.9109 3.08915 13.6895 4.06926 14.0955C4.39658 14.2311 4.79944 14.3133 5.4281 14.3562C6.06394 14.3996 6.87079 14.4 7.99998 14.4C9.12918 14.4 9.93606 14.3996 10.5719 14.3562C11.2005 14.3133 11.6034 14.2311 11.9307 14.0955C12.9109 13.6895 13.6895 12.9109 14.0955 11.9307C14.2311 11.6034 14.3132 11.2006 14.3561 10.5719C14.3996 9.93609 14.4 9.12921 14.4 8.00002C14.4 7.38738 14.4 6.86706 14.3926 6.4129C14.3855 5.97113 14.7379 5.60724 15.1796 5.60013C15.6214 5.59301 15.9853 5.94536 15.9924 6.38713C16 6.85554 16 7.38826 16 7.9949V8.02946C16 9.12281 16 9.98409 15.9524 10.6808C15.904 11.391 15.8035 11.9882 15.5737 12.543C15.0053 13.9152 13.9152 15.0054 12.543 15.5738C11.9882 15.8035 11.3909 15.904 10.6808 15.9525C9.98406 16 9.12278 16 8.0295 16H7.97046C6.87719 16 6.01588 16 5.31919 15.9525C4.60906 15.904 4.01174 15.8035 3.45697 15.5738C2.08481 15.0054 0.994638 13.9152 0.426271 12.543C0.19648 11.9882 0.0959759 11.391 0.047528 10.6808C-7.92442e-06 9.98409 0 9.12281 0 8.02946V7.97058C0 6.87722 -7.92442e-06 6.0159 0.047528 5.31921C0.0959759 4.6091 0.19648 4.01177 0.426271 3.45699C0.994638 2.08484 2.08481 0.994671 3.45697 0.426304C4.01174 0.196505 4.60906 0.096009 5.31918 0.0475611C6.01587 2.51501e-05 6.87718 2.50739e-05 7.97054 3.30739e-05H7.99998C8.0579 3.30739e-05 8.11526 2.50522e-05 8.17198 1.70522e-05C10.0517 -0.000270947 11.2772 -0.000454973 12.2489 0.31756C12.6687 0.454992 12.8977 0.906807 12.7603 1.32672C12.6229 1.74662 12.171 1.97561 11.7511 1.83817ZM15.8909 2.39684C16.1136 2.77849 15.9847 3.26834 15.603 3.49096L15.4257 3.5944C12.5498 5.27201 10.2392 7.76874 8.78894 10.7657C8.67614 10.9987 8.45758 11.1628 8.2023 11.206C7.94702 11.2492 7.68662 11.1662 7.50342 10.9832L4.29266 7.77586C3.98008 7.46362 3.97981 6.95714 4.29206 6.6445C4.60431 6.33193 5.11084 6.33166 5.42343 6.64394L7.86382 9.08177C9.46022 6.23692 11.7901 3.8628 14.6195 2.21236L14.7968 2.10892C15.1784 1.8863 15.6683 2.0152 15.8909 2.39684Z" fill="white"/>
                        </svg>';
                
                    $disabledAttribute = $isFinished ? 'disabled' : '';
                    $action .= '<button class="btn btn-primary btn-sm finish_project" title="' . $buttonTitle . '" data-href="' . route("finish.project") . '" data-project-id="' . $record->id . '" ' . $disabledAttribute . '>
                        ' . $svg . '
                    </button>';
                }

                $action .= '</div>';
                return $action;
            })
            // ->rawColumns(['tags_id', 'status', 'action']);
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
            // ->orderBy([0, 'desc']) 
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
            // Column::make('id')->title('#'),
            Column::make('title')->title(trans("cruds.create_project.fields.title")),
            Column::make('type')->title(trans("cruds.create_project.fields.type")),
            // Column::make('tags_id')->title(trans("cruds.create_project.fields.tags")),
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
        return 'Project_' . date('YmdHis');
    }
}
