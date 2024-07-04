@extends('layouts.app')
@section('content')
@php 
    $siteSettingData = getSiteSetting();
@endphp
  <!-- hero privacy  -->
    <section class="privacy-hero">
      <div class="container">
        <div class="hero-banner">
          <div class="prc-title">
            <h2>{{__('cruds.pages.sub_pages.terms_title1')}} <span>{{__('cruds.pages.sub_pages.terms_title2')}}</span></h2>
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
              {{__('cruds.pages.sub_pages.terms_condition')}}
            </li>
          </ol>
        </nav>
      </div>
    </section>

    <div class="privacy-content">
      <div class="container">
        <div class="inner-content">
          <!-- <h3><b>Terms & conditions</b></h3> -->
          <h4 class="mb-2">
            <b>Lorem ipsum dolor</b>
          </h4>
          <p>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magnam
            itaque quidem officiis fugiat! Pariatur delectus temporibus
            doloremque, placeat cupiditate laboriosam, alias, maxime nam
            expedita ut voluptates animi aut eius perferendis. Lorem ipsum dolor
            sit amet, consectetur adipisicing elit. Nisi, dolores ratione
            temporibus eaque accusantium cumque maiores fuga eius eligendi eum
            nulla voluptates quisquam iste tempora blanditiis tempore officia
            porro eos.
          </p>
          <p>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magnam
            itaque quidem officiis fugiat! Pariatur delectus temporibus
            doloremque, placeat cupiditate laboriosam, alias, maxime nam
            expedita ut voluptates animi aut eius perferendis. Lorem ipsum dolor
            sit amet, consectetur adipisicing elit. Nisi, dolores ratione
            temporibus eaque accusantium cumque maiores fuga eius eligendi eum
            nulla voluptates quisquam iste tempora blanditiis tempore officia
            porro eos.
          </p>
          <h4 class="mb-2">
            <b>Lorem ipsum dolor</b>
          </h4>
          <p>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magnam
            itaque quidem officiis fugiat! Pariatur delectus temporibus
            doloremque, placeat cupiditate laboriosam, alias, maxime nam
            expedita ut voluptates animi aut eius perferendis. Lorem ipsum dolor
            sit amet, consectetur adipisicing elit. Nisi, dolores ratione
            temporibus eaque accusantium cumque maiores fuga eius eligendi eum
            nulla voluptates quisquam iste tempora blanditiis tempore officia
            porro eos.
          </p>
          <p>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magnam
            itaque quidem officiis fugiat! Pariatur delectus temporibus
            doloremque, placeat cupiditate laboriosam, alias, maxime nam
            expedita ut voluptates animi aut eius perferendis. Lorem ipsum dolor
            sit amet, consectetur adipisicing elit. Nisi, dolores ratione
            temporibus eaque accusantium cumque maiores fuga eius eligendi eum
            nulla voluptates quisquam iste tempora blanditiis tempore officia
            porro eos.
          </p>

          <h4 class="mb-2">
            <b>Lorem ipsum dolor</b>
          </h4>
          <p>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magnam
            itaque quidem officiis fugiat! Pariatur delectus temporibus
            doloremque, placeat cupiditate laboriosam, alias, maxime nam
            expedita ut voluptates animi aut eius perferendis. Lorem ipsum dolor
            sit amet, consectetur adipisicing elit. Nisi, dolores ratione
            temporibus eaque accusantium cumque maiores fuga eius eligendi eum
            nulla voluptates quisquam iste tempora blanditiis tempore officia
            porro eos.
          </p>
          <p>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magnam
            itaque quidem officiis fugiat! Pariatur delectus temporibus
            doloremque, placeat cupiditate laboriosam, alias, maxime nam
            expedita ut voluptates animi aut eius perferendis. Lorem ipsum dolor
            sit amet, consectetur adipisicing elit. Nisi, dolores ratione
            temporibus eaque accusantium cumque maiores fuga eius eligendi eum
            nulla voluptates quisquam iste tempora blanditiis tempore officia
            porro eos.
          </p>
          <p>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magnam
            itaque quidem officiis fugiat! Pariatur delectus temporibus
            doloremque, placeat cupiditate laboriosam, alias, maxime nam
            expedita ut voluptates animi aut eius perferendis. Lorem ipsum dolor
            sit amet, consectetur adipisicing elit. Nisi, dolores ratione
            temporibus eaque accusantium cumque maiores fuga eius eligendi eum
            nulla voluptates quisquam iste tempora blanditiis tempore officia
            porro eos.
          </p>
          <p>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magnam
            itaque quidem officiis fugiat! Pariatur delectus temporibus
            doloremque, placeat cupiditate laboriosam, alias, maxime nam
            expedita ut voluptates animi aut eius perferendis. Lorem ipsum dolor
            sit amet, consectetur adipisicing elit. Nisi, dolores ratione
            temporibus eaque accusantium cumque maiores fuga eius eligendi eum
            nulla voluptates quisquam iste tempora blanditiis tempore officia
            porro eos.
          </p>
        </div>
      </div>
    </div>

  @endsection
