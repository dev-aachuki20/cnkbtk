@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="{{ asset('admins/plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection
@section('content')
<!-- hero privacy  -->
  <section class="privacy-hero">
    <div class="container">
      <div class="hero-banner">
        <div class="prc-title">
          <h2>{{trans("global.create")}} <span>{{trans("global.post")}}</span></h2>
        </div>
      </div>
    </div>
  </section>
  <!-- end  -->

  <!-- Breadcrumb -->
  <section class="breadcrumb-wrap">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans("global.home")}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            {{trans("global.create_post")}}
          </li>
        </ol>
      </nav>
    </div>
  </section>
  <!-- End breadcrumb  -->

  <section class="edit-post-wrapper py-5">
    <div class="container">
      <div class="card">
        <div class="card-header"> {{trans("global.create_post")}}</div>
          <div class="card-body">
            <div class="edit-inner-box">
              <form method="POST" action="{{ route('post.store') }}" id="addForm" enctype="multipart/form-data">
                @include("post._form")
              </form>
            </div>
          </div>
      </div>
    </div>
   
  </section>
@endsection

@section("scripts")
@include('post.scripts')
<script src="{{ asset('admins/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
@endsection
