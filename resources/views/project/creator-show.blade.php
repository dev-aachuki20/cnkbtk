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
    <div class="container project_card_group">
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
                    @if($project->project_status == 1)
                        <div class="col-12 text-end">
                            <a href="{{ route('message.index', ['projectId' => $project->id]) }}" class="btn btn-primary ml-auto cancel-btn" id="message" data-project-id="{{$project->id}}" data-user-id="{{$project->user_id}}">
                                {{__('cruds.global.message')}}
                            </a>
                        </div>
                    @endif


                    <div class="col">
                        <ul>
                            <li>
                                <div class="main-title">
                                    <h6> <span>{{trans("cruds.create_project.fields.title")}} :</span> {{ ucfirst($project->title)  ?? ''}}</h6>
                                </div>
                            </li>
                            <li>
                                <div class="main-title">
                                    <h6> <span>{{trans("cruds.create_project.fields.user_name")}} :</span> {{ $project->user->user_name  ?? ''}}</h6>
                                </div>
                            </li>
                            <li>
                                <div class="main-title">
                                    <h6> <span>{{trans("cruds.create_project.project")}} {{trans("cruds.create_project.fields.type")}} :</span> {{ $project->type  ?? ''}}</h6>
                                </div>
                            </li>
                            <li>
                                <div class="description-text main-title">
                                    <h6> <span>{{trans("cruds.create_project.fields.tags")}} :</span>
                                        {{-- @if(app()->getLocale() == 'en')
                                        {{ $project->tags->name_en ?? '' }}
                                        @else
                                        {{ $project->tags->name_ch ?? '' }}
                                        @endif --}}

                                        @php
                                            $tagIds = explode(',', $item['project']->tags); 
                                            $tags = \App\Models\Tag::whereIn('id', $tagIds)->get();
                                            $tagNames = app()->getLocale() == 'en' ? $tags->pluck('name_en')->toArray() : $tags->pluck('name_ch')->toArray();
                                        @endphp
                                            {{ implode(', ', $tagNames) }}
                                    </h6>
                                </div>
                            </li>

                            <li>
                                <div class="main-title">
                                    <h6> <span>{{trans("cruds.create_project.fields.budget")}} :</span>{{ $project->budget  ?? ''}} CN¥</h6>
                                </div>
                            </li>

                            <li>
                                <div class="main-title description-content">
                                    <h6> <span>{{trans("cruds.create_project.fields.description")}} :</span> <button type="button" class="btn btn-secondary add-bid-btn">...Read More</button></h6>
                                    <div class="content">
                                        {!! $project->comment ?? '' !!}
                                    </div> 
                                </div>
                            </li>
                            <li>
                                <!-- buttons -->
                                @if($project->project_status != 1)
                                <div class="col-12 buttongroupborder">
                                    <div class="row g-3">
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-secondary add-bid-btn" id="addBidModal" data-project-id="{{$project->id}}" data-user-id="{{$project->user_id}}" data-creator-id="{{Auth::user()->id}}" {{$project->project_status == 1  ? 'disabled' : ''}}>
                                                {{ $creatorStatus == 2 ? __('cruds.create_project.headings.bid_added') : __('cruds.create_project.headings.add_bid') }}
                                            </button>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-success ml-3 confirm-btn" id="confirm" data-project-id="{{$project->id}}" data-user-id="{{$project->user_id}}" data-creator-id="{{Auth::user()->id}}" {{$project->project_status == 1  ? 'disabled' : ''}}>
                                                {{$project->project_status == 1  ? 'Confirmed' : __('cruds.create_project.headings.confirm_project')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </li>
                        </ul>
                    </div>


                    <!-- creatorStatus == 1 -->
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Bid Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('cruds.create_project.headings.add_bid_form')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- form start -->
                <form action="{{route('user.add.project.bid')}}" method="post" id="addBidForm">
                    <div class="modal-body">
                        <input type="hidden" id="auth_id" value="{{auth()->user()->id}}">
                        <input type="hidden" id="project_id" value="{{$project->id}}">
                        <input type="hidden" id="user_id" value="{{$project->user_id}}">
                        <div class="mb-4">
                            <div class="form-group">
                                <label for="budget">{{__('cruds.create_project.fields.budget')}}<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="bid" id="budget" placeholder="{{trans("global.enter")}} {{__('cruds.create_project.fields.budget')}}" />
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
        $(document).on("click", "#addBidModal", function(e) {
            var projectId = $(this).data('project-id');
            var userId = $(this).data('user-id');
            var creatorId = $(this).data('creator-id');

            $('#project_id').val(projectId);
            $('#user_id').val(userId);
            $('#auth_id').val(creatorId);

            $('#exampleModal').modal('show');
        });

        // add bid
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
                error: function(response) {
                    if (response.responseJSON.errors && response.responseJSON.errors.budget) {
                        var errorMessage = response.responseJSON.errors.budget[0];
                        $('#budget').after('<div id="budget-error" class="text-danger mt-2">' + errorMessage + '</div>');
                    } else {
                        // toastr.error(jqXHR.responseJSON.message, '{{trans("global.alert.error")}}');
                        // location.reload();
                        var errorMessage = response.responseJSON.message || 'An error occurred. Please try again.';
                        $('#budget').after('<div id="budget-error" class="text-danger mt-2">' + errorMessage + '</div>');
                    }
                },
                complete: function() {
                    hideLoader();
                }
            });
        });

         // Reset form values when the modal is hidden
        $('#exampleModal').on('hidden.bs.modal', function() {
            $('#addBidForm')[0].reset();
            $('#budget-error').remove();
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
    });
</script>

<!-- Description More and less content js -->
<script>
    class ReadMoreToggle {
    constructor(container) {
        this.content = container.querySelector('.content');
        this.button = container.querySelector('.read-more-btn');
        this.button.addEventListener('click', () => this.toggleReadMore());
    }

    toggleReadMore() {
        if (this.content.classList.contains('show-more')) {
            this.content.classList.remove('show-more');
            this.button.innerText = '...Read More';
        } else {
            this.content.classList.add('show-more');
            this.button.innerText = '...Read Less';
        }
    }
}

// Initialize the ReadMoreToggle class for all description content sections
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.main-title.description-content').forEach(container => {
        new ReadMoreToggle(container);
    });
});

</script>
@endsection