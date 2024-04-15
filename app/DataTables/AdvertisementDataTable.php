<?php

namespace App\DataTables;

use App\Models\Advertisement;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdvertisementDataTable extends DataTable
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
            ->editColumn('image_en', function($record) {
                $imagePath = null;
                if(isset($record->image_en) && !empty($record->image_en)){
                    $imagePath = asset('storage/'. $record->image_en);
                   
                    $html =  '<a href="javascript:void(0)" >
                                    <img class="profile-user-img img-fluid" src="'.$imagePath.'" >
                            </a>';
                    return $html;
                }else{
                    return  "N/A";
                }

            }) 
            ->editColumn('image_ch', function($record) {

                $imagePath = null;
                if(isset($record->image_ch) && !empty($record->image_ch)){
                    $imagePath = asset('storage/'. $record->image_ch);
                  
                    $html =  '<a href="javascript:void(0)" >
                                    <img class="profile-user-img img-fluid" src="'.$imagePath.'"  >
                            </a>';
                    return $html;
                }else{
                    return  "N/A";
                }
                return $record->image_ch ?? "N/A";
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
                $action .= '<a class="btn btn-primary btn-sm" title="'. trans("cruds.global.view") .'" href="'.route('admin.advertisement.show', $record->id).'">
                                <i class="fas fa-eye"></i>
                            </a>';
                $action .= '<a class="btn btn-info btn-sm" title="'. trans("cruds.global.edit") .'" href="'.route("admin.advertisement.edit", $record->id).'">
                                <i class="fas fa-pencil-alt"></i>
                            </a>';
                $action .= '<form action="'.route('admin.advertisement.destroy', $record->id).'" method="POST" class="deleteForm">
                            <input type="hidden" name="_method" value="DELETE"> 
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <button class="btn btn-danger record_delete_btn btn-sm" title="'. trans("cruds.global.delete") .'"><i class="fas fa-trash-alt"></i></button></form>';
                $action .= '</div>';
                return $action;
            })
            ->rawColumns(['image_en','image_ch','status','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Advertisement $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Advertisement $model)
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
        ->setTableId('advertisement-table')
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->dom('lfrtip')
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
            'language' => ['url' => getLangUrl()],
            'columnDefs' => [
                    [
                        "orderable" => false,
                        'targets'  => '_all',
                    ] 
            ],
            'orders' => []
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
            Column::computed('image_en')->title(trans("cruds.advertisement.fields.image").' <small>('. trans('cruds.lang.english') .')</small>')->orderable(false),
            Column::computed('image_ch')->title(trans("cruds.advertisement.fields.image").' <small>('. trans('cruds.lang.chinese') .')</small>'),
            Column::computed('status')->title(trans("cruds.global.status"))->orderable(false)->searchable(false),
            Column::make('created_at')->title(trans("cruds.global.created_date"))->orderable(false)->searchable(false)->sortable(false),
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
        return 'Advertisement_' . date('YmdHis');
    }
}
