<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

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


    $(document).on('click', '.dynamicUserList', function(){
        $('.chatscreen').show();
    });

    // Searching users
    $('#searchInput').on('input', function() {
        var searchQuery = $(this).val().trim().toLowerCase();
        var found = false;
        $('.sidebar .userporfile').each(function() {
            var username = $(this).find('.content').text().trim().toLowerCase();
            if (username.includes(searchQuery)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        $('.welcome-screen').show();
    });

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

    // cross chat in mobile view
    $(document).on('click', '#closeUserScreen', function(){
        $('.chatscreen').hide();
        $('.sidebarclass').show();
    });

    // cross chat in mobile view
    $(document).on('click', '#closeCreatorScreen', function(){
        $('.chatscreen').hide();
        window.location.href = "{{route('user.project.request')}}";
    });

    $('#messageForm').submit(function(e) {
        e.preventDefault();
        sendMessage();
    });

    function sendMessage() {
        var message = $('#messageInput').val().trim();
        var senderId = $('#messageForm').data('sender-id');
        var receiverId = $('#messageForm').data('receiver-id');
        var projectId = $('#messageForm').data('project-id');
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
                    project_id: projectId,
                },
                dataType: 'json',
                success: function(response) {
                    $('#messageInput').val('');
                    $('#messageContainer').append('<div class="message outgoing"><div class="message-content">' + message + ' <span class="message_time"> </span></div></div>');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    }

    function refreshMessages(userId, userName, projectId){
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
            beforeSend: function(response) {   
                showLoader();
            },
            success: function(response) {
                $('#messageContainer').empty();
                $('.chatscreen').html(response.html);
            },
            error: function(xhr, status, error) {
                console.error(error);
            },
            complete: function() {   
                hideLoader();
            }
        });
    }

    $('#refresh-messages').click(function() {
        var userId = $(this).data('user-id');
        var userName = $(this).data('user-name');
        var projectId = $(this).data('project-id');
        console.log('result',userId, userName, projectId)
        refreshMessages(userId, userName, projectId);
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