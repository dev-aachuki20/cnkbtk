function showLoader(){
    $('.overlay').css("display","block");
}

function hideLoader(){
    $('.overlay').css("display","none");
}


$(document).ready(function() {
    function scrollToBottom() {
      var chatContainer = $('.messageBoxBg, .chatbodypart .message-container');
      chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
    }
  
    scrollToBottom();
    setTimeout(scrollToBottom, 120);
  
    $(".dynamicUserList, #refresh-messages").click(scrollToBottom);
  });
  


