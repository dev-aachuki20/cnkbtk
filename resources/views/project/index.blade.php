@extends('layouts.app')
@section("styles")
<link rel="stylesheet" href="{{ asset('admins/plugins/sweetalert2/sweetalert2.min.css') }}">
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('admins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admins/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section("content")
<!-- hero privacy  -->
<section class="privacy-hero">
    <div class="container">
        <div class="hero-banner">
            <div class="prc-title">
                <h2>{{__('cruds.create_project.projects')}}</h2>
            </div>
        </div>
    </div>
</section>
<!-- end  -->

<section class="breadcrumb-wrap">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans("global.home")}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{__('cruds.create_project.projects')}}
                </li>
            </ol>
        </nav>
    </div>
</section>

<div class="profile-wrapper-cp">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <div class="categories-details">
                    <div class="categories-details-head p-3">
                        <div class="row g-3 align-items-center">
                            <div class="col">
                                <div class="categories-left-content pe-0">
                                    <div class="categories-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                                            <g id="Line">
                                                <path d="M27,29.75H11A2.75,2.75,0,0,1,8.25,27v-.45a7.75,7.75,0,0,1,0-15.1V5A2.75,2.75,0,0,1,11,2.25H22.17a2.74,2.74,0,0,1,1.95.81l4.82,4.82a2.74,2.74,0,0,1,.81,2V27A2.75,2.75,0,0,1,27,29.75Zm-17.25-3V27A1.25,1.25,0,0,0,11,28.25H27A1.25,1.25,0,0,0,28.25,27V10.75H24A2.75,2.75,0,0,1,21.25,8V3.75H11A1.25,1.25,0,0,0,9.75,5v6.25H10a7.75,7.75,0,0,1,0,15.5Zm.25-14A6.25,6.25,0,1,0,16.25,19,6.25,6.25,0,0,0,10,12.75ZM22.75,3.89V8A1.25,1.25,0,0,0,24,9.25h4.11a1.39,1.39,0,0,0-.23-.31L23.06,4.12A1.39,1.39,0,0,0,22.75,3.89ZM25,22.75H20a.75.75,0,0,1,0-1.5h5a.75.75,0,0,1,0,1.5ZM8.5,21.25A.74.74,0,0,1,8,21,.75.75,0,0,1,8,20l1.28-1.28V16a.75.75,0,0,1,1.5,0v3a.75.75,0,0,1-.22.53L9,21A.74.74,0,0,1,8.5,21.25ZM25,18.75H21a.75.75,0,0,1,0-1.5h4a.75.75,0,0,1,0,1.5Zm0-4H20a.75.75,0,0,1,0-1.5h5a.75.75,0,0,1,0,1.5Zm-7-4H15a.75.75,0,0,1,0-1.5h3a.75.75,0,0,1,0,1.5Z" />
                                            </g>
                                        </svg>
                                    </div>
                                    <h5 class="categories-details-title text-nowrap"> {{__('cruds.create_project.projects')}}</h5>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="row g-3">
                                    <div class="col-auto">
                                        <div class="edit-post">
                                            <a href="{{route('user.project.create')}}" title="{{__('cruds.create_project.create')}} {{__('cruds.create_project.project')}}">
                                                <svg id="_x31__px" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="m9.02 21h-6.52c-1.378 0-2.5-1.121-2.5-2.5v-16c0-1.379 1.122-2.5 2.5-2.5h12c1.378 0 2.5 1.121 2.5 2.5v6.06c0 .276-.224.5-.5.5s-.5-.224-.5-.5v-6.06c0-.827-.673-1.5-1.5-1.5h-12c-.827 0-1.5.673-1.5 1.5v16c0 .827.673 1.5 1.5 1.5h6.52c.276 0 .5.224.5.5s-.224.5-.5.5z"></path>
                                                    <path d="m13.5 9h-10c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h10c.276 0 .5.224.5.5s-.224.5-.5.5z"></path>
                                                    <path d="m9.5 13h-6c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h6c.276 0 .5.224.5.5s-.224.5-.5.5z"></path>
                                                    <path d="m8.5 5h-5c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h5c.276 0 .5.224.5.5s-.224.5-.5.5z"></path>
                                                    <path d="m17.5 24c-3.584 0-6.5-2.916-6.5-6.5s2.916-6.5 6.5-6.5 6.5 2.916 6.5 6.5-2.916 6.5-6.5 6.5zm0-12c-3.033 0-5.5 2.468-5.5 5.5s2.467 5.5 5.5 5.5 5.5-2.468 5.5-5.5-2.467-5.5-5.5-5.5z"></path>
                                                    <path d="m17.5 21c-.276 0-.5-.224-.5-.5v-6c0-.276.224-.5.5-.5s.5.224.5.5v6c0 .276-.224.5-.5.5z"></path>
                                                    <path d="m20.5 18h-6c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h6c.276 0 .5.224.5.5s-.224.5-.5.5z"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body mt-4">
                        <div class="table-responsive normal_width_table">
                            <div class="clearfix"></div>
                            {{$dataTable->table(['class' => 'table table-bordered table-striped align-middle', 'style' => 'width:100%;'])}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Finish Project Modal -->
<div class="modal fade" id="finishProjectModal" tabindex="-1" aria-labelledby="finishProjectModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="finishProjectForm" action="{{ route('finish.project') }}" method="POST">
                @csrf
                <input type="hidden" name="project_id" id="project_id" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="finishProjectModalLabel">{{ trans('cruds.finished_project.options.add_remark') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="remark" class="form-label">{{ trans('cruds.finished_project.fields.remark') }}</label>
                        <textarea class="form-control" id="remark" name="remark" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('cruds.global.close') }}</button> --}}
                    <button type="submit" class="btn btn-primary">{{ trans('cruds.global.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="{{ asset('admins/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<!-- Datatables -->
<script src="{{ asset('admins/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('admins/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('admins/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('admins/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('admins/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('admins/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('admins/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('admins/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('admins/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('admins/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('admins/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('admins/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{ asset('admins/js/common.js')}}"></script>
{!! $dataTable->scripts() !!}
<script>
    $(document).ready(function() {
        $(document).on('submit', '.deleteProject', function(e) {
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
            }).then(function(e) {
                if (e.value === true) {
                    $.ajax({
                        type: 'delete',
                        url: url,
                        data: formData,
                        dataType: 'JSON',
                        success: function(response) {
                            toastr.success(response.message);
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        }
                    });

                } else {
                    e.dismiss;
                }
            });
        });

        $(document).on('click', '.finish_project', function(e){
            e.preventDefault();
            var url = $(this).data('href');
            var projectId = $(this).data('project-id');
            
            // Set project ID in the form
            $('#project_id').val(projectId);

            // Show the modal
            $('#finishProjectModal').modal('show');
        });

        $('#finishProjectForm').on('submit', function(e){
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var formData = form.serialize();

            swal.fire({
                // title: "{{trans('messages.are_you_sure')}}",
                text: "{{trans('messages.finished_project_warning_message')}}",
                icon: 'warning',
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "{{trans('cruds.finished_project.options.finish_btn_text')}}",
                cancelButtonText: "{{trans('cruds.global.cancel_delete_btn_text')}}",
                reverseButtons: !0
            }).then(function(e) {
                if (e.value === true) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content')
                        },
                        type: 'POST',
                        url: url,
                        data: formData,
                        dataType: 'JSON',
                        success: function(response) {
                            toastr.success(response.message);
                            $('#finishProjectModal').modal('hide');
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        },
                        error: function(response) {
                            if (response.responseJSON.errors && response.responseJSON.errors.remark) {
                                var errorMessage = response.responseJSON.errors.remark[0];
                                $('#remark').after('<div id="remark-error" class="text-danger mt-2">' + errorMessage + '</div>');
                            } else {
                                var errorMessage = response.responseJSON.message || 'An error occurred. Please try again.';
                                $('#remark').after('<div id="remark-error" class="text-danger mt-2">' + errorMessage + '</div>');
                            }
                        }
                        
                    });
                } else {
                    e.dismiss;
                }
            });
        });


        // Reset form values when the modal is hidden
        $('#finishProjectModal').on('hidden.bs.modal', function() {
            $('#finishProjectForm')[0].reset();
            $('#remark-error').remove();
        });
    });
</script>
@endsection