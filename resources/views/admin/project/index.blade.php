@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{trans('cruds.create_project.projects')}}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
            <li class="breadcrumb-item active">{{trans("cruds.create_project.projects")}}</li>
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
              <h3 class="card-title">{{trans("cruds.create_project.projects")}}</h3>
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
            url: "{{route('admin.projects.updateStatus')}}",
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

  $(document).ready(function() {
    
    window.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.rating input');
    
    for (let i = 0; i < stars.length; i++) {
        stars[i].addEventListener('click', function () {
            document.getElementById("star_rating").value = this.value;
        });
    }
});


  });
</script>
@endsection