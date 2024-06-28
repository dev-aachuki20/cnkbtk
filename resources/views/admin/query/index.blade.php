@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{trans("cruds.enquiries.title")}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
              <li class="breadcrumb-item active">{{trans("cruds.enquiries.title")}}</li>
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
                <h3 class="card-title">{{trans("cruds.enquiries.title")}}</h3>
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


  <div class="modal fade" id="viewEnquiryModal" tabindex="-1" aria-labelledby="blackListModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="blackListModalLabel">{{trans('global.view')}} {{trans('global.details')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{trans('cruds.global.cancel')}}</button>
            </div>
        </div>
    </div>
</div>




  <!-- view enquiryModal -->
  {{-- <div id="viewEnquiryModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content query">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">View Details</h4>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>  
    </div>
  </div> --}}

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
                            fireSuccessSwal("{{trans('global.alert.success')}}",response.message.message);
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

    // VIEW ENQUIERY DETAILS
    $(document).on('click', '#viewEnquiery', function(e){
      e.preventDefault();
      var id = $(this).data('id');
      var url = '{{ route("admin.query.show", ":id") }}';
      url = url.replace(':id', id);
      $('#viewEnquiryModal .modal-body').html('');
        $.ajax({
            url: url, 
            method: 'GET',
            success: function(data) {
                console.log(data);
                $('#viewEnquiryModal .modal-body').html(`<p>Email: ${data.email}</p><p>Subject: ${data.subject}</p><p>Message: ${data.message}</p>`);
            },
            error: function(xhr, status, error) {
                $('#modal-content').html('<p>Error loading data. Please try again later.</p>');
                console.error('Failed to fetch data:', error);
            }
        });
    });
   
  });
</script>
@endsection

