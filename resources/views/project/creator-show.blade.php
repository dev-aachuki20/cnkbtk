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
            <a href="javascript:;" type="button" class="btn btn-dark px-3 btn-sm">
                <span>
                    <svg width="21" height="11" viewBox="0 0 21 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.70207e-09 5.25304C0.00151059 5.44731 0.0784183 5.63339 0.2145 5.77204L0.219 5.78104L4.719 10.281C4.86045 10.4177 5.0499 10.4933 5.24655 10.4915C5.4432 10.4898 5.63131 10.411 5.77036 10.2719C5.90942 10.1329 5.9883 9.94474 5.99001 9.74809C5.99171 9.55145 5.91612 9.362 5.7795 9.22054L2.5605 6.00004H17.25C17.4489 6.00004 17.6397 5.92103 17.7803 5.78037C17.921 5.63972 18 5.44896 18 5.25004C18 5.05113 17.921 4.86037 17.7803 4.71971C17.6397 4.57906 17.4489 4.50004 17.25 4.50004H2.5605L5.7795 1.28104C5.91612 1.13959 5.99171 0.95014 5.99001 0.753493C5.9883 0.556845 5.90942 0.368736 5.77036 0.22968C5.63131 0.0906235 5.4432 0.0117469 5.24655 0.0100381C5.0499 0.0083293 4.86045 0.083925 4.719 0.220544L0.219 4.72054L0.2145 4.72804C0.147732 4.79569 0.0947503 4.87568 0.0585001 4.96354C0.0198902 5.05412 -8.46608e-06 5.15158 2.70207e-09 5.25004V5.25304Z" fill="white" />
                    </svg>
                </span>
                Back To Home</a>
        </nav>
    </div>
</section>
<section class="single-wrapper ">
    <div class="container">
        <div class="row g-3">
            <div class="col-lg-6 col-md-10 col-12">
                <div class="right-single-box blacklist_box_user project_details_card">
                    <div class="row gx-3">
                    <div class="col-12 text-end">
                            <button type="button" class="btn btn-primary ml-auto cancel-btn">
                                Chat
                            </button>
                        </div>
                        <div class="col">
                            <ul>
                                <li>
                                    <div class="main-title">
                                        <h6> <span>{{trans("cruds.create_project.fields.user_name")}} :</span> {{ $requestProject->user->user_name  ?? ''}}</h6>
                                    </div>
                                </li>
                                <li>
                                    <div class="main-title">
                                        <h6> <span>{{trans("cruds.create_project.project")}} {{trans("cruds.create_project.fields.type")}} :</span> {{ $requestProject->type  ?? ''}}</h6>
                                    </div>
                                </li>
                                <li>
                                    <div class="description-text main-title">
                                        <h6> <span>{{trans("cruds.create_project.fields.tags")}} :</span>
                                            @if(app()->getLocale() == 'en')
                                            {{ $requestProject->tags->name_en ?? '' }}
                                            @else
                                            {{ $requestProject->tags->name_ch ?? '' }}
                                            @endif
                                        </h6>
                                    </div>
                                </li>

                                <li>
                                    <div class="main-title">
                                        <h6> <span>{{trans("cruds.create_project.fields.budget")}} :</span>{{ $requestProject->budget  ?? ''}} CN¥</h6>
                                    </div>
                                </li>

                                <li>
                                    <div class="main-title">
                                        <h6> <span>{{trans("cruds.create_project.fields.description")}} :</span> {!! $requestProject->comment ?? '' !!}</h6>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        @if(isset($creatorStatus) && $creatorStatus == 0)
                            <div class="col-12">
                                <button type="button" class="btn btn-primary ml-3 cancel-btn" id="cancel" {{ $creatorStatus == 0 ? 'disabled' : '' }}>
                                    {{ $creatorStatus == 0 ? __('cruds.create_project.headings.cancelled_project') : __('cruds.create_project.headings.cancel_project') }}
                                </button>
                            </div>
                        @elseif($creatorStatus == 1)
                            <div class="col-12">
                                <button type="button" class="btn btn-success ml-3 confirm-btn" id="confirm" {{ $creatorStatus == 1 ? 'disabled' : '' }}>
                                    {{ $creatorStatus == 1 ? __('cruds.create_project.headings.confirmed_project') : __('cruds.create_project.headings.confirm_project') }}
                                </button>
                            </div>
                        @elseif($creatorStatus == 2)
                            <div class="col-12">
                                <button type="button" class="btn btn-secondary add-bid-btn" id="addBidModal">
                                    {{ $creatorStatus == 2 ? __('cruds.create_project.headings.bid_added') : __('cruds.create_project.headings.add_bid') }}
                                </button>
                            </div>
                        @else
                        <div class="col-12">
                            <div class="row g-3">
                                <div class="col-auto">
                                    <button type="button" class="btn btn-secondary add-bid-btn" id="addBidModal">
                                        {{__('cruds.create_project.headings.add_bid')}}
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-success ml-3 confirm-btn" id="confirm">
                                        {{__('cruds.create_project.headings.confirm_project')}}
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-primary ml-3 cancel-btn" id="cancel">
                                        {{__('cruds.create_project.headings.cancel_project')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bid Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('cruds.create_project.headings.add_bid_form')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- form start -->
                <form action="{{route('user.add.project.bid')}}" method="post" id="addBidForm">
                    <div class="modal-body">
                        <input type="hidden" id="auth_id" value="{{auth()->user()->id}}">
                        <input type="hidden" id="project_id" value="{{$requestProject->id}}">
                        <input type="hidden" id="user_id" value="{{$requestProject->user_id}}">
                        <div class="mb-4">
                            <div class="form-group">
                                <label for="budget">{{__('cruds.create_project.fields.budget')}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="bid" id="budget" placeholder="{{trans("global.enter")}} {{__('cruds.create_project.fields.budget')}}" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('cruds.global.cancel')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('cruds.global.add')}}</button>
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
        $('#addBidModal').click(function() {
            $('#exampleModal').modal('show');
        });

        $(document).on("submit", "#addBidForm", function(e) {
            e.preventDefault();
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
                    location.reload();

                },
                error: function(jqXHR, exception) {
                    if (jqXHR.status == 422) {
                        console.log('validation error');
                    } else {
                        toastr.error(jqXHR.responseJSON.message, '{{trans("global.alert.error")}}');
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

            var projectId = $('#project_id').val();
            var creatorId = $('#auth_id').val();
            var userId = $('#user_id').val();

            var url = "{{ route('user.creator.project.confirm') }}";

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

            var projectId = $('#project_id').val();
            var creatorId = $('#auth_id').val();
            var userId = $('#user_id').val();

            var url = "{{ route('user.project.cancel') }}";

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