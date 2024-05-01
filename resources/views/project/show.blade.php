@extends('layouts.app')
@section('content')

<!-- hero privacy  -->
<section class="privacy-hero">
  <div class="container">
    <div class="hero-banner">
      <div class="prc-title">
        <h2>{{trans("cruds.global.view")}} {{trans('cruds.create_project.project_details')}}</h2>
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
          {{trans('cruds.create_project.project_details')}}
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
            <div class="col">
              <ul>
                <li>
                  <div class="main-title">
                    <h6> <span>{{trans("cruds.create_project.fields.type")}} :</span> {{ $project->type  ?? ''}}</h6>
                  </div>
                </li>
                <li>
                  <div class="description-text">
                    <span>{{trans("cruds.create_project.fields.tags")}} :</span> @if(app()->getLocale() == 'en')
                    {{ $project->tags->name_en ?? '' }}
                    @else
                    {{ $project->tags->name_ch ?? '' }}
                    @endif
                  </div>
                </li>

                <li>
                  <div class="main-title">
                    <h6> <span>{{trans("cruds.create_project.fields.budget")}} :</span>{{ $project->budget  ?? ''}} CN¥</h6>
                  </div>
                </li>


                <li>
                  <div class="main-title">
                    <h6> <span>{{trans("cruds.create_project.fields.creators")}} :</span> @foreach ($project->creators as $creator)
                      {{ $creator->user_name }}
                      @endforeach
                    </h6>
                  </div>
                </li>

                <li>
                  <div class="main-title">
                    <h6> <span>{{trans("cruds.create_project.fields.description")}} :</span> {!! $project->comment ?? '' !!}</h6>
                  </div>
                </li>

                <li>
                  <div class="main-title">
                    <h6> <span>{{trans("cruds.global.status")}}:</span> @if($project->status == 1)
                      <span class="badge badge-info mr-1">{{trans("cruds.global.active")}}</span>
                      @else
                      <span class="badge badge-danger mr-1">{{trans("cruds.global.in_active")}}</span>
                      @endif
                    </h6>
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