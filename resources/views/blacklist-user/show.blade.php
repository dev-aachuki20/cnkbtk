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
      <a href="javascript:;" type="button" class="btn btn-dark px-3 btn-sm">
        <span>
          <svg width="21" height="11" viewBox="0 0 21 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.70207e-09 5.25304C0.00151059 5.44731 0.0784183 5.63339 0.2145 5.77204L0.219 5.78104L4.719 10.281C4.86045 10.4177 5.0499 10.4933 5.24655 10.4915C5.4432 10.4898 5.63131 10.411 5.77036 10.2719C5.90942 10.1329 5.9883 9.94474 5.99001 9.74809C5.99171 9.55145 5.91612 9.362 5.7795 9.22054L2.5605 6.00004H17.25C17.4489 6.00004 17.6397 5.92103 17.7803 5.78037C17.921 5.63972 18 5.44896 18 5.25004C18 5.05113 17.921 4.86037 17.7803 4.71971C17.6397 4.57906 17.4489 4.50004 17.25 4.50004H2.5605L5.7795 1.28104C5.91612 1.13959 5.99171 0.95014 5.99001 0.753493C5.9883 0.556845 5.90942 0.368736 5.77036 0.22968C5.63131 0.0906235 5.4432 0.0117469 5.24655 0.0100381C5.0499 0.0083293 4.86045 0.083925 4.719 0.220544L0.219 4.72054L0.2145 4.72804C0.147732 4.79569 0.0947503 4.87568 0.0585001 4.96354C0.0198902 5.05412 -8.46608e-06 5.15158 2.70207e-09 5.25004V5.25304Z" fill="white"></path></svg>
        </span>
        Back To Home</a>
    </nav>
  </div>
</section>

<section class="single-wrapper ">
  <div class="container">
    <div class="row g-3">
      <div class="col-lg-6 col-md-10 col-12">
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