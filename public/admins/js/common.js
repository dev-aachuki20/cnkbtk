function showLoader(){
    $('.overlay').css("display","block");
}

function hideLoader(){
    $('.overlay').css("display","none");
}


async function getSubparentSections(url){
    $.ajax({
        url: url,
        type:"get",
        beforeSend:function(){
            showLoader();
        },
        success:function(response){
            $("#subparentError").text('');
            $("select[name=sub_parent_id]").html(response.message);
        },
        error:function(jqXHR){
            $("#subparentError").text(jqXHR.responseJSON.message);
            $("select[name=sub_parent_id]").html('');
        },
        complete:function(){
            hideLoader();
        }
        
    })
}   

$(document).ready(function(){
    function scrollToBottom() {
        var chatContainer = $('#messageContainer .chatbody ');
        chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
    }
    scrollToBottom();

    setTimeout(function() {
        scrollToBottom();
    }, 120);

    $(".dynamicUserList").click(function(){
        function scrollToBottom() {
            var chatContainer = $('#messageContainer .chatbody ');
            chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
        }
        scrollToBottom();
    
        setTimeout(function() {
            scrollToBottom();
        }, 120);
    
      });
});
