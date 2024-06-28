@extends('layouts.app')
@section("style")
 <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css"
    />
@endsection
@section('content')
<!-- hero privacy  -->
    <section class="privacy-hero">
      <div class="container">
        <div class="hero-banner">
          <div class="prc-title">
            <h2>{{getExplodedName($poster->title)[0] }} <span> {{isset(getExplodedName($poster->title)[1]) ? getExplodedName($poster->title)[1] : "" }}</h2>
          </div>
        </div>
      </div>
    </section>
    <!-- end  -->

    <section class="breadcrumb-wrap">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("home")}}">{{trans("global.home")}}</a></li>
            @if($poster->parentSection)
                <li class="breadcrumb-item"><a href="{{route("section.page",[$poster->parentSection->level,$poster->parentSection->slug])}}" >{{$poster->parentSection->name}}</a></li>
            @endif
            
            @if($poster->subSection)
                <li class="breadcrumb-item active"><a href="{{route("section.page",[$poster->subSection->level,$poster->subSection->slug])}}">{{$poster->subSection->name}}</a></li>
            @endif
            {{-- <li class="breadcrumb-item active"><a href="{{route("section.page",[$poster->childSection->level,$poster->childSection->slug])}}">{{$poster->childSection->name}}</a></li> --}}
            <li class="breadcrumb-item active">{{$poster->title}}</li>
          </ol>
        </nav>
      </div>
    </section>

    <section class="single-wrapper">
      <div class="container">
        <div class="row">
            <div class="col-sm-5 col-md-4 col-lg-3">
                <div class="profile-inner">
                    <div class="avatar-icon">
                        @php 
                            $imagePath = asset('front/asset/images/user.png');
                            if(isset($poster->userDetails->uploads) && !empty($poster->userDetails->uploads) && count($poster->userDetails->uploads) > 0){
                                $imagePath = asset('storage/'.$poster->userDetails->uploads->first()->path );
                            } 
                            
                        @endphp
                        <img src="{{$imagePath}}" alt="" />
                    </div>
                    <div class="avatar-title">
                        <h2>{{$poster->userDetails->user_name}}</h2>
                    </div>
                    <div class="post-count-list d-flex align-items-center justify-content-center">
                        <div class="post-count">{{trans("global.post")}}<span class="count-number"> {{$poster->userDetails->postCount()}}</span></div>
                        <div class="post-count integral-count">{{trans("global.points")}}<span class="count-number"> {{ getCurrentAvailablePoint($poster->userDetails->id) }} </span></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7 col-md-8 col-lg-9">
                <div class="right-single-box">
                <div class="singel-top-head d-flex align-items-center justify-content-between gap-3">
                    <div class="date-time-box">
                    <span> <b>{{trans("global.date")}}</b> @formattedDate($poster->created_at) </span>
                    <span> <b>{{trans("global.reads")}}:</b> {{$poster->reads_count}} </span>
                    </div>
                    <div class="follow-btn">
                        <a href="javascript:void(0)"   id="reportPost"   data-post-id="{{Crypt::encrypt($poster->id)}}" class="btn btn-primary followbtn" > {{trans("pages.poster.report")}} </a>
                        <a href="javascript:void(0)" data-follow-status="{{ !empty($is_follower) ? Crypt::encrypt('0') :  Crypt::encrypt('1') }}"  data-post-id="{{Crypt::encrypt($poster->id)}}" class="btn btn-primary followbtn"  id="followBtn">  {{ !empty($is_follower) ? trans("pages.poster.following") :   trans("pages.poster.follow") }}</a>
                    </div>
                </div>
                <div class="main-title">
                    <h2>{{$poster->title}}</h2>
                </div>
                <div class="description-text">
                   {!! nl2br($poster->description) !!}
                </div>

                @if(isset($poster->episodes) && $poster->episodes->count() > 0)
                    @foreach ($poster->episodes as $episode)
                        @if((isset($purchasedEpisodes) && $purchasedEpisodes->contains($episode->id)) || (Auth::check() && (Auth::user()->role_id == 1 || Auth::user()->id == $poster->user_id)))
                            <div class="card mt-2">
                                <div class="card-body">
                                    <h5 class="card-title">{{$episode->title}}</h5>
                                    <p class="card-text">{!! $episode->description !!}</p>
                                </div>
                            </div>
                            @if(isset($episode->uploads) && $episode->uploads->count() > 0)
                                <main class="img-grid-wrapper">
                                    <div id="gallery" class="photos-grid-container gallery">
                                        @foreach($episode->uploads as $index => $upload)
                                            @if($index == 0)
                                                <div class="main-photo img-box">
                                                    <a href="{{ Storage::disk('public')->url($upload->path) }}" class="glightbox" data-glightbox="type: image">
                                                        <img src="{{ Storage::disk('public')->url($upload->path) }}" alt="image" />
                                                    </a>
                                                </div>
                                            @elseif($index < 4)
                                                <div class="sub">
                                                    <div class="img-box">
                                                        <a href="{{ Storage::disk('public')->url($upload->path) }}" class="glightbox" data-glightbox="type: image">
                                                            <img src="{{ Storage::disk('public')->url($upload->path) }}" alt="image" />
                                                        </a>
                                                    </div>
                                                </div>
                                            @elseif($index == 4)
                                                <div id="multi-link" class="img-box">
                                                    <a href="{{ Storage::disk('public')->url($upload->path) }}" class="glightbox" data-glightbox="type: image">
                                                        <img src="{{ Storage::disk('public')->url($upload->path) }}" alt="image" />
                                                        <div class="transparent-box">
                                                            <div class="caption">+{{ $episode->uploads->count() - 5 }}</div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    @if($episode->uploads->count() > 5)
                                        <div id="more-img" class="extra-images-container hide-element">
                                            @foreach($episode->uploads->slice(5) as $upload)
                                                <a href="{{ Storage::disk('public')->url($upload->path) }}" class="glightbox" data-glightbox="type: image">
                                                    <img src="{{ Storage::disk('public')->url($upload->path) }}" alt="image" />
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </main>
                            @endif
                        @else
                            <div class="coupon-wrapper mt-2">
                                <div class="coupon-content">
                                    {{$episode->title}}
                                </div>
                                <div class="coupon-btn">
                                    <a href="javascript:void(0)" data-episodeid="{{ Crypt::encrypt($episode->id) }}" class="btn buy_episode">{{ trans("global.points") }} : {{$episode->cost}}</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
                </div>
            </div>
        </div>
      </div>
    </section>

    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    </div>

    <div class="modal fade" id="purchaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    </div>
@endsection
@section("scripts")
@include("poster.script")
@endsection
