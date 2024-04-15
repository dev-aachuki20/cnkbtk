
function showLoader(){

}

function hideLoader(){

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