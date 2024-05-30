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
          <h2>{{getExplodedName($section->name)[0] }} <span> {{isset(getExplodedName($section->name)[1]) ? getExplodedName($section->name)[1] : ""}}</span></h2>
        </div>
      </div>
    </div>
  </section>

  <section class="breadcrumb-wrap">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route("home")}}">{{trans("global.home")}}</a></li>
          @switch($section->level)
            @case(1)
                <li class="breadcrumb-item active" aria-current="page"> {{$section->name}} </li>
                @break
            @case(2)
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('section.page',[$section->parent_category->level,$section->parent_category->slug])}}"> {{$section->parent_category->name}} </a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{$section->name}} </li>
                @break
            @case(3)
              <li class="breadcrumb-item active" aria-current="page"><a href="{{route('section.page',[$section->parent_category->parent_category->level,$section->parent_category->parent_category->slug])}}"> {{$section->parent_category->parent_category->name}} </a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="{{route('section.page',[$section->parent_category->level,$section->parent_category->slug])}}"> {{$section->parent_category->name}} </a></li>
              <li class="breadcrumb-item active" aria-current="page"> {{$section->name}} </li>
              @break
            @default
                <li class="breadcrumb-item active" aria-current="page"> {{$section->parent_category->name}} </li>
                <li class="breadcrumb-item active" aria-current="page"> {{$section->name}} </li>
                @break
            @endswitch
          
        </ol>
      </nav>
    </div>
  </section>


  <section class="categories-wrapper my-5">
    <div class="container">
      <div class="row">
        <div class="col-sm-5 col-md-4 col-lg-3">
          <div class="categories-sidebar">
            {{-- <div class="shorting-box">
              <div class="title">
                <h5>Filter by tags</h5>
              </div>
              <div class="shorting-list">
                <ul class="shorting-list-inner d-flex">
                  <li class="shorting-links selected_sorting_type" data-value="newest">
                    <a href="JavaScript:void(0)"> Newest </a>
                  </li>
                  <li class="shorting-links selected_sorting_type" data-value="most-purchased">
                    <a href="JavaScript:void(0)"> Most purchased </a>
                  </li>
                  <li class="shorting-links selected_sorting_type" data-value="oldest">
                    <a href="JavaScript:void(0)"> Oldest </a>
                  </li>
                  <li class="shorting-links selected_sorting_type" data-value="least-purchased">
                    <a href="JavaScript:void(0)"> Least purchased </a>
                  </li>
                </ul>
              </div>
            </div> --}}
            <div class="shorting-box">
              <div class="title">
                <h5>{{trans("pages.section.most_viewed")}}</h5>
              </div>
              <div class="most-viewed-list">
                <ul class="most-viewed-list-inner">
                  @forelse($mostViewed as $data)
                  <li class="most-viewed-links">
                    <a href="{{route('post.details',$data->slug)}}">
                      <div class="most-viewlisting">
                        @php
                          if(isset($data->uploads) && !empty($data->uploads) && count($data->uploads) > 0){
                              $mostViewdImage = asset('storage/'. $data->uploads->first()->path );
                          } else {
                              $mostViewdImage = asset('front/asset/images/no_image.png');
                          }
                        @endphp
                        <img src="{{$mostViewdImage}}" alt="" />
                      </div>
                      <div class="title">
                        <h2 title="{!!$data->title!!}">
                          {!!$data->title!!}
                        </h2>
                        <div class="buy-points-date d-flex">
                          <span>@formattedDate($data->created_at)</span>
                          {{-- <span> <b>Points :</b> 1240 </span> --}}
                        </div>
                      </div>
                    </a>
                  </li>

                  @empty
                    <li class="text-center"><h5>{{trans("global.data_not_available")}}</h5></li>
                  @endforelse
                </ul>
              </div>
            </div>

          </div>
        </div>
        <div class="col-sm-7 col-md-8 col-lg-9">
          <div class="categories-details">
            <div class="categories-details-head p-3">
              <div class="row align-items-center g-3">
                <div class="col">
                  <div class="categories-left-content p-0">
                    <div class="categories-icon">
                    @php
                      if(isset($section->uploads) && !empty($section->uploads) && count($section->uploads) > 0){
                          $imagePath = asset('storage/'. $section->uploads->first()->path );
                      } else {
                          $imagePath = null;
                      }
                    @endphp
                      <img class="img-fluid" src="{{$imagePath}}" alt="" />
                    </div>
                    <h5 class="categories-details-title">{{$section->name}}</h5>
                  </div>
                </div>
                <div class="col-auto">
                  <div class="edit-post">
                    <a href="{{route("post.create")}}" title="{{trans("global.create_post")}}">
                      <svg id="_x31__px" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="m9.02 21h-6.52c-1.378 0-2.5-1.121-2.5-2.5v-16c0-1.379 1.122-2.5 2.5-2.5h12c1.378 0 2.5 1.121 2.5 2.5v6.06c0 .276-.224.5-.5.5s-.5-.224-.5-.5v-6.06c0-.827-.673-1.5-1.5-1.5h-12c-.827 0-1.5.673-1.5 1.5v16c0 .827.673 1.5 1.5 1.5h6.52c.276 0 .5.224.5.5s-.224.5-.5.5z" />
                        <path d="m13.5 9h-10c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h10c.276 0 .5.224.5.5s-.224.5-.5.5z" />
                        <path d="m9.5 13h-6c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h6c.276 0 .5.224.5.5s-.224.5-.5.5z" />
                        <path d="m8.5 5h-5c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h5c.276 0 .5.224.5.5s-.224.5-.5.5z" />
                        <path
                          d="m17.5 24c-3.584 0-6.5-2.916-6.5-6.5s2.916-6.5 6.5-6.5 6.5 2.916 6.5 6.5-2.916 6.5-6.5 6.5zm0-12c-3.033 0-5.5 2.468-5.5 5.5s2.467 5.5 5.5 5.5 5.5-2.468 5.5-5.5-2.467-5.5-5.5-5.5z" />
                        <path d="m17.5 21c-.276 0-.5-.224-.5-.5v-6c0-.276.224-.5.5-.5s.5.224.5.5v6c0 .276-.224.5-.5.5z" />
                        <path d="m20.5 18h-6c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h6c.276 0 .5.224.5.5s-.224.5-.5.5z" />
                      </svg>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="categories-details-listing">
              <ul>
              @forelse ($posters as $poster)
                <li>
                  <div class="post-cat-list">
                    <a href="{{route('post.details',$poster->slug)}}" class="post-cat-content d-flex">
                      <div class="post-cat-title">
                        <div class="post-cat-head d-flex align-item-center">
                          <div class="avatar-icon">
                          @php
                            if(isset($poster->userDetails->uploads) && !empty($poster->userDetails->uploads) && count($poster->userDetails->uploads) > 0){
                              $UserImage = asset('storage/'. $poster->userDetails->uploads->first()->path );
                            } else {
                               $UserImage = asset("front/asset/images/user.png");
                            }
                            @endphp
                            <img src="{{$UserImage}}" alt="" />
                          </div>
                          <div class="title-avatar">
                            <div class="avtar-title-text d-flex align-item-center">
                              <h3>{{$poster->userDetails->user_name}}</h3>
                              <span> @formattedDate($poster->created_at)</span>
                            </div>
                            <p>
                             {!!$poster->user_about!!}
                            </p>
                          </div>
                        </div>

                        <h2 class="mt-3">
                          {!!$poster->title!!}
                        </h2>
                      </div>
                      <div class="post-cat-img-box">
                        @php
                          if(isset($poster->uploads) && !empty($poster->uploads) && count($poster->uploads) > 0){
                              $imagePath = asset('storage/'. $poster->uploads->first()->path );
                          } else {
                              $imagePath = asset('front/asset/images/no_image.png');
                          }
                        @endphp
                        <img src="{{$imagePath}}" alt="" />
                      </div>
                    </a>
                  </div>
                </li>
              @empty
              <li class="text-center"><h2>{{trans("global.data_not_available")}}</h2></li>
              @endforelse
               
              </ul>
            </div>
          </div>

          <div class="center">
          <nav aria-label="Page navigation example">
              {{ $posters->links() }}
          </nav>
            
          </div>
        </div>
      </div>
    </div>
  </section>


@endsection
