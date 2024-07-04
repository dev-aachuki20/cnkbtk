@extends('layouts.app')
@section('content')
<!-- hero privacy  -->
<section class="privacy-hero">
  <div class="container">
    <div class="hero-banner">
      <div class="prc-title">
        {{-- <h2>{{__('cruds.pages.sub_pages.terms_title1')}} <span>{{__('cruds.pages.sub_pages.terms_title2')}}</span></h2> --}}
        <h2>
          @if($page->title == 'terms-conditions')
              {{ __('cruds.pages.sub_pages.terms_title1') }} <span>{{ __('cruds.pages.sub_pages.terms_title2') }}</span>
          @else
          {{ __('cruds.pages.sub_pages.privacy_title1') }} <span>{{ __('cruds.pages.sub_pages.privacy_title2') }}</span>
          @endif
      </h2>
      </div>
    </div>
  </div>
</section>
<!-- end  -->

<section class="breadcrumb-wrap">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('global.home')}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">
          @if($page->title == 'terms-conditions')
              {{ __('cruds.pages.sub_pages.terms_condition') }}
          @else
          {{ __('cruds.pages.sub_pages.privacy_policy') }}
          @endif
        </li>
      </ol>
    </nav>
  </div>
</section>

<div class="privacy-content">
  <div class="container">
    <div class="inner-content">
      @if(app()->getLocale() == 'en')
      {!! $page->content_en !!} 
      @else
      {!! $page->content_ch !!} 
      @endif
    </div>
  </div>
</div>

  @endsection
