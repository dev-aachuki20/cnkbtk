@extends('layouts.app')



@section('content')



<!-- hero privacy  -->

<section class="privacy-hero">

    <div class="container">

        <div class="hero-banner">

            <div class="prc-title">

                <h2>{{trans("cruds.create_project.project")}} {{__('cruds.create_project.request')}}</h2>

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

                    {{trans("cruds.create_project.project")}} {{__('cruds.create_project.request')}}

                </li>

            </ol>

        </nav>

    </div>

</section>



<section class="single-wrapper ">

    <div class="container project_card_group">

        <div class="row g-3">

            <div class="col-lg-6 col-md-10 col-12">

                <div class="right-single-box blacklist_box_user project_details_card">

                    <div class="row gx-3">

                    

                    <div class="col mobile-view-responsive">

                        <ul>

                            <li>

                                <div class="main-title">

                                    <h6> <span>{{trans("cruds.create_project.fields.title")}} :</span> {{ ucfirst($project->title)  ?? ''}}</h6>

                                </div>

                            </li>

                            <li>

                                <div class="main-title">

                                    <h6> <span>{{trans("cruds.create_project.fields.user_name")}} :</span> {{ $project->user->user_name  ?? ''}}</h6>

                                </div>

                            </li>

                            <li>

                                <div class="main-title">

                                    <h6> <span>{{trans("cruds.create_project.project")}} {{trans("cruds.create_project.fields.type")}} :</span> {{ $project->type  ?? ''}}</h6>

                                </div>

                            </li>

                            <li>

                                <div class="description-text main-title">

                                    <h6> <span>{{trans("cruds.create_project.fields.tags")}} :</span>

                                        @php

                                            $tagIds = explode(',', $project->tags); 

                                            $tags = \App\Models\Tag::whereIn('id', $tagIds)->get();

                                            $tagNames = app()->getLocale() == 'en' ? $tags->pluck('name_en')->toArray() : $tags->pluck('name_ch')->toArray();

                                        @endphp

                                            {{ implode(', ', $tagNames) }}

                                    </h6>

                                </div>

                            </li>



                            <li>

                                <div class="main-title">

                                    <h6> <span>{{trans("cruds.create_project.fields.budget")}} :</span>{{ $project->budget  ?? ''}} CN¥</h6>

                                </div>

                            </li>



                            <li>

                                <div class="main-title description-content">

                                    <h6> <span>{{trans("cruds.create_project.fields.description")}} </span></h6>                                    

                                    <div class="content" id="content">

                                        <div class="description-text">

                                            {!! $project->comment ?? '' !!}

                                        </div>

                                        @if(isset($project->comment))

                                            <button type="button" class="btn btn-dark add-bid-btn btn-sm read-more-btn">{{__('cruds.global.readmore')}}</button>

                                        @endif

                                    </div>

                                </div>

                            </li>

                            <li>

                            <div class="col-12 buttongroupborder">

                                    <div class="row gx-3 row-gap-3">

                            @if($project->project_status == 1)

                        <div class="col-auto text-end">

                            <a href="{{ route('message.index', ['projectId' => $project->id]) }}" class="btn btn-primary ml-auto cancel-btn" id="message" data-project-id="{{$project->id}}" data-user-id="{{$project->user_id}}">

                                {{__('cruds.global.message')}}

                            </a>

                        </div>

                    @endif



                    @if($creatorStatus == 1 && $project->project_status == 1 && $creatorRatingStatus == null)                                            

                        <div class="col-auto">

                            <button class="btn btn-primary ml-auto cancel-btn messages-button" type="button" title="{{__('cruds.global.rating')}}" id="add_rating" data-project-id="{{$project->id}}">{{__('cruds.global.rating')}}</button>

                        </div>

                    @endif

</div>
</div>





                    @if(isset($project) && $project->status == 1)

                                <!-- buttons -->

                                @if($project->project_status != 1)

                                <div class="col-12 buttongroupborder">

                                    <div class="row gx-3 row-gap-3">

                                        <div class="col-auto">

                                            <button type="button" class="btn btn-secondary add-bid-btn" id="addBidBtn" data-bid="{{$bid}}" data-project-id="{{$project->id}}" data-user-id="{{$project->user_id}}" data-creator-id="{{Auth::user()->id}}" {{$project->project_status == 1  ? 'disabled' : ''}}>

                                                {{ $creatorStatus == 2 ? __('cruds.create_project.headings.bid_added') : __('cruds.create_project.headings.add_bid') }}

                                            </button>

                                        </div>

                                        @if($assignStatus == 1)

                                        <div class="col-auto">

                                            <button type="button" class="btn btn-success ml-3 confirm-btn" id="confirm" data-project-id="{{$project->id}}" data-user-id="{{$project->user_id}}" data-creator-id="{{Auth::user()->id}}" {{$project->project_status == 1  ? 'disabled' : ''}}>

                                                {{$project->project_status == 1  ? __('cruds.global.confirmed') : __('cruds.create_project.headings.confirm_project')}}

                                            </button>

                                        </div>

                                        @endif

                                    </div>

                                </div>

                                @endif

                            </li>

                        </ul>

                    </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

    </div>



    @include("project.add_bid_form")

    @include("project.add_rating_form") 

</section>



@endsection



@section("scripts")

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script src="{{ asset('admins/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

<!-- Datatables -->

<script src="{{ asset('admins/plugins/datatables/jquery.dataTables.min.js')}}"></script>

<script src="{{ asset('admins/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{ asset('admins/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>

<script src="{{ asset('admins/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script src="{{ asset('admins/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>

<script src="{{ asset('admins/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>

<script src="{{ asset('admins/plugins/jszip/jszip.min.js')}}"></script>

<script src="{{ asset('admins/plugins/pdfmake/pdfmake.min.js')}}"></script>

<script src="{{ asset('admins/plugins/pdfmake/vfs_fonts.js')}}"></script>

<script src="{{ asset('admins/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>

<script src="{{ asset('admins/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>

<script src="{{ asset('admins/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script src="{{ asset('admins/js/common.js')}}"></script>



    @include("project-request.partials.script")



    <script>

        $(document).ready(function() {

          $(document).on('click', '#add_rating', function(e){

              e.preventDefault();

              var url = '{{route("finish.project")}}';

              var projectId = $(this).data('project-id');

              // Set project ID in the form

              $('#project_ids').val(projectId);

  

              // Show the modal

              $('#finishProjectRatingModal').modal('show');

          });

  

          $('#finishProjectRatingForm').on('submit', function(e){

              e.preventDefault();

              var form = $(this);

              var url = form.attr('action');

              var formData = form.serialize();

              swal.fire({

                  // title: "{{trans('messages.are_you_sure')}}",

                  text: "{{trans('messages.finished_project_warning_message')}}",

                  icon: 'warning',

                  type: "warning",

                  showCancelButton: !0,

                  confirmButtonText: "{{trans('cruds.finished_project.options.finish_btn_text')}}",

                  cancelButtonText: "{{trans('cruds.global.cancel_delete_btn_text')}}",

                  reverseButtons: !0

              }).then(function(e) {

                  if (e.value === true) {

                      $.ajax({

                          headers: {

                              'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content')

                          },

                          type: 'POST',

                          url: url,

                          data: formData,

                          dataType: 'JSON',

                          beforeSend: function(response) {

                              showLoader();

                          },

                          success: function(response) {

                              toastr.success(response.message);

                              $('#finishProjectRatingModal').modal('hide');

                              setTimeout(function() {

                                  location.reload();

                              }, 1500);

                          },

                          error: function(response) {

                              if (response.responseJSON.errors && response.responseJSON.errors.remark) {

                                  var errorMessage = response.responseJSON.errors.remark[0];

                                  // $('#remark').after('<div id="remark-error" class="text-danger mt-2">' + errorMessage + '</div>');

                                  $('#starRatings').after('<div id="star_rating-error" class="text-danger mt-2">' + errorMessage + '</div>');

  

                              } else {

                                  var errorMessage = response.responseJSON.message || 'An error occurred. Please try again.';

                                  // $('#remark').after('<div id="remark-error" class="text-danger mt-2">' + errorMessage + '</div>');

                                  $('#starRatings').after('<div id="star_rating-error" class="text-danger mt-2">' + errorMessage + '</div>');

                              }

                          },

                          complete: function() {

                              hideLoader();

                          }

                          

                      });

                  } else {

                      e.dismiss;

                  }

              });

          });

  

  

          // Reset form values when the modal is hidden

          $('#finishProjectRatingModal').on('hidden.bs.modal', function() {

              $('#finishProjectRatingForm')[0].reset();

              $('#remark-error').remove();

          });

        });

  </script>

@endsection 