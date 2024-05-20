@extends('layouts.app')
@section('content')
<!-- hero privacy  -->
<section class="privacy-hero">
  <div class="container">
    <div class="hero-banner">
      <div class="prc-title">
        <h2>{{trans("global.blacklist_user")}}</h2>
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

<section class="single-wrapper ">
  <div class="container">
    <div class="row g-3">
      <div class="col-lg-6 col-12">
        <div class="right-single-box blacklist_box_user">
          <div class="row gx-3">
            <div class="col-auto">
              <div class="userimage me-2">
                @if($uploadPath)
                <img src="{{ $uploadPath }}" alt="user">
                @else
                <img src="{{asset('front/asset/images/user.png')}}" alt="default user">
                @endif
              </div>
            </div>

            <div class="col">
              <div class="main-title">
                <h2>{{$blacklistUser->user->user_name ?? ''}}</h2>
              </div>
              <ul>
                <li>
                  <div class="main-title">
                    <h6> <span>{{trans('pages.blacklist_user.form.fields.email')}} :</span> {{$blacklistUser->email ?? ''}}</h6>
                  </div>
                </li>
                <li>
                  <div class="description-text">
                    <span>{{trans('pages.blacklist_user.form.fields.ip_address')}} :</span> {{$blacklistUser->ip_address ?? ''}}
                  </div>
                </li>
                <li>
                  <div class="description-text">
                    <span>{{ trans('pages.blacklist_user.form.fields.reason') }} :</span>
                    @if(app()->getLocale() == 'en')
                    {{ $blacklistUser->blacklistTag->name_en ?? '' }}
                    @else
                    {{ $blacklistUser->blacklistTag->name_ch ?? '' }}
                    @endif
                  </div>
                </li>

              </ul>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection