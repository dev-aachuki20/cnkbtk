@extends('layouts.admin')
@section('content')
<div class="content-wrapper faq-wrap">

    <section class="single-wrapper">
        <div class="px-0 chatboxGroup open" id="chatboxGroup">
            <div class="row h-100 gx-3">

                <!-- right panel start -->
                <div class="col-12 chat-panel h-100 chatscreen">
                    <div class="card chatcard h-100 overflow-hidden">
                        <div class="row h-100 flex-column flex-nowrap overflow-hidden">
                            <div class="col-12 auto-flex">
                                <div class="authorname chat-header">
                                    <div class="row mx-0 gap-3">
                                        <div class="col-auto px-0">
                                            <h6 class="m-0"><span>User ({{$user->user_name ?? ''}})</span></h6>
                                        </div>
                                        <div class="col-auto px-0">
                                            <h6 class="m-0"><span class="outgoing">Creator ({{$creator->user_name ?? ''}})</span></h6>
                                        </div>

                                        <a href="{{route('admin.projects.readChat', $projectId)}}" id="refresh-messages" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                                        </a>
                                        <!--<a id="refresh-msg" class="btn btn-primary" data-project-id="{{$projectId}}">-->
                                        <!--    Refresh-->
                                        <!--</a>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 h-100 flex-fill overflow-hidden">
                                <div class="messageBoxBg">
                                    <div class="message-container pl-3 py-3 h-100" id="messageContainer">
                                        <div class="chatbody overflow-y-auto pr-3 h-100">
                                                @php
                                                    $previousDate = null;
                                                    $previousTime = null;
                                                @endphp
                                            @foreach($getChatData as $chat)
                                                @php
                                                    $currentDate = $chat->created_at->format('d M Y');
                                                    $currentTime = $chat->created_at->format('H:i');
                                                @endphp
                                                @if ($currentDate != $previousDate)
                                                    <div class="date-message">
                                                        <div class="datemention"><span>{{ $currentDate }}</span></div>
                                                    </div>
                                                    @php
                                                        $previousDate = $currentDate;
                                                        $previousTime = null; 
                                                    @endphp
                                                @endif

                                                {{-- @if ($currentTime != $previousTime)
                                                    <div class="message-time-header">
                                                        <span>{{ $currentTime }}</span>
                                                    </div>
                                                @endif --}}

                                                
                                            <div class="date-message">
                                                @if($chat->sender_id == $user->id)
                                                <div class="message outgoing">
                                                    <div class="message-content">
                                                        {{ $chat->content }}
                                                        <span class="message_time"><span class="pe-1">{{-- User --}}</span> {{ $chat->created_at->format('H:i') }}</span>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="message incoming">
                                                    <div class="message-content">
                                                        {{ $chat->content }}
                                                        <span class="message_time"><span class="pe-1">{{-- Creator --}}</span> {{ $chat->created_at->format('H:i') }}</span>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            @endforeach



                                            {{-- <div class="date-message">
                                                <div class="datemention"><span>13 May 2024</span></div>
                                                <div class="message incoming">
                                                    <div class="message-content">Lorem ipsum dolor sit.<span class="message_time"><span class="pe-1">Admin</span> 12:29</span></div>
                                                </div>
                                            </div>
                                            <div class="date-message">
                                                <div class="message outgoing multipal-message">
                                                    <div class="message-content">Hello i am admin <span class="message_time"><span class="pe-1">Creator</span> 12:29</span></div>
                                                    <div class="message-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, culpa.</div>
                                                    <div class="message-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, culpa.</div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- right panel end -->
            </div>
        </div>
    </section>



    @endsection
    
<!--@section('scripts')-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<!--<script>-->
<!--    function refreshMessages(projectId){-->
<!--        var url = " url('admin/projects/read-chat/' + projectId) ";-->
<!--        var url = " route('admin.projects.readChat', projectId) "-->
<!--        $.ajax({-->
<!--            type: 'GET',-->
<!--            url: url,-->
<!--            dataType: 'json',-->
<!--            beforeSend: function(response) {   -->
<!--                showLoader();-->
<!--            },-->
<!--            success: function(response) {-->
<!--                $('#messageContainer').empty();-->
<!--                $('.chatscreen').html(response.html);-->
<!--            },-->
<!--            error: function(xhr, status, error) {-->
<!--                console.error(error);-->
<!--            },-->
<!--            complete: function() {   -->
<!--                hideLoader();-->
<!--            }-->
<!--        });-->
<!--    }-->

    // Event listener for refresh button click
<!--    $('#refresh-msg').click(function() {-->
<!--        var projectId = $(this).data('project-id');-->
<!--        refreshMessages(projectId);-->
<!--    });-->
<!--</script>-->
<!--@endsection-->