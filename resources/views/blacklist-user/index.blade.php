@extends('layouts.app')
@section("styles")
<link rel="stylesheet" href="{{ asset('admins/plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admins/plugins/fontawesome-free/css/all.min.css')}}">
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('admins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admins/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<style>
    form#excelForm input#excel_file::file-selector-button {
        display: none;
    }

    input#excel_file {
        color: #fff;
    }

    form#excelForm {
        margin: 1rem 0;
        background-color: #fd615a;
        width: fit-content;
        padding: 7px;
        border-radius: 5px;
    }
</style>
@endsection
@section("content")
<!-- hero privacy  -->
<section class="privacy-hero">
    <div class="container">
        <div class="hero-banner">
            <div class="prc-title">
                <h2>{{trans("pages.user.blacklist_user_tab.blacklist")}} <span>{{trans("pages.user.blacklist_user_tab.user")}}</span></h2>
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
                    {{trans("global.blacklist_user")}}
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
                                    <h5 class="categories-details-title text-nowrap"> {{trans("global.blacklist_user")}}</h5>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="row g-3">
                                    <div class="col-auto d-flex">
                                        <!-- View Sample Excel File -->
                                        <button type="button" class="btn btn-primary px-3" id="openSampleFileBtn">Sample Excel File</button>
                                    </div>
                                    <div class="col-auto d-flex">
                                        <!-- Excel import Form -->
                                        <form class="m-0 px-3" id="excelForm" action="{{ route('blacklist.user.import') }}" method="POST" enctype="multipart/form-data">
                                            <label for="excel_file" class="btn btn-primary p-0 text-white">Import Excel</label>
                                            <input type="file" name="excel_file" id="excel_file" value="Import Excel" hidden>
                                        </form>
                                    </div>
                                    <div class="col-auto">
                                        {{--
                                <div class="edit-post">
                                    <a href="{{route('blacklist.user.create')}}" title="{{trans('global.add')}} {{trans('global.blacklist_user')}}">
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
                                    --}}

                                    <div class="edit-post">
                                        <a data-bs-toggle="modal" data-bs-target="#blackListModal" title="{{trans('global.add')}} {{trans('global.blacklist_user')}}">
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
                        {{$dataTable->table(['class' => 'table table-bordered table-striped', 'style' => 'width:100%;'])}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>


<!-- Modal Start Blacklist user-->
<div class="modal fade" id="blackListModal" tabindex="-1" aria-labelledby="blackListModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="blackListModalLabel">Add Blacklist User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form data-url="{{ route('blacklist.user.store') }}" id="addBlacklistForm">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group">
                                    <label for="">{{trans("pages.blacklist_user.form.fields.email")}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="{{trans("global.enter")}} {{trans("pages.blacklist_user.form.fields.email")}}" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group">
                                    <label for="">{{trans("pages.blacklist_user.form.fields.ip_address")}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="ip_address" id="ip_address" placeholder="{{trans("global.enter")}} {{trans("pages.blacklist_user.form.fields.ip_address")}}" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group">
                                    <label for="">{{trans("pages.blacklist_user.form.fields.reason")}} <span class="text-danger">*</span></label>
                                    <select name="blacklist_tag_id" id="blacklist_tag_id" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($balcklistTag as $tag)
                                        <option value="{{$tag->id}}">{{app()->getLocale() == 'en' ? $tag->name_en : $tag->name_ch}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="submitBtn">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->
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
        // Import Blacklist user data by importing a file
        $('#excel_file').change(function(e) {
            var file = e.target.files[0];
            var formData = new FormData();
            formData.append('excel_file', file);

            var url = "{{route('blacklist.user.import')}}";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content')
                },
                type: 'POST',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function(response) {
                    showLoader();
                },
                success: function(response) {
                    $("#excelForm").trigger("reset");
                    toastr.success(response.message);
                },
                complete: function() {
                    hideLoader();
                }
            }).fail(function(xhr) {
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    toastr.error(Object.values(errors)[0][0]);
                } else {
                    toastr.error('An error occurred while uploading the file.');
                }
            });
        });



        // Add blacklist user data by form
        $('#submitBtn').click(function(e) {
            e.preventDefault();
            var formData = $('#addBlacklistForm').serialize();
            console.log(formData);
            var url = "{{ route('blacklist.user.store') }}";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content')
                },
                type: 'POST',
                url: url,
                data: formData,
                dataType: 'json',
                beforeSend: function(response) {
                    showLoader();
                },
                success: function(response) {
                    $("#addBlacklistForm").trigger("reset");
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'Okay!'
                    }).then((result) => {
                        location.reload();
                    })
                },
                error: function(jqXHR, exception) {
                    if (jqXHR.status == 422) {
                        $(".errors").remove();
                        $.each(jqXHR.responseJSON.errors, function(index, value) {
                            if (index.indexOf(".") != -1) {
                                index = index.replace(/([.])+/g, '_');
                                index.replace(".", '_');
                            }
                            console.log(index);
                            $("#" + index).parents(".form-group").append("<span class='text-danger errors'>" + value + "</span>");

                        });
                    } else {
                        toastr.error(jqXHR.responseJSON.message, '{{trans("global.alert.error")}}');
                        location.reload();
                    }
                },
                complete: function() {
                    hideLoader();
                }
            });
        });
    });

    // View sample file
    $('#openSampleFileBtn').click(function() {
        window.open("{{ asset('sample_sheet_blacklist_user.xlsx') }}", '_blank');
    });
</script>

@endsection