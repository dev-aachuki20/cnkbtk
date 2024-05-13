@extends('layouts.app')
@section("style")
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
@endsection

@section('content')

<section class="breadcrumb-wrap">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route("home")}}">{{trans("global.home")}}</a></li>
                <!-- <li class="breadcrumb-item active">{{ Str::ucfirst(array_search(auth()->user()->role_id, config("constant.role"))) }}</li> -->
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
                <div class="col-xxl-3 col-lg-4 col-md-5 h-100 animate__animated animate__fadeInUp">
                    <div class="sidebar h-100 p-3 rounded-4">
                        <div class="user-list h-100">
                            <div class="row h-100 overflow-hidden flex-column flex-nowrap">
                                <div class="col-12 mb-3">
                                    <div class="input-group searchbar">
                                        <!-- saerch user -->
                                        <input type="text" id="searchInput" class="form-control rounded-pill" placeholder="{{__('cruds.create_project.fields.user_name')}}" aria-label="Username" aria-describedby="basic-addon1">
                                        <!-- search user end -->
                                        <button class="shadow-none btn add_btn dash-btn green-bg w-115 m-0 border-0 rounded-pill">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20.71 19.29L17.31 15.9C18.407 14.5025 19.0022 12.7767 19 11C19 9.41775 18.5308 7.87103 17.6518 6.55544C16.7727 5.23985 15.5233 4.21447 14.0615 3.60897C12.5997 3.00347 10.9911 2.84504 9.43928 3.15372C7.88743 3.4624 6.46197 4.22433 5.34315 5.34315C4.22433 6.46197 3.4624 7.88743 3.15372 9.43928C2.84504 10.9911 3.00347 12.5997 3.60897 14.0615C4.21447 15.5233 5.23985 16.7727 6.55544 17.6518C7.87103 18.5308 9.41775 19 11 19C12.7767 19.0022 14.5025 18.407 15.9 17.31L19.29 20.71C19.383 20.8037 19.4936 20.8781 19.6154 20.9289C19.7373 20.9797 19.868 21.0058 20 21.0058C20.132 21.0058 20.2627 20.9797 20.3846 20.9289C20.5064 20.8781 20.617 20.8037 20.71 20.71C20.8037 20.617 20.8781 20.5064 20.9289 20.3846C20.9797 20.2627 21.0058 20.132 21.0058 20C21.0058 19.868 20.9797 19.7373 20.9289 19.6154C20.8781 19.4936 20.8037 19.383 20.71 19.29ZM5 11C5 9.81332 5.3519 8.65328 6.01119 7.66658C6.67047 6.67989 7.60755 5.91085 8.7039 5.45673C9.80026 5.0026 11.0067 4.88378 12.1705 5.11529C13.3344 5.3468 14.4035 5.91825 15.2426 6.75736C16.0818 7.59648 16.6532 8.66558 16.8847 9.82946C17.1162 10.9933 16.9974 12.1997 16.5433 13.2961C16.0892 14.3925 15.3201 15.3295 14.3334 15.9888C13.3467 16.6481 12.1867 17 11 17C9.4087 17 7.88258 16.3679 6.75736 15.2426C5.63214 14.1174 5 12.5913 5 11Z" fill="black" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <!-- dynamic users -->
                                <div class="col-12 h-100 flex-fill overflow-y-auto">
                                    <ul id="userGroupList" class="list-group rounded-0">
                                        @if(isset($users))
                                        @foreach($users as $user)
                                        <li class="list-group-item userporfile activeAccount dynamicUserList" data-user-id="{{$user->id}}" data-user-name="{{$user->user_name}}">
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
                                                <h5 class="content"><span class="text-truncate">{{$user->user_name}}</span> <span class="time">11:41 AM</span></h5>
                                                {{-- <p class="text-truncate content">Sent To : {{auth()->user()->user_name}}</p> --}}
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
                <!-- chat screen right panel -->
                <!-- show welcome authname if no any user selected in the sidebar -->

                <div class="col-xxl-9 col-lg-8 col-md-7 chat-panel h-100 chatscreen">
                    <div class="card chatcard h-100">
                        <div class="row h-100 flex-column flex-nowrap overflow-hidden groupChatScreen">
                            <div class="col-12">
                                <div class="welcome-screen">
                                    @php
                                    $authuser = auth()->user();
                                    if(isset($authuser->uploads) && !empty($authuser->uploads) && count($authuser->uploads) > 0){
                                    $authimagePath = asset('storage/'. $authuser->uploads->first()->path );
                                    } else {
                                    $authimagePath = asset('dummy-user.svg');
                                    }
                                    @endphp
                                    <div class="userporfile">
                                        <div class="userimage">
                                            <img class="userpic" src="{{$authimagePath}}" alt="Super Admin">
                                        </div>
                                        <div class="useraccount text-truncate">
                                            <h3>Welcome!</h3>
                                            <h4 class="welcome_user m-0 text-truncate">{{auth()->user()->user_name}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- chat screen right panel end -->
            </div>
        </div>
    </div>
</section>
<!-- ChatBox Section End -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Searching users
    $('#searchInput').on('input', function() {
        var searchQuery = $(this).val().trim().toLowerCase();
        $('.userporfile').each(function() {
            var username = $(this).find('.content').text().trim().toLowerCase();
            if (username.includes(searchQuery)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    $(document).ready(function() {
        // show chat screen when click user in sidebar
        $(document).on('click', '.dynamicUserList', function() {
            $('.dynamicUserList').removeClass('active');
            $(this).addClass('active');

            var userId = $(this).data('user-id');
            var userName = $(this).data('user-name');
            $.ajax({
                type: 'GET',
                url: "{{route('chat.screen')}}",
                data: {
                    user_id: userId,
                    user_name: userName,
                },
                dataType: 'json',
                success: function(response) {
                    $('.chatscreen').html(response.html);
                    scrollToBottom();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });


    });

    function scrollToBottom() {
        var chatBox = document.getElementById("messageContainer");
        chatBox.scrollTop = chatBox.scrollHeight;
    }
</script>

@endsection