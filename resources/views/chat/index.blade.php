@extends('layouts.app')
@section("style")
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css"/>
@endsection

@section('content')
<!-- hero privacy  -->
<section class="privacy-hero">
  <div class="container">
    <div class="hero-banner">
      <div class="prc-title">
        {{-- <h2>Chats</h2> --}}
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
        <li class="breadcrumb-item active">{{ Str::ucfirst(array_search(auth()->user()->role_id, config("constant.role"))) }}</li>
        <li class="breadcrumb-item active">{{trans("global.chat")}}</li>
      </ol>
    </nav>
  </div>
</section>

<section class="single-wrapper">
  <div class="container">
    
  </div>
</section>
@endsection
