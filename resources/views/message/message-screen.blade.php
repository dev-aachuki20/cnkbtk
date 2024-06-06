<div class="card chatcard h-100 overflow-hidden animate__animated animate__fadeInUp">
    <div class="row h-100 flex-column flex-nowrap overflow-hidden mx-0 gx-0">
        <div class="col-12">
            <div class="chat-header p-3 d-flex justify-content-between align-items-center">
                @php
                    if(isset($user->uploads) && !empty($user->uploads) && count($user->uploads) > 0){
                    $imagePath = asset('storage/'. $user->uploads->first()->path );
                    } else {
                    $imagePath = asset('dummy-user.svg');
                    }
                @endphp
                <div class="userporfile activeAccount">                    
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
        @include('message.form')
    </div>
</div>


<script>   
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