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
                    </div>
                     
                </div>
                <div class="usersetting d-flex align-items-center gap-2">
                    <button id="refresh-messages" class="btn btn-primary" data-user-name="{{$user->user_name}}" data-user-id="{{$user->id}}" data-project-id="{{$projectId}}">
                        <i class="fa fa-refresh"></i>
                    </button>
                    @if($projectStatus != 1)
                        <div class="{{$projectStatus == 1 ? 'confirmRequest' :''}}">
                            <button type="button" class="dropdown-item del_btn dash-btn red-bg rounded-3 px-3 py-2" id="lockProjectBtn" data-project-id="{{$projectId}}" data-creator-id="{{$user->id}}" {{$projectAssginStatus == 1 ? 'disabled' : ''}}>{{ $buttonText }}</button>
                        </div> 
                    @endif

                <button id="closeUserScreen" class="btn close-btn d-md-none d-flex shadow-none border-0">
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
                $prevDate = null;
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
        <form id="messageForm" data-sender-id="{{auth()->user()->id}}" data-receiver-id="{{$user->id}}" data-project-id="{{$projectId}}">
            <div class="message-input p-3">
                <div class="row gx-2 align-items-center">
                    <div class="col">
                        <div class="typemessage" id="textareaheight">
                            <textarea name="content" id="messageInput" rows="1" class="form-control shadow-none" placeholder="Type your message..."  required></textarea>
                        </div>
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
    $(document).on('click', '.dynamicUserList', function(){
        $('.chatscreen').show();
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
    // const messageInput = document.getElementById('messageInput');
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