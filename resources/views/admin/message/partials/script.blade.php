<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function refreshMessages(projectId) {
        var url = "{{ route('admin.projects.readChat', ':projectId') }}";
        url = url.replace(':projectId', projectId);
        var isAjax = true;
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                isAjax: isAjax
            },
            dataType: 'json',
            beforeSend: function(response) {
                showLoader();
            },
            success: function(response) {
                $('#messageBoxBg').html(response.html);
            },
            error: function(xhr, status, error) {
                console.error(error);
            },
            complete: function() {
                hideLoader();
            }
        });
    }

    // Event listener for refresh button click
    $('#refresh-messages').click(function() {
        var projectId = $(this).data('project-id');
        refreshMessages(projectId);
    });


    $(document).ready(function() {
        var messageContainer = $('#chatbody');
        var projectId = {{ $projectId }};
        var creatorId = {{ $creatorId }};
        var userId = {{ $userId }};

        var lastMessageId = null;
        var isLoading = false;
        var hasMoreMessages = true;

        var initialScrollHeight = messageContainer.prop("scrollHeight");
        messageContainer.scrollTop(initialScrollHeight);


        // messageContainer.scrollTop(messageContainer[0].scrollHeight);

        messageContainer.on('scroll', function() {
            if (messageContainer.scrollTop() == 0) {
                var firstMessage = messageContainer.find('.message:first');
                lastMessageId = firstMessage.data('message-id');
                loadMoreMessages(lastMessageId);
            }
        });

        function loadMoreMessages(lastMessageId) {
            console.log('lastMessageId', lastMessageId)
            isLoading = true;
            $.ajax({
                url: '{{ route('admin.message.load-more') }}',
                method: 'GET',
                data: {
                    project_id: projectId,
                    userId: userId,
                    creatorId: creatorId,
                    last_message_id: lastMessageId
                },
                success: function(response) {
                    console.log(response.data);
                    if (response && response.data && response.data.length > 0) {
                        var messagesHtml = '';
                        var data = response.data.reverse();
                        console.log(data);
                        data.forEach(function(message) {
                            var messageClass = (message.sender_id == userId) ?
                                'outgoing' : 'incoming';
                            messagesHtml += '<div class="message ' + messageClass +
                                '" data-message-id="' + message.id +
                                '" ><div class="message-content">' + message.content +
                                '</div></div>';
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
</script>
