@extends('layouts.app')
@section('content')
<!-- hero privacy  -->
    <section class="privacy-hero">
      <div class="container">
        <div class="hero-banner">
          <div class="prc-title">
            <h2>{{$poster->title}}</h2>
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
              {{$poster->title}}
            </li>
          </ol>
        </nav>
      </div>
    </section>

    <section class="single-wrapper">
      <div class="container">
        <div class="row">
          {{-- <div class="col-sm-5 col-md-4 col-lg-3">
            @include('user.partials.usercard')
          </div> --}}
          <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="right-single-box">
              <div class="main-title">
                <h2>{{$poster->title}}</h2>
              </div>
              <div class="description-text">
                {!! $poster->description !!}
              </div>
              @if($poster->episodes->count() > 0)
                @foreach ($poster->episodes as $episode )
                  <div class="main-title">
                    <h2>{{$episode->title}}</h2>
                  </div>

                  <div class="description-text">
                    {!! $episode->description !!}
                  </div>
                @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection