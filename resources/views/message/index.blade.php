@extends('layouts.app')
@section("style")
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
@endsection

@section('content')
<!-- hero privacy  -->
<section class="privacy-hero">
  <div class="container">
    <div class="hero-banner">
      <div class="prc-title">
        <h2>{{__('cruds.global.user_chat')}} <span>{{__('global.chat')}}</span></h2>
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
                <li class="breadcrumb-item"><a href="{{route('user.project.request')}}">{{trans("cruds.create_project.project")}} {{__('cruds.create_project.request')}}</a></li>
                <li class="breadcrumb-item active">{{trans("global.chat")}}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- ChatBox Section Start -->
<section class="single-wrapper">
    <div class="container">
        <div class="px-0 chatboxGroup open" id="chatboxGroup">
            <div class="row h-100 gx-3">
                @php
                $ifRoleUser = auth()->user()->role_id == config('constant.role.user');
                $ifRoleCreator = auth()->user()->role_id == config('constant.role.creator');
                @endphp

                {{-- dynamic users and seach bar --}}
                @if($ifRoleUser)
                <div class="col-xxl-3 col-md-4 h-100 animate__animated animate__fadeInUp sidebarclass">
                    <div class="sidebar h-100 p-3 rounded-4">
                        <div class="user-list h-100">
                            <div class="row h-100 overflow-hidden flex-column flex-nowrap">
                                <!-- saerch user -->
                                <div class="col-12 mb-3">
                                    <div class="input-group searchbar">
                                        <input type="text" id="searchInput" class="form-control rounded-pill" placeholder="{{__('cruds.create_project.fields.user_name')}}" aria-label="Username" aria-describedby="basic-addon1">
                                        
                                        <button class="shadow-none btn add_btn dash-btn green-bg w-115 m-0 border-0 rounded-pill">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20.71 19.29L17.31 15.9C18.407 14.5025 19.0022 12.7767 19 11C19 9.41775 18.5308 7.87103 17.6518 6.55544C16.7727 5.23985 15.5233 4.21447 14.0615 3.60897C12.5997 3.00347 10.9911 2.84504 9.43928 3.15372C7.88743 3.4624 6.46197 4.22433 5.34315 5.34315C4.22433 6.46197 3.4624 7.88743 3.15372 9.43928C2.84504 10.9911 3.00347 12.5997 3.60897 14.0615C4.21447 15.5233 5.23985 16.7727 6.55544 17.6518C7.87103 18.5308 9.41775 19 11 19C12.7767 19.0022 14.5025 18.407 15.9 17.31L19.29 20.71C19.383 20.8037 19.4936 20.8781 19.6154 20.9289C19.7373 20.9797 19.868 21.0058 20 21.0058C20.132 21.0058 20.2627 20.9797 20.3846 20.9289C20.5064 20.8781 20.617 20.8037 20.71 20.71C20.8037 20.617 20.8781 20.5064 20.9289 20.3846C20.9797 20.2627 21.0058 20.132 21.0058 20C21.0058 19.868 20.9797 19.7373 20.9289 19.6154C20.8781 19.4936 20.8037 19.383 20.71 19.29ZM5 11C5 9.81332 5.3519 8.65328 6.01119 7.66658C6.67047 6.67989 7.60755 5.91085 8.7039 5.45673C9.80026 5.0026 11.0067 4.88378 12.1705 5.11529C13.3344 5.3468 14.4035 5.91825 15.2426 6.75736C16.0818 7.59648 16.6532 8.66558 16.8847 9.82946C17.1162 10.9933 16.9974 12.1997 16.5433 13.2961C16.0892 14.3925 15.3201 15.3295 14.3334 15.9888C13.3467 16.6481 12.1867 17 11 17C9.4087 17 7.88258 16.3679 6.75736 15.2426C5.63214 14.1174 5 12.5913 5 11Z" fill="black" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <!-- search user end -->

                                <!-- dynamic users -->
                                <div class="col-12 h-100 flex-fill overflow-y-auto">
                                    <ul id="userGroupList" class="list-group rounded-0">
                                        @if(isset($creators))
                                        @foreach($creators as $user)
                                        <li class="list-group-item userporfile activeAccount dynamicUserList" data-user-id="{{$user->id}}" data-project-id="{{$projectId}}" data-user-name="{{$user->user_name}}">
                                            @php
                                            if(isset($user->uploads) && !empty($user->uploads) && count($user->uploads) > 0){
                                            $imagePath = asset('storage/'. $user->uploads->first()->path );
                                            } else {
                                            $imagePath = asset('dummy-user.svg');
                                            }
                                            @endphp
                                            <div class="userimage">
                                                <img class="userpic" src="{{$imagePath}}" alt="User Image">
                                            </div>
                                            <div class="useraccount">
                                                <h5 class="content"><span class="text-truncate">{{ucfirst($user->user_name)}}</span> <span class="time"></span></h5>
                                            </div>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <!-- dynamic users end -->
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                {{-- dynamic users and seach bar --}}

                <!-- main right panel for creator -->
                @if($ifRoleCreator)
                    <div class="col-xxl-12 col-lg-12 chat-panel h-100 chatscreen">
                        <div class="card chatcard h-100 overflow-hidden animate__animated animate__fadeInUp">
                            <div class="row h-100 flex-column flex-nowrap overflow-hidden mx-0 gx-0">
                                <div class="col-12">
                                    <div class="chat-header p-3 d-flex justify-content-between align-items-center">
                                        @php
                                            if(isset($user->uploads) && !empty($user->uploads) && count($user->uploads) > 0){
                                            $imagePath = asset('storage/'. $user->uploads->first()->path );
                                            } else {
                                            $imagePath = asset('dummy-user.svg' );
                                            }
                                        @endphp
                                        <div class="userporfile activeAccount">
                                            <div class="userimage">
                                                <img class="userpic" src="{{$imagePath}}" alt="Image">
                                            </div>

                                            <div class="useraccount text-truncate">
                                                <h4 class="m-0 text-truncate" id="chatHeader">{{ucfirst($user->user_name)}}</h4>
                                            </div>
                                            
                                            <div class="useraccount d-none">
                                                <button class="btn btn-primary">Confirm</button>
                                            </div>
                                        </div>

                                        <div class="usersetting d-flex align-items-center gap-2">
                                            <button id="refresh-messages" class="btn btn-primary" data-user-name="{{$user->user_name}}" data-user-id="{{$user->id}}" data-project-id="{{$projectId}}">
                                                <i class="fa fa-refresh"></i>
                                            </button>
                                            
                                            <button id="closeCreatorScreen" class="btn close-btn d-md-none d-flex shadow-none border-0">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.4099 11.9999L19.7099 5.70994C19.8982 5.52164 20.004 5.26624 20.004 4.99994C20.004 4.73364 19.8982 4.47825 19.7099 4.28994C19.5216 4.10164 19.2662 3.99585 18.9999 3.99585C18.7336 3.99585 18.4782 4.10164 18.2899 4.28994L11.9999 10.5899L5.70994 4.28994C5.52164 4.10164 5.26624 3.99585 4.99994 3.99585C4.73364 3.99585 4.47824 4.10164 4.28994 4.28994C4.10164 4.47825 3.99585 4.73364 3.99585 4.99994C3.99585 5.26624 4.10164 5.52164 4.28994 5.70994L10.5899 11.9999L4.28994 18.2899C4.19621 18.3829 4.12182 18.4935 4.07105 18.6154C4.02028 18.7372 3.99414 18.8679 3.99414 18.9999C3.99414 19.132 4.02028 19.2627 4.07105 19.3845C4.12182 19.5064 4.19621 19.617 4.28994 19.7099C4.3829 19.8037 4.4935 19.8781 4.61536 19.9288C4.73722 19.9796 4.86793 20.0057 4.99994 20.0057C5.13195 20.0057 5.26266 19.9796 5.38452 19.9288C5.50638 19.8781 5.61698 19.8037 5.70994 19.7099L11.9999 13.4099L18.2899 19.7099C18.3829 19.8037 18.4935 19.8781 18.6154 19.9288C18.7372 19.9796 18.8679 20.0057 18.9999 20.0057C19.132 20.0057 19.2627 19.9796 19.3845 19.9288C19.5064 19.8781 19.617 19.8037 19.7099 19.7099C19.8037 19.617 19.8781 19.5064 19.9288 19.3845C19.9796 19.2627 20.0057 19.132 20.0057 18.9999C20.0057 18.8679 19.9796 18.7372 19.9288 18.6154C19.8781 18.4935 19.8037 18.3829 19.7099 18.2899L13.4099 11.9999Z" fill="black" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @include('message.form')
                            </div>
                        </div>
                    </div>
                @endif
                <!-- right panel end for creator -->

                <!-- main right panel for user. -->
                @if($ifRoleUser)
                    <div class="{{$ifRoleUser ? 'col-xxl-9 col-md-8' : 'col-xxl-12 col-lg-12' }} chat-panel h-100 chatscreen">
                        {{-- mesage-screen-blade-file --}}
                    </div>
                @endif
                <!-- main right panel end for user. -->
            </div>
        </div>
    </div>
</section>
<!-- ChatBox Section End -->
@endsection

@section("scripts")
<script>

// // lazy loading start.
// // lazy loading end


    $(document).on('click', '.dynamicUserList', function(){
        $('.chatscreen').show();
    });

    $(document).ready(function() {      
        setTimeout(function(){
            $('.dynamicUserList:first').trigger('click');
        }, 100)
        // show chat screen when user click in sidebar
        $(document).on('click', '.dynamicUserList', function() {
            $('.dynamicUserList').removeClass('active');
            $(this).addClass('active');
            var userId = $(this).data('user-id');
            var userName = $(this).data('user-name');
            var projectId = $(this).data('project-id');
            var url = @json(route('message.screen'));
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    user_id: userId,
                    user_name: userName,
                    project_id: projectId,
                },
                async: false,
                dataType: 'json',
                success: function(response) {
                    $('#messageContainer').empty();
                    $('.chatscreen').html(response.html);
                    setTimeout(function() {
                        scrollToBottom();
                    }, 2000)
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function(event) {
        function scrollToBottom() {
            var chatBox = document.getElementById("messageContainer");
            chatBox.scrollTop = chatBox.scrollHeight;
        }
        scrollToBottom();
    });
    var maxHeight = 80;
    function updateTextAreaHeight() {
        var textarea = document.getElementById("textareaheight");
        var messageContent = textarea.value.trim().toLowerCase();
        var ignoreKeywords = ['keyword1', 'keyword2', 'keyword3'];
        var ignore = ignoreKeywords.some(function(keyword) {
            return messageContent.indexOf(keyword) !== -1;
        });
        if (!ignore) {
            textarea.style.height = "40px"; 
            textarea.style.height = Math.min(textarea.scrollHeight, maxHeight) + "px"; 
            textarea.style.overflowY = textarea.scrollHeight > maxHeight ? "auto" : "hidden"; 
        }
    }
    
    
    // Add an event listener to the textarea for input events
    messageInput.addEventListener('input', function(event) {
        if (event.shiftKey && event.keyCode === 13) {
            messageInput.value += '\n';
        }
        adjustTextareaHeight();
    });
    // Add an event listener to the textarea for keydown events
    messageInput.addEventListener('keydown', function(event) {
        if (event.keyCode === 13 && !event.shiftKey) {
            event.preventDefault(); 
            sendMessage(); 
        }
    });
    // Function to adjust the height of the textarea based on its content
    function adjustTextareaHeight() {
        messageInput.style.height = 'auto';
        messageInput.style.height = Math.max(messageInput.scrollHeight, 20) + 'px';
    }
</script>


@include("message.partials.script")
@endsection