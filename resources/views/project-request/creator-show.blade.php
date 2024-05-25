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
                    @if($project->project_status == 1)
                        <div class="col-12 text-end">
                            <a href="{{ route('message.index', ['projectId' => $project->id]) }}" class="btn btn-primary ml-auto cancel-btn" id="message" data-project-id="{{$project->id}}" data-user-id="{{$project->user_id}}">
                                {{__('cruds.global.message')}}
                            </a>
                        </div>
                    @endif


                    @if(isset($project) && $project->status == 1)
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
                                        @php
                                            $tagIds = explode(',', $project->tags); 
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
                                            <button type="button" class="btn btn-secondary add-bid-btn" id="addBidBtn" data-bid="{{$bid}}" data-project-id="{{$project->id}}" data-user-id="{{$project->user_id}}" data-creator-id="{{Auth::user()->id}}" {{$project->project_status == 1  ? 'disabled' : ''}}>
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
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>

    @include("project.add_bid_form")

</section>

@endsection

@section("scripts")
    @include("project-request.partials.script")
@endsection 