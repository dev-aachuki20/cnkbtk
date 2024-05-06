@extends('layouts.app')
@section('content')

<!-- hero privacy  -->
<section class="privacy-hero">
    <div class="container">
        <div class="hero-banner">
            <div class="prc-title">
                <h2>{{trans("cruds.global.view")}} {{trans('cruds.create_project.project_details')}}</h2>
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
                    {{trans('cruds.create_project.project_details')}}
                </li>
            </ol>
        </nav>
    </div>
</section>
<section class="single-wrapper ">
    <div class="container">
        <div class="row g-3">
            @foreach($allRequestProjects as $item)
            <div class="col-lg-6 col-md-10 col-12">
                <div class="right-single-box blacklist_box_user project_details_card">
                    <div class="row gx-3">

                        <div class="col">
                            <ul>
                                <li>
                                    <div class="main-title">
                                        <h6> <span>{{trans("cruds.create_project.fields.user_name")}} :</span> {{ $item['project']->user->user_name  ?? ''}}</h6>
                                    </div>
                                </li>
                                <li>
                                    <div class="main-title">
                                        <h6> <span>{{trans("cruds.create_project.project")}} {{trans("cruds.create_project.fields.type")}} :</span> {{ $item['project']->type  ?? ''}}</h6>
                                    </div>
                                </li>
                                <li>
                                    <div class="description-text main-title">
                                        <h6> <span>{{trans("cruds.create_project.fields.tags")}} :</span>
                                            @if(app()->getLocale() == 'en')
                                            {{ $item['project']->tags->name_en ?? '' }}
                                            @else
                                            {{ $item['project']->tags->name_ch ?? '' }}
                                            @endif
                                        </h6>
                                    </div>
                                </li>

                                <li>
                                    <div class="main-title">
                                        <h6> <span>{{trans("cruds.create_project.fields.budget")}} :</span>{{ $item['project']->budget  ?? ''}} CN¥</h6>
                                    </div>
                                </li>

                                <li>
                                    <div class="main-title">
                                        <h6> <span>{{trans("cruds.create_project.project")}} {{trans("cruds.create_project.fields.description")}} :</span> {!! $item['project']->comment ?? '' !!}</h6>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        @if(isset($item['status']) && $item['status'] == 0)
                        <div class="row">
                            <div class="col-3">
                                <button type="button" class="btn btn-primary ml-3 cancel-btn" id="cancel" data-project-id="{{$item['project']->id}}" data-user-id="{{$item['project']->user_id}}" data-creator-id="{{Auth::user()->id}}" {{ $item['status'] == 0 ? 'disabled' : '' }}>
                                    {{ $item['status'] == 0 ? 'Cancelled Project' : 'Cancel Project' }}
                                </button>
                            </div>
                        </div>
                        @elseif($item['status'] == 1)
                        <div class="row">
                            <div class="col-3">
                                <button type="button" class="btn btn-success ml-3 confirm-btn" id="confirm" data-project-id="{{$item['project']->id}}" data-user-id="{{$item['project']->user_id}}" data-creator-id="{{Auth::user()->id}}" {{ $item['status'] == 1 ? 'disabled' : '' }}>
                                    {{ $item['status'] == 1 ? 'Confirmed Project' : 'Confirm Project' }}
                                </button>
                            </div>
                        </div>
                        @elseif($item['status'] == 2)
                        <div class="row">
                            <div class="col-3">
                                <button type="button" class="btn btn-secondary add-bid-btn" id="addBidModal" data-project-id="{{$item['project']->id}}" data-user-id="{{$item['project']->user_id}}" data-creator-id="{{Auth::user()->id}}" {{ $item['status'] == 2 ? 'disabled' : '' }}>
                                    {{ $item['status'] == 2 ? 'Project Bid Added' : 'Add Your Bid' }}
                                </button>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-3">
                                <button type="button" class="btn btn-secondary add-bid-btn" id="addBidModal" data-project-id="{{$item['project']->id}}" data-user-id="{{$item['project']->user_id}}" data-creator-id="{{Auth::user()->id}}">
                                    Add Your Bid
                                </button>
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-success ml-3 confirm-btn" id="confirm" data-project-id="{{$item['project']->id}}" data-user-id="{{$item['project']->user_id}}" data-creator-id="{{Auth::user()->id}}">
                                    Confirm Project
                                </button>
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-primary ml-3 cancel-btn" id="cancel" data-project-id="{{$item['project']->id}}" data-user-id="{{$item['project']->user_id}}" data-creator-id="{{Auth::user()->id}}">
                                    Cancel Project
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <!-- Bid Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Bid Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- form start -->
                <form action="{{route('user.add.project.bid')}}" method="post" id="addBidForm">
                    <div class="modal-body">
                        <input type="hidden" id="auth_id" value="">
                        <input type="hidden" id="project_id" value="">
                        <input type="hidden" id="user_id" value="">
                        <div class="mb-4">
                            <div class="form-group">
                                <label for="budget">{{__('cruds.create_project.fields.budget')}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="bid" id="budget" placeholder="{{trans("global.enter")}} {{__('cruds.create_project.fields.budget')}}" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
                <!-- form end -->
            </div>
        </div>
    </div>
</section>
@endsection

@section("scripts")
<script>
    $(document).ready(function() {
        $(document).on("click", "#addBidModal", function(e) {
            var projectId = $(this).data('project-id');
            var userId = $(this).data('user-id');
            var creatorId = $(this).data('creator-id');

            $('#project_id').val(projectId);
            $('#user_id').val(userId);
            $('#auth_id').val(creatorId);

            $('#exampleModal').modal('show');
        });

        $(document).on("submit", "#addBidForm", function(e) {
            e.preventDefault();
            $('#cancel').hide();
            $('#confirm').hide();
            var formData = new FormData(this);
            var project_id = $('#project_id').val();
            var auth_id = $('#auth_id').val();
            var user_id = $('#user_id').val();

            formData.append("auth_id", auth_id);
            formData.append("project_id", project_id);
            formData.append("user_id", user_id);

            var url = $(this).attr('action');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content')
                },
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(response) {
                    showLoader();
                    $(".text-danger.errors").remove();
                },
                success: function(response) {
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);

                },
                error: function(jqXHR, exception) {
                    if (jqXHR.status == 422) {
                        $(".errors").remove();
                        $("#" + index).parents(".form-group").append("<span class='text-danger errors'>" + message + "</span>");
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

        // confirm project
        $(document).on("click", "#confirm", function(e) {
            e.preventDefault();

            var projectId = $(this).data('project-id');
            var userId = $(this).data('user-id');
            var creatorId = $(this).data('creator-id');

            var url = "{{ route('user.project.confirm') }}";
            var confirmButton = $(this);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content')
                },
                type: 'GET',
                url: url,
                data: {
                    projectId: projectId,
                    userId: userId,
                    creatorId: creatorId,
                },
                beforeSend: function(response) {
                    showLoader();
                    $(".text-danger.errors").remove();
                },
                success: function(response) {
                    toastr.success(response.message);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    toastr.error("Error occurred while confirming project: " + error);
                },
                complete: function() {
                    hideLoader();
                }
            });
        });

        // cancel project
        $(document).on("click", "#cancel", function(e) {
            e.preventDefault();

            var projectId = $(this).data('project-id');
            var userId = $(this).data('user-id');
            var creatorId = $(this).data('creator-id');

            var url = "{{ route('user.project.cancel') }}";
            var confirmButton = $(this);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content')
                },
                type: 'GET',
                url: url,
                data: {
                    projectId: projectId,
                    userId: userId,
                    creatorId: creatorId,
                },
                beforeSend: function(response) {
                    showLoader();
                    $(".text-danger.errors").remove();
                },
                success: function(response) {
                    toastr.success(response.message);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    toastr.error("Error occurred while confirming project: " + error);
                },
                complete: function() {
                    hideLoader();
                }
            });
        });
    });
</script>
@endsection