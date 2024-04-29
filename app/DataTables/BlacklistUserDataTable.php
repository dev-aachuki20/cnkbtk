<?php

namespace App\DataTables;

use App\Models\BlacklistTag;
use App\Models\BlacklistUser;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BlacklistUserDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query->with('user'))
            ->addIndexColumn()
            ->editColumn('user.user_name', function ($record) {
                return $record->user->user_name ?? '';
            })
            ->editColumn('created_at', function ($record) {
                return $record->created_at->format(config('app.date_format'));
            })

            ->editColumn('email', function ($record) {
                return $record->email ?? "";
            })
            ->editColumn('ip_address', function ($record) {
                return $record->ip_address ?? "";
            })
            ->editColumn('blacklist_tag_id', function ($record) {
                $language = app()->getLocale();
                if ($record->blacklistTag) {
                    return $language === 'en' ? ucfirst($record->blacklistTag->name_en) : ucfirst($record->blacklistTag->name_ch);
                }
                return '';
            })

            ->addColumn('action', function ($record) {
                $action  = '<div class="d-flex">';
                $action .= '<a class="btn btn-primary btn-sm" title="' . trans("cruds.global.view") . '" href="' . route('blacklist.user.show', $record->id) . '">
                <i class="fas fa-eye"></i>
                            </a>';
                $action .= '<a class="btn btn-info btn-sm" title="' . trans("cruds.global.edit") . '" href="' . route("admin.blacklist-tag.edit", $record->id) . '">
                <i class="fas fa-pencil-alt"></i>
                </a>';
                $action .= '</div>';
                return $action;
            })
            ->rawColumns(['email', 'ip_address', 'blacklist_tag_id', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\BlacklistUser $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BlacklistUser $model)
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
            Column::make('user.user_name')->title('Username')->orderable(false),
            Column::make('email')->title(trans("pages.blacklist_user.form.fields.email")),
            Column::computed('ip_address')->title(trans("pages.blacklist_user.form.fields.ip_address"))->searchable(true),
            Column::make('blacklist_tag_id')->title(trans("pages.blacklist_user.form.fields.reason"))->searchable(true),
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
        return 'BlacklistTag_' . date('YmdHis');
    }
}
