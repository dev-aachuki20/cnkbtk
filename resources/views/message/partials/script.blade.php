<script>
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
                setTimeout(() => {
                    location.reload();                    
                }, 1000);
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
            var timestamp = getCurrentTimestamp();

            var formattedMessage = message.replace(/\n/g, '<br>');

            var messageHtml = '<div class="message outgoing"><div class="message-content">' + formattedMessage + ' <span class="message_time">' + timestamp + '</span></div></div>';
            $('#messageContainer').append(messageHtml);
            $('#messageInput').val('');
            scrollToBottom();
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
                    // console.log('Message sent successfully');
                    scrollToBottom();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    }

    function getCurrentTimestamp() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        // Format timestamp as needed (e.g., HH:mm)
        var timestamp = hours.toString().padStart(2, '0') + ':' + minutes.toString().padStart(2, '0');
        return timestamp;
    }

    function scrollToBottom() {
        var chatContainer = $('.chatbodypart .message-container');
        chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
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
        refreshMessages(userId, userName, projectId);
    });


    
    // lazy loading start.
    $(document).ready(function() {
        var messageContainer = $('#messageContainer');
        var projectId = {{ $projectId }};
        var receiverId = {{ $receiverId }};
        var senderId = {{ $senderId }};

        var lastMessageId  = null;
        var isLoading = false;
        var hasMoreMessages = true;

        var initialScrollHeight = messageContainer.prop("scrollHeight");
        messageContainer.scrollTop(initialScrollHeight);

        // messageContainer.scrollTop(messageContainer[0].scrollHeight);
        
        messageContainer.on('scroll', function() {
            if (messageContainer.scrollTop() == 0) {
                var firstMessage = messageContainer.find('.message:first');
                lastMessageId = firstMessage.data('message-id');
                loadMoreMessages(lastMessageId );
            }
        });

        function loadMoreMessages(lastMessageId ) {
            isLoading = true;
            $.ajax({
                url: '{{ route("message.load-more") }}',
                method: 'GET',
                data: {
                    project_id: projectId,
                    receiver_id: receiverId,
                    sender_id: senderId,
                    last_message_id: lastMessageId
                },
                success: function(response) {
                    if (response && response.data && response.data.length > 0) {
                        var messagesHtml = '';
                        var data = response.data.reverse();
                        data.forEach(function(message) {
                            var messageClass = (message.sender_id == senderId) ? 'outgoing' : 'incoming';
                            messagesHtml += '<div class="message ' + messageClass + '" data-message-id="' + message.id + '" ><div class="message-content">' + message.content + '</div></div>';
                            });

                        messageContainer.prepend(messagesHtml);
                        var newScrollHeight = messageContainer.prop("scrollHeight");
                        var scrollDifference = newScrollHeight - initialScrollHeight;
                        messageContainer.scrollTop(scrollDifference);
                    } else {
                        hasMoreMessages = false;
                    }
                    isLoading = false;
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    isLoading = false;
                }
            });
        }
    });
    // lazy loading end













    // const messageInput = document.getElementById('messageInput');
    
    // // Add an event listener to the textarea for input events
    // messageInput.addEventListener('input', function(event) {
    // if (event.shiftKey && event.keyCode === 13) {
    //     messageInput.value += '\n';
    // }
    // adjustTextareaHeight();
    // });

    // // Add an event listener to the textarea for keydown events
    // messageInput.addEventListener('keydown', function(event) {
    //     if (event.keyCode === 13 && !event.shiftKey) {
    //         event.preventDefault(); 
    //         sendMessage(); 
    //     }
    // });
    // // Function to adjust the height of the textarea based on its content
    // function adjustTextareaHeight() {
    //     messageInput.style.height = 'auto';
    //     messageInput.style.height = Math.max(messageInput.scrollHeight, 20) + 'px';
    // }

</script>