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

<section class="single-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="right-single-box">
          <div class="main-title">
            <h2><b>{{$blacklistUser->user->user_name}}</b></h2>
          </div>
          <div class="main-title">
            <h2> Email: {{$blacklistUser->email}}</h2>
          </div>
          <div class="description-text">
            IP Address: {{$blacklistUser->ip_address}}
          </div>
          <div class="description-text">
            Reason: {{$blacklistUser->blacklistTag->name_en}}
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection