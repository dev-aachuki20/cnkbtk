{{-- form with msg start --}}
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
            <div class="message outgoing" data-message-id="{{ $chat->id }}">
                <div class="message-content">{{ $chat->content }} <span class="message_time">{{ $formattedTime }}</span></div>
            </div>
            {{-- <div class="message outgoing multipal-message">
                <div class="message-content">Hello i am admin <span class="message_time"><span class="pe-1">Creator</span> 12:29</span></div>
                <div class="message-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, culpa.</div>
                <div class="message-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, culpa.</div>
            </div> --}}
            @else
            <div class="message incoming" data-message-id="{{ $chat->id }}">
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
{{-- form with msg end --}}