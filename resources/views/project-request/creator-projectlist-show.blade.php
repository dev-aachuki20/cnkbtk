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

<section class="single-wrapper project_card_group">
    <div class="container">
        <div class="row g-3">
            @foreach($allRequestProjects as $item)
            <div class="col-lg-6 col-12">
                <div class="right-single-box blacklist_box_user project_details_card h-100">
                    <div class="row gx-3">
                        <div class="col mobile-view-responsive">
                            <ul>
                                <li>
                                    <div class="main-title details">
                                        <h6> <span>{{trans("cruds.create_project.fields.title")}} </span></h6>
                                        <div class="content">{{ ucfirst($item['project']->title)  ?? ''}}</div>
                                    </div>
                                </li>
                                <li>
                                    <div class="main-title details">
                                        <h6> <span>{{trans("cruds.create_project.fields.user_name")}} </span></h6>
                                        <div class="content">{{ $item['project']->user->user_name  ?? ''}}</div>
                                    </div>
                                </li>
                                <li>
                                    <div class="main-title details">
                                        <h6> <span>{{trans("cruds.create_project.project")}} {{trans("cruds.create_project.fields.type")}} </span></h6>
                                        <div class="content">{{ $item['project']->type  ?? ''}}</div>
                                    </div>
                                </li>
                                <li>
                                    <div class="description-text main-title details">
                                        <h6>
                                            <span>{{ trans("cruds.create_project.fields.tags") }}</span>
                                            
                                        </h6>
                                        <div class="content">
                                        @php
                                                $tagIds = explode(',', $item['project']->tags); 
                                                $tags = \App\Models\Tag::whereIn('id', $tagIds)->get();
                                                $tagNames = app()->getLocale() == 'en' ? $tags->pluck('name_en')->toArray() : $tags->pluck('name_ch')->toArray();
                                            @endphp
                                            {{ implode(', ', $tagNames) }}
                                        </div>
                                        
                                    </div>
                                </li>

                                <li>
                                    <div class="main-title details">
                                        <h6> <span>{{trans("cruds.create_project.fields.budget")}} </span></h6>
                                        <div class="content">{{ $item['project']->budget  ?? ''}} CN¥</div>
                                    </div>
                                </li>

                                <li>
                                    <div class="main-title description-content">
                                        <h6> <span>{{trans("cruds.create_project.fields.description")}} </span></h6>
                                        
                                        <div class="content" id="content">
                                            <div class="description-text">
                                                {!! $item['project']->comment ?? '' !!}
                                            </div>
                                            @if(isset($item['project']->comment))
                                                <button type="button" class="btn btn-dark add-bid-btn btn-sm read-more-btn">Read More</button>
                                            @endif
                                        </div>
                                    </div>
                                    @if($item['project']->project_status == 1)
                                        <div class="rating-wrapper mb-3">
                                            <button class="btn btn-primary" type="button">{{__('cruds.global.rating')}}</button>
                                        </div>
                                    @endif
                                    <!-- buttons -->
                                    <div class="col-12 buttongroupborder">
                                        <div class="row gx-3 row-gap-3">
                                            @if($item['project']->project_status != 1)
                                            <div class="col-auto">
                                                <div class="row g-3">
                                                    <div class="col-auto">
                                                        <button type="button" class="btn btn-secondary add-bid-btn" id="addBidBtn" data-bid="{{$item['bid']}}" data-project-id="{{$item['project']->id}}" data-user-id="{{$item['project']->user_id}}" data-creator-id="{{Auth::user()->id}}" {{$item['project']->project_status == 1  ? 'disabled' : ''}}>
                                                            {{ $item['creatorStatus'] == 2 ? __('cruds.create_project.headings.bid_added') : __('cruds.create_project.headings.add_bid') }}
                                                        </button>
                                                    </div>
                                                    {{-- @if($item['userStatus'] == 1) --}}
                                                    <div class="col-auto">
                                                        <button type="button" class="btn btn-success ml-3 confirm-btn" id="confirm" data-project-id="{{$item['project']->id}}" data-user-id="{{$item['project']->user_id}}" data-creator-id="{{Auth::user()->id}}" {{$item['project']->project_status == 1  ? 'disabled' : ''}}>
                                                            {{$item['project']->project_status == 1  ? 'Confirmed' : __('cruds.create_project.headings.confirm_project')}}
                                                        </button>
                                                    </div>
                                                    {{-- @endif --}}
                                                </div>
                                            </div>
                                            @endif
                                            @if( $item['creatorStatus'] == 1 && $item['project']->project_status == 1 || $item['project']->project_status == 0 )
                                            <div class="col-auto">
                                                <a href="{{ route('message.index', ['projectId' => $item['project']->id]) }}" class="btn btn-primary ml-auto cancel-btn messages-button" id="message" data-project-id="{{$item['project']->id}}" data-user-id="{{$item['project']->user_id}}">
                                                    {{__('cruds.global.message')}}
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @include("project.add_bid_form")    
</section>

@endsection

@section("scripts")
    @include("project-request.partials.script")
@endsection