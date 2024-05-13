@extends('layouts.app')
@section('content')

<!-- hero privacy  -->
<section class="privacy-hero">
    <div class="container">
        <div class="hero-banner">
            <div class="prc-title">
                <h2>{{trans("cruds.create_project.project")}} {{__('cruds.create_project.request')}}</h2>
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
                    {{trans("cruds.create_project.project")}} {{__('cruds.create_project.request')}}
                </li>
            </ol>
        </nav>
    </div>
</section>
<section class="single-wrapper ">
    <div class="container">
        <div class="row g-3">
            <div class="col-lg-6 col-md-10 col-12">
                <div class="right-single-box blacklist_box_user project_details_card">
                    <div class="row gx-3">
                        {{--
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-primary ml-auto cancel-btn">
                                {{__('cruds.global.message')}}
                            </button>
                        </div>
                        --}}
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

            var url = "{{ route('user.creator.project.cancel') }}";

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