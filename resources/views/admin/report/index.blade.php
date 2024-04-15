@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{trans("cruds.reports.title_singular")}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
              <li class="breadcrumb-item active">{{trans("cruds.reports.title_singular")}}</li>
            </ol>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    
      <div class="container-fluid">
       
        <div class="row">
          <div class="col-12">
           
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">{{trans("cruds.reports.title_singular")}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive normal_width_table">
                        <div class="clearfix"></div>
                        {{$dataTable->table(['class' => 'table table-bordered table-striped', 'style' => 'width:100%;'])}}
                    </div>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('scripts')
{!! $dataTable->scripts() !!}
<script type="text/javascript">
  $(document).ready( function(){
    $(document).on('submit', '.deleteForm', function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        var url = $(this).attr('action');
        
        swal.fire({
            title: "{{trans('messages.are_you_sure')}}",
            text: "{{trans('messages.delete_warning')}}",
            icon: 'question',
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "{{trans('cruds.global.delete_btn_text')}}",
            cancelButtonText: "{{trans('cruds.global.cancel_delete_btn_text')}}",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                $.ajax({
                    type: 'delete',
                    url: url,
                    data: formData,
                    dataType: 'JSON',
                    success: function (response) {
                        if (response.success == true) {
                          toastr.success(response.message.message, '{{trans("global.alert.success")}}');
                          $('table').DataTable().ajax.reload(null, false);
                        } else {
                            fireErrorSwal("{{trans('global.alert.error')}}",response.message.message);
                        }
                    }
                });

            } else {
                e.dismiss;
            }
        });
    });
   
  });
</script>
@endsection

