<div class="messageBoxBg">
<div class="message-container pl-3 py-3 h-100" id="messageContainer">
<div class="chatbody overflow-y-auto pr-3 h-100" id="chatbody">
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
        
    <div class="date-message">
        @if($chat->sender_id == $user->id)
        <div class="message outgoing" data-message-id="{{ $chat->id }}">
            <div class="message-content">
                {!! nl2br(e($chat->content)) !!}
                <span class="message_time"><span class="pe-1">{{-- User --}}</span> {{ $chat->created_at->format('H:i') }}</span>
            </div>
        </div>
        @else
        <div class="message incoming">
            <div class="message-content" data-message-id="{{ $chat->id }}">
                {!! nl2br(e($chat->content)) !!}
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
                           