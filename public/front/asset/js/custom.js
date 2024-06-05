function showLoader() {
  $('.overlay').css("display", "block");
}

function hideLoader() {
  $('.overlay').css("display", "none");
}

document.addEventListener('DOMContentLoaded', function () {
  var currentUserId = $('#messageForm').data('sender-id');
  console.log('currentUserId ' ,currentUserId);
  Echo.channel('chat')
      .listen('Message', (e) => {
          console.log('listening event', e);
          $('#messageInput').val('');
          console.log(e.senderId, currentUserId)
          console.log(e.senderId != currentUserId)
          if (e.senderId != currentUserId) {
              $('#messageContainer').append('<div class="message incoming"><div class="message-content">' + e.message + ' <span class="message_time"> </span></div></div>');
          }
      });
});

// End chat script


$(document).ready(function() {
  function scrollToBottom() {
    var chatContainer = $('.messageBoxBg, .chatbodypart .message-container');
    chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
  }

  scrollToBottom();
  setTimeout(scrollToBottom, 120);

  $(".dynamicUserList, #refresh-messages").click(scrollToBottom);
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


