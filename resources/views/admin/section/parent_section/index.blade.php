@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{trans("cruds.section_management.parent_section.title")}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
              <li class="breadcrumb-item">{{trans("cruds.section_management.title_singular")}}</li>
              <li class="breadcrumb-item active">{{trans("cruds.section_management.parent_section.title")}}</li>
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
                <h3 class="card-title">{{trans("cruds.section_management.parent_section.title_singular")}}</h3>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{route('admin.parent-section.create')}}" style="float:right">{{trans("cruds.global.add")}}  {{trans("cruds.section_management.parent_section.title_singular")}}</a>
                </div>
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
            text: "{{trans('section_management.parent_section.delete_message')}}",
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
    
    $(document).on('change click', '.user_status', function(event) {
      var id = $(this).attr("data-status-id");
      var status = $(this).val();
      Swal.fire({
          title: "{{trans('messages.are_you_sure')}}",
          text: "{{trans('messages.update_warning')}}",
          icon: "question",
          showCancelButton: true,
          confirmButtonText: `{{trans('cruds.global.update')}}`,
          cancelButtonText: `{{trans('cruds.global.cancel')}}`,
      })
      .then((result) => {

          if (!result.isDismissed) {
              $.ajax({
                  type: "POST",
                  url: "{{route('admin.section.parent-section.updateStatus')}}",
                  data: {
                      _token: "{{csrf_token()}}",
                      id: id,
                      status: status,
                  },
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(response) {
                      toastr.success(response.message, '{{trans("global.alert.success")}}');
                      $('table').DataTable().ajax.reload(null, false);
                  },
                  error: function(response) {
                      let errorMessages = '';
                      $.each(response.responseJSON.errors, function(key, value) {
                          $.each(value, function(i, message) {
                              errorMessages += '<li>' + message + '</li>';
                          });
                      });
                      toastr.error(errorMessages);
                  },
                  complete: function() {
                      // $('#pageloader').css('display', 'none');
                  }
              });
          } else {
              // $('#pageloader').css('display', 'none');
              $('table').DataTable().ajax.reload(null, false);
              return false;
          }
      });
    });
  });
</script>
@endsection

