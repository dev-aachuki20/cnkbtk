<div class="card chatcard h-100 overflow-hidden">
    <div class="row h-100 flex-column flex-nowrap overflow-hidden mx-0 gx-0">
        <div class="col-12">
            <div class="chat-header p-3 d-flex justify-content-between align-items-center">
                <div class="userporfile activeAccount">
                    @php
                    if(isset($user->uploads) && !empty($user->uploads) && count($user->uploads) > 0){
                    $imagePath = asset('storage/'. $user->uploads->first()->path );
                    } else {
                    $imagePath = asset('dummy-user.svg');
                    }
                    @endphp
                    <div class="userimage">
                        <img class="userpic" src="{{ $imagePath }}" alt="user image" height="30px" width="30px">
                    </div>
                    <div class="useraccount text-truncate">
                        <h4 class="m-0 text-truncate" id="chatHeader">{{$user->user_name ?? ''}}</h4>
                        <!-- <p class="text-truncate content m-0 activeuser">Active</p> -->
                    </div>
                </div>
                <div class="usersetting d-flex align-items-center gap-2">
                    <div class="{{$projectStatus == 1 ? 'confirmRequest' :''}}">
                        <button type="button" class="dropdown-item del_btn dash-btn red-bg rounded-3 px-3 py-2" id="lockProjectBtn" data-project-id="{{$projectId}}" data-creator-id="{{$user->id}}" {{$projectStatus == 1 ? 'disabled' : ''}}>{{__('Assign')}}</button>
                        {{-- <button type="button" class="dropdown-item del_btn dash-btn red-bg rounded-3 px-3 py-2 d-sm-none d-block" id="lockProjectBtn" data-project-id="{{$projectId}}" data-creator-id="{{$user->id}}" {{$projectStatus == 1 ? 'disabled' : ''}}>{{__('Assign')}}</button> --}}
                    </div>
                    {{-- <div class="dropdown drop-start d-sm-none d-block">
                        <button class="btn btn-secondary border-0 shadow-none editbtn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                            <svg class="editicon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 7C12.3956 7 12.7822 6.8827 13.1111 6.66294C13.44 6.44318 13.6964 6.13082 13.8478 5.76537C13.9991 5.39992 14.0387 4.99778 13.9616 4.60982C13.8844 4.22186 13.6939 3.86549 13.4142 3.58579C13.1345 3.30608 12.7781 3.1156 12.3902 3.03843C12.0022 2.96126 11.6001 3.00087 11.2346 3.15224C10.8692 3.30362 10.5568 3.55996 10.3371 3.88886C10.1173 4.21776 10 4.60444 10 5C10 5.53043 10.2107 6.03914 10.5858 6.41421C10.9609 6.78929 11.4696 7 12 7ZM12 17C11.6044 17 11.2178 17.1173 10.8889 17.3371C10.56 17.5568 10.3036 17.8692 10.1522 18.2346C10.0009 18.6001 9.96126 19.0022 10.0384 19.3902C10.1156 19.7781 10.3061 20.1345 10.5858 20.4142C10.8655 20.6939 11.2219 20.8844 11.6098 20.9616C11.9978 21.0387 12.3999 20.9991 12.7654 20.8478C13.1308 20.6964 13.4432 20.44 13.6629 20.1111C13.8827 19.7822 14 19.3956 14 19C14 18.4696 13.7893 17.9609 13.4142 17.5858C13.0391 17.2107 12.5304 17 12 17ZM12 10C11.6044 10 11.2178 10.1173 10.8889 10.3371C10.56 10.5568 10.3036 10.8692 10.1522 11.2346C10.0009 11.6001 9.96126 12.0022 10.0384 12.3902C10.1156 12.7781 10.3061 13.1345 10.5858 13.4142C10.8655 13.6939 11.2219 13.8844 11.6098 13.9616C11.9978 14.0387 12.3999 13.9991 12.7654 13.8478C13.1308 13.6964 13.4432 13.44 13.6629 13.1111C13.8827 12.7822 14 12.3956 14 12C14 11.4696 13.7893 10.9609 13.4142 10.5858C13.0391 10.2107 12.5304 10 12 10Z" fill="black" />
                            </svg>
                        </button>
                        <ul class="dropdown-menu border-0 p-0 rounded-3 overflow-hidden" aria-labelledby="dropdownMenuButton1" >
                            <!-- <li><button type="button" class="dropdown-item del_btn dash-btn red-bg rounded-3">{{__('cruds.global.delete')}}</button></li> -->

                    <li class="{{$projectStatus == 1 ? 'confirmRequest' :''}}"><button type="button" class="dropdown-item del_btn dash-btn red-bg rounded-3 px-3 py-2" id="lockProjectBtn" data-project-id="{{$projectId}}" data-creator-id="{{$user->id}}" {{$projectStatus == 1 ? 'disabled' : ''}}>{{__('Assign')}}</button></li>
                    </ul>
                </div> --}}
                <button class="btn close-btn d-md-none d-flex shadow-none border-0">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.4099 11.9999L19.7099 5.70994C19.8982 5.52164 20.004 5.26624 20.004 4.99994C20.004 4.73364 19.8982 4.47825 19.7099 4.28994C19.5216 4.10164 19.2662 3.99585 18.9999 3.99585C18.7336 3.99585 18.4782 4.10164 18.2899 4.28994L11.9999 10.5899L5.70994 4.28994C5.52164 4.10164 5.26624 3.99585 4.99994 3.99585C4.73364 3.99585 4.47824 4.10164 4.28994 4.28994C4.10164 4.47825 3.99585 4.73364 3.99585 4.99994C3.99585 5.26624 4.10164 5.52164 4.28994 5.70994L10.5899 11.9999L4.28994 18.2899C4.19621 18.3829 4.12182 18.4935 4.07105 18.6154C4.02028 18.7372 3.99414 18.8679 3.99414 18.9999C3.99414 19.132 4.02028 19.2627 4.07105 19.3845C4.12182 19.5064 4.19621 19.617 4.28994 19.7099C4.3829 19.8037 4.4935 19.8781 4.61536 19.9288C4.73722 19.9796 4.86793 20.0057 4.99994 20.0057C5.13195 20.0057 5.26266 19.9796 5.38452 19.9288C5.50638 19.8781 5.61698 19.8037 5.70994 19.7099L11.9999 13.4099L18.2899 19.7099C18.3829 19.8037 18.4935 19.8781 18.6154 19.9288C18.7372 19.9796 18.8679 20.0057 18.9999 20.0057C19.132 20.0057 19.2627 19.9796 19.3845 19.9288C19.5064 19.8781 19.617 19.8037 19.7099 19.7099C19.8037 19.617 19.8781 19.5064 19.9288 19.3845C19.9796 19.2627 20.0057 19.132 20.0057 18.9999C20.0057 18.8679 19.9796 18.7372 19.9288 18.6154C19.8781 18.4935 19.8037 18.3829 19.7099 18.2899L13.4099 11.9999Z" fill="black" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div class="col-12 h-100 flex-fill overflow-hidden messageBoxBg">
        <div class="h-100 chatbodypart ps-3">
        <div class="message-container pe-3 h-100 overflow-y-auto" id="messageContainer">
                @php
                $prevDate = null; // Initialize previous date variable
                @endphp
    
                @foreach($getChatData as $chat)
                @php
                $istTime = $chat->created_at->setTimezone('Asia/Kolkata');
                $formattedTime = $istTime->format('h:i A');
                $formattedDate = $istTime->format('d F Y');
                @endphp
    
                @if ($formattedDate !== $prevDate)
                <div class="datemention"><span>{{ $formattedDate }}</span></div>
                @php
                $prevDate = $formattedDate;
                @endphp
                @endif
    
                @if($chat->sender_id == Auth::user()->id)
                <div class="message outgoing">
                    <div class="message-content">{{ $chat->content }} <span class="message_time">{{ $formattedTime }}</span></div>
                </div>
                {{-- <div class="message outgoing multipal-message">
                    <div class="message-content">Hello i am admin <span class="message_time"><span class="pe-1">Creator</span> 12:29</span></div>
                    <div class="message-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, culpa.</div>
                    <div class="message-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, culpa.</div>
                </div> --}}
                @else
                <div class="message incoming">
                    <div class="message-content">{{ $chat->content }} <span class="message_time">{{ $formattedTime }}</span></div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-12">
        <!-- form start -->
        <form id="messageForm" data-sender-id="{{auth()->user()->id}}" data-receiver-id="{{$user->id}}">
            <div class="message-input p-3">
                <div class="row gx-2 align-items-center">
                    <div class="col">
                        <textarea name="content" id="messageInput" rows="1" class="form-control shadow-none" placeholder="Type your message..."  required></textarea>
                    </div>
                    <div class="col-auto d-flex">
                        <div class="d-flex gap-2">
                            <button id="sendMessageBtn" class="add_btn submitbtn dash-btn green-bg w-115 m-0 shadow-none">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_717_4)">
                                        <mask id="mask0_717_4" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="48" height="48">
                                            <path d="M48 0H0V48H48V0Z" fill="white" />
                                        </mask>
                                        <g mask="url(#mask0_717_4)">
                                            <path d="M6.16212 27.2536L20.1639 24.4531C21.4141 24.2033 21.4141 23.7968 20.1639 23.5471L6.16212 20.7466C5.32812 20.5801 4.51587 19.7671 4.34937 18.9338L1.54887 4.93209C1.29837 3.68109 2.03562 3.09984 3.19437 3.63459L45.9211 23.3543C46.6929 23.7106 46.6929 24.2896 45.9211 24.6458L3.19437 44.3656C2.03562 44.9003 1.29837 44.3191 1.54887 43.0681L4.34937 29.0663C4.51587 28.2331 5.32812 27.4201 6.16212 27.2536Z" fill="#fff" />
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_717_4">
                                            <rect width="48" height="48" fill="#fff" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- form end -->
    </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // JavaScript code to send a message
    $('#messageForm').submit(function(e) {
        e.preventDefault();
        sendMessage();
    });

    $('#messageInput').keypress(function(e) {
        if (e.which == 13) {
            e.preventDefault();
            sendMessage();
        }
    });

    function sendMessage() {
        var message = $('#messageInput').val().trim();
        var senderId = $('#messageForm').data('sender-id');
        var receiverId = $('#messageForm').data('receiver-id');

        if (message !== '') {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ route('message.send') }}",
                data: {
                    content: message,
                    sender_id: senderId,
                    receiver_id: receiverId,
                },
                dataType: 'json',
                success: function(response) {
                    $('#messageInput').val('');
                    $('#messageContainer').append('<div class="message outgoing"><div class="message-content">' + message + ' <span class="message_time"> </span></div></div>');
                    // setTimeout(function(){
                    //     scrollToBottom();
                    // },2000);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    }

    // function scrollToBottom() {
    //     alert('scrollToBottom');
    //     var container = $('#messageContainer');
    //     container.scrollTop(container.prop("scrollHeight"));
    // }

    // locked project by user.
    $('#lockProjectBtn').click(function() {
        var projectId = $(this).data('project-id');
        var creatorId = $(this).data('creator-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "{{ route('lock.project') }}",
            data: {
                projectId: projectId,
                creatorId: creatorId,
            },
            dataType: 'json',
            beforeSend: function(response) {
                    showLoader();
            },
            success: function(response) {
                // alert(response.message); // Show success message
                toastr.success(response.message, '{{trans("global.alert.success")}}');
                location.reload();
            },
            complete: function() {
                    hideLoader();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
</script>