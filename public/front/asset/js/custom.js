function showLoader(){
    $('.overlay').css("display","block");
}

function hideLoader(){
    $('.overlay').css("display","none");
}


$(document).ready(function(){
    function scrollToBottom() {
        var chatContainer = $('.messageBoxBg');
        chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
    }
    scrollToBottom();

    setTimeout(function() {
        scrollToBottom();
    }, 120);

    $(".dynamicUserList").click(function(){
        function scrollToBottom() {
            var chatContainer = $('.messageBoxBg');
            chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
        }
        scrollToBottom();
    
        setTimeout(function() {
            scrollToBottom();
        }, 120);
    
      });
    
});


