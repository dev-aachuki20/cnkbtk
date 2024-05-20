@extends('layouts.app')
@section("styles")
<link rel="stylesheet" href="{{ asset('admins/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section("content")
<!-- hero privacy  -->
    <section class="privacy-hero">
      <div class="container">
        <div class="hero-banner">
          <div class="prc-title">
            <h2>{{trans("pages.user.post_history_tab.post")}} <span>{{trans("pages.user.post_history_tab.history")}}</span></h2>
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
              {{trans("global.post_history")}}
            </li>
          </ol>
        </nav>
      </div>
    </section>


    <div class="profile-wrapper-cp">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-4 col-lg-3 col-xl-3">
            <div class="following-list">
              @include('user.partials.usercard')
            </div>
          </div>
         
          <div class="col-12 col-md-8 col-lg-9 col-xl-9">
            <div class="categories-details">
              <div class="categories-details-head p-3">
                <div class="row align-items-center g-3">
                  <div class="col">
                    <div class="categories-left-content p-0">
                      <div class="categories-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><g id="Line"><path d="M27,29.75H11A2.75,2.75,0,0,1,8.25,27v-.45a7.75,7.75,0,0,1,0-15.1V5A2.75,2.75,0,0,1,11,2.25H22.17a2.74,2.74,0,0,1,1.95.81l4.82,4.82a2.74,2.74,0,0,1,.81,2V27A2.75,2.75,0,0,1,27,29.75Zm-17.25-3V27A1.25,1.25,0,0,0,11,28.25H27A1.25,1.25,0,0,0,28.25,27V10.75H24A2.75,2.75,0,0,1,21.25,8V3.75H11A1.25,1.25,0,0,0,9.75,5v6.25H10a7.75,7.75,0,0,1,0,15.5Zm.25-14A6.25,6.25,0,1,0,16.25,19,6.25,6.25,0,0,0,10,12.75ZM22.75,3.89V8A1.25,1.25,0,0,0,24,9.25h4.11a1.39,1.39,0,0,0-.23-.31L23.06,4.12A1.39,1.39,0,0,0,22.75,3.89ZM25,22.75H20a.75.75,0,0,1,0-1.5h5a.75.75,0,0,1,0,1.5ZM8.5,21.25A.74.74,0,0,1,8,21,.75.75,0,0,1,8,20l1.28-1.28V16a.75.75,0,0,1,1.5,0v3a.75.75,0,0,1-.22.53L9,21A.74.74,0,0,1,8.5,21.25ZM25,18.75H21a.75.75,0,0,1,0-1.5h4a.75.75,0,0,1,0,1.5Zm0-4H20a.75.75,0,0,1,0-1.5h5a.75.75,0,0,1,0,1.5Zm-7-4H15a.75.75,0,0,1,0-1.5h3a.75.75,0,0,1,0,1.5Z"/></g>
                        </svg>
                      </div>
                      <h5 class="categories-details-title text-nowrap"> {{trans("global.post_history")}}</h5>
                    </div>
                  </div>
                  <div class="col-auto">
                    <div class="edit-post">
                      <a href="{{route('post.create')}}" title="Create post">
                        <svg id="_x31__px" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg">
                          <path d="m9.02 21h-6.52c-1.378 0-2.5-1.121-2.5-2.5v-16c0-1.379 1.122-2.5 2.5-2.5h12c1.378 0 2.5 1.121 2.5 2.5v6.06c0 .276-.224.5-.5.5s-.5-.224-.5-.5v-6.06c0-.827-.673-1.5-1.5-1.5h-12c-.827 0-1.5.673-1.5 1.5v16c0 .827.673 1.5 1.5 1.5h6.52c.276 0 .5.224.5.5s-.224.5-.5.5z"></path>
                          <path d="m13.5 9h-10c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h10c.276 0 .5.224.5.5s-.224.5-.5.5z"></path>
                          <path d="m9.5 13h-6c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h6c.276 0 .5.224.5.5s-.224.5-.5.5z"></path>
                          <path d="m8.5 5h-5c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h5c.276 0 .5.224.5.5s-.224.5-.5.5z"></path>
                          <path d="m17.5 24c-3.584 0-6.5-2.916-6.5-6.5s2.916-6.5 6.5-6.5 6.5 2.916 6.5 6.5-2.916 6.5-6.5 6.5zm0-12c-3.033 0-5.5 2.468-5.5 5.5s2.467 5.5 5.5 5.5 5.5-2.468 5.5-5.5-2.467-5.5-5.5-5.5z"></path>
                          <path d="m17.5 21c-.276 0-.5-.224-.5-.5v-6c0-.276.224-.5.5-.5s.5.224.5.5v6c0 .276-.224.5-.5.5z"></path>
                          <path d="m20.5 18h-6c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h6c.276 0 .5.224.5.5s-.224.5-.5.5z"></path>
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="categories-details-listing">
                 {{-- @php 
                    $userImagePath = asset('front/asset/images/user.png');
                    if(isset(auth()->user()->uploads) && !empty(auth()->user()->uploads) && count(auth()->user()->uploads) > 0){
                        $userImagePath = asset('storage/'.auth()->user()->uploads->first()->path );
                    } 
                    
                @endphp --}}
                <ul>
                  @forelse($posters as $poster)
                  <li>
                    <div class="post-cat-list mb-3">
                      <a  class="post-cat-content d-lg-flex">
                        <div class="post-cat-title">
                          <div class="post-cat-head d-flex align-item-center">
                            {{-- <div class="avatar-icon">
                              <img src="{{$userImagePath}}" alt="">
                            </div> --}}
                            <div class="title-avatar">
                              <div class="avtar-title-text d-flex align-item-center">
                                {{-- <h3>{{auth()->user()->name}}</h3> --}}
                                <span>{{trans("global.date")}} : @formattedDate($poster->created_at)</span>
                              </div>
                              {{-- <p>{!!auth()->user()->user_about !!}</p> --}}
                            </div>
                          </div>
                          <h2 class="mt-3">{{$poster->title}}</h2>
                        </div>

                         @php 
                            $posterImage = asset('front/asset/images/no_image.png');
                            if(isset($poster->uploads) && !empty($poster->uploads) && count($poster->uploads) > 0){
                                $posterImage = asset('storage/'.$poster->uploads->first()->path );
                            } 
                            
                        @endphp
                        <div class="post-cat-img-box">
                          <img src="{{$posterImage}}" alt="">
                        </div>
                      </a>
                    </div>

                    <div class="d-block postBtn-box">
                      <a href="{{route('post.edit',Crypt::encrypt($poster->id))}}" class="btn btn-primary">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                        <path d="M16 5l3 3" />
                      </svg>
                     {{trans("global.edit")}}
                      </a>
                      <a href="{{route('post.show',Crypt::encrypt($poster->id))}}" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                          <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                        </svg>
                      {{trans("global.view")}}
                      </a>
                      <form action="{{route('post.destroy',Crypt::encrypt($poster->id))}}" method="POST" class="deleteForm d-inline" >
                       
                          <input type="hidden" name="_method" value="DELETE"> 
                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                          <button class="btn btn-danger record_delete_btn" title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                              <path d="M4 7l16 0" />
                              <path d="M10 11l0 6" />
                              <path d="M14 11l0 6" />
                              <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                              <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                            </svg>{{trans("global.delete")}}
                          </button>
                    </form>
                      @if($poster->status == 1)
                      <a href="javascript:void(0)" class="btn  rowStatus statusSuccess_btn" data-status="0" data-status-id="{{Crypt::encrypt($poster->id)}}"> 
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-check" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                        <path d="M15 19l2 2l4 -4" />
                      </svg>
                      <span class="statusText">{{trans("cruds.global.active")}}</span>
                      </a>
                      @else
                      <a href="javascript:void(0)" class="btn  rowStatus record_delete_btn" data-status="1" data-status-id="{{Crypt::encrypt($poster->id)}}">
                      
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-check" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                        <path d="M15 19l2 2l4 -4" />
                      </svg>
                      <span class="statusText">{{trans("cruds.global.in_active")}}</span>
                      </a>
                      @endif
                     
                    </div>
                  </li>
                  @empty

                  <div class="text-center mt-5">
                    <h4>{{trans("pages.user.post_history_tab.posters_not_available")}}</h4>
                  </div>
                  @endforelse
                  
                </ul>
              </div>
            </div>
            <div class="center">
              <div class="pagination">
                {{ $posters->links('pagination::bootstrap-5') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@section("scripts")
<script src="{{ asset('admins/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
  $(document).ready(function(){
      $(document).on('submit', '.deleteForm', function(e){
          e.preventDefault();
          var formData = $(this).serialize();
          var url = $(this).attr('action');
          swal.fire({
              title: "{{trans('messages.are_you_sure')}}",
              text: "{{trans('pages.post.form.delete_message')}}",
              icon: 'question',
              type: "warning",
              showCancelButton: !0,
              confirmButtonText: "{{trans('cruds.global.delete_btn_text')}}",
              cancelButtonText: "{{trans('cruds.global.cancel_delete_btn_text')}}",
              reverseButtons: !0
          }).then(function (e) {
            if (e.value === true) {
              $.ajax({
                  type: 'delete',
                  url: url,
                  data: formData,
                  dataType: 'JSON',
                  success: function (response) {
                    swal.fire({
                      title: "{{trans('global.alert.success')}}",
                      icon: 'success',
                      text: response.message,
                    }).then(function (e) {
                      location.reload();
                    });
                  },
                  error:function(){
                    swal.fire({
                      title: "{{trans('global.alert.error')}}",
                      icon: 'error',
                      text: response.message.message,
                    })
                  } 
              });

            } else {
              e.dismiss;
            }
          });
      });

      $(document).on('click', '.rowStatus', function(event) {
        var $this = $(this);
        var id = $this.attr("data-status-id");
        var status = $this.attr("data-status");
        Swal.fire({
            title: "{{trans('messages.are_you_sure')}}",
            text: "{{trans('messages.update_warning')}}",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: `{{trans('cruds.global.update')}}`,
            cancelButtonText: `{{trans('cruds.global.cancel')}}`,
        })
        .then((result) => {

            if (!result.isDismissed) {
                $.ajax({
                    type: "POST",
                    url: "{{route('post.updateStatus')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        id: id,
                        status: status,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend:function(){
                      showLoader();
                    },
                    success: function(response) {
                        toastr.success(response.message, '{{trans("global.alert.success")}}');
                        if(status == 0){
                          $this.addClass("record_delete_btn").removeClass("statusSuccess_btn").attr("data-status",1);;
                          $this.find(".statusText").text('{{trans("global.in_active")}}');
                        }else{
                          $this.removeClass("record_delete_btn").addClass("statusSuccess_btn").attr("data-status",0);
                          $this.find(".statusText").text('{{trans("global.active")}}');
                        }
                    },
                    error: function(response) {
                        let errorMessages = '';
                        $.each(response.responseJSON.errors, function(key, value) {
                            $.each(value, function(i, message) {
                                errorMessages += '<li>' + message + '</li>';
                            });
                        });
                        toastr.error(errorMessages);
                    },
                    complete: function() {
                        hideLoader();
                    }
                });
            } else {
                return false;
            }
        });
      });
  });
</script>
@endsection