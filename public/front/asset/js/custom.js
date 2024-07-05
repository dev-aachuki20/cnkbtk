function showLoader() {
  $('.overlay').css("display", "block");
}

function hideLoader() {
  $('.overlay').css("display", "none");
}

document.addEventListener('DOMContentLoaded', function () {
  var currentUserId = $('#messageForm').data('sender-id');
//   console.log('currentUserId ', currentUserId);
  Echo.channel('chat')
    .listen('Message', (e) => {
      console.log(e.message);
      // $('#messageInput').val('');
    
      if (e.senderId != currentUserId) {
          var timestamp = getCurrentTimestamp();
          var formattedMessage = e.message.replace(/\n/g, '<br>');
          var messageHtml = '<div class="message incoming"><div class="message-content">' + formattedMessage + ' <span class="message_time">' + timestamp + '</span></div></div>';
            $('#messageContainer').append(messageHtml);
          $('#messageInput').val('');
          scrollToBottomFun();

        // $('#messageContainer').append('<div class="message incoming"><div class="message-content">' + e.message + ' <span class="message_time"> </span></div></div>');
      }
    });
});

function getCurrentTimestamp() {
  var now = new Date();
  var hours = now.getHours();
  var minutes = now.getMinutes();
  // Format timestamp as needed (e.g., HH:mm)
  var timestamp = hours.toString().padStart(2, '0') + ':' + minutes.toString().padStart(2, '0');
  return timestamp;
}

function scrollToBottomFun() {
  var chatContainer = $('.chatbodypart .message-container');
  chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
}



$(document).ready(function () {
  function scrollToBottom() {
    var chatContainer = $('.messageBoxBg');
    chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
  }
  scrollToBottom();

  setTimeout(function () {
    scrollToBottom();
  }, 120);

  $(".dynamicUserList").click(function () {
    function scrollToBottom() {
      var chatContainer = $('.messageBoxBg');
      chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
    }
    scrollToBottom();

    setTimeout(function () {
      scrollToBottom();
    }, 120);

  });


  function scrollToBottom() {
    var chatContainer = $('.chatbodypart .message-container');
    chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
  }
  scrollToBottom();

  setTimeout(function () {
    scrollToBottom();
  }, 120);

  $(".dynamicUserList").click(function () {
    function scrollToBottom() {
      var chatContainer = $('.chatbodypart .message-container');
      chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
    }
    scrollToBottom();

    setTimeout(function () {
      scrollToBottom();
    }, 120);

  });

  $("#refresh-messages").click(function () {
    function scrollToBottom() {
      var chatContainer = $('.chatbodypart .message-container');
      chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
    }
    scrollToBottom();
    setTimeout(scrollToBottom, 120);
  });


});






















// $(document).ready(function () {
//   function scrollToBottom() {
//     var chatContainer = $('.messageBoxBg');
//     chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
//   }
//   scrollToBottom();


//   setTimeout(function () {
//     scrollToBottom();
//   }, 120);

//   $(".dynamicUserList").click(function () {
//     function scrollToBottom() {
//       var chatContainer = $('.messageBoxBg');
//       chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
//     }
//     scrollToBottom();

//     setTimeout(function () {
//       scrollToBottom();
//     }, 120);

//   });


//   function scrollToBottom() {
//     var chatContainer = $('.chatbodypart .message-container');
//     chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
//   }
//   scrollToBottom();

//   setTimeout(function () {
//     scrollToBottom();
//   }, 120);

//   $(".dynamicUserList").click(function () {
//     function scrollToBottom() {
//       var chatContainer = $('.chatbodypart .message-container');
//       chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
//     }
//     scrollToBottom();

//     setTimeout(function () {
//       scrollToBottom();
//     }, 120);

//   });

//   $("#refresh-messages").click(function () {
//     function scrollToBottom() {
//       var chatContainer = $('.chatbodypart .message-container');
//       chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
//     }
//     scrollToBottom();
//     setTimeout(scrollToBottom, 120);
//   });


// });


