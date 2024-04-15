@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Permissions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
              <li class="breadcrumb-item active">Permissions</li>
            </ol>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    
      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb mb-2">
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('admin.permissions.create') }}">Add Permission</a>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-12">
           
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Permission List</h3>
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
    $(document).on('submit', '.deletePermissionForm', function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        var url = $(this).attr('action');
    
        swal.fire({
            title: "{{trans('messages.are_you_sure')}}",
            text: "{{trans('messages.update_warning')}}",
            icon: 'question',
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: `{{trans('cruds.global.update')}}`,
            cancelButtonText: `{{trans('cruds.global.cancel')}}`,
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
                            fireSuccessSwal("{{trans('global.alert.success')}}",response.message.message);
                            setTimeout(function(){
                                location.reload();
                            },1000);
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

