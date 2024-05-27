<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
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