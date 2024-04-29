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
      <div class="col-lg-6 col-md-10 col-12">
        <div class="right-single-box blacklist_box_user">
          <div class="row gx-3">
            <div class="col-auto">
              <div class="userimage me-2"><img src="https://devcnkbtk.hipl-staging2.com/storage/profileImage/SvziPV4M2AgSZ9NT9w6XC9gKumRrnQNXdWnGMlK2.jpg" alt="user"></div>
            </div>
            <div class="col">
              <div class="main-title">
                <h2>{{$blacklistUser->user->user_name}}</h2>
              </div>
              <ul>
                <li>
                  <div class="main-title">
                    <h6> <span>Email:</span> {{$blacklistUser->email}}</h6>
                  </div>
                </li>
                <li>
                  <div class="description-text">
                    <span>IP Address:</span> {{$blacklistUser->ip_address}}
                  </div>
                </li>
                <li>
                  <div class="description-text">
                   <span>Reason:</span> {{$blacklistUser->blacklistTag->name_en}}
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