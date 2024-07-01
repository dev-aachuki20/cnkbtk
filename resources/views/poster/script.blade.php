<script src="{{ asset('admins/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
<script>
$(document).ready(function(){
    const lightbox = GLightbox({
        touchNavigation: true,
        loop: true,
        width: "90vw",
        height: "90vh"
    })

    $("#reportPost").click(function(){
        @if(Auth::check())
            var posterId = $(this).attr("data-post-id");
            $.ajax({
                headers :{
                    'X-CSRF-TOKEN' : $("meta[name=csrf-token]").attr('content')
                },
                url : "{{route('report.create')}}",
                type: "post",
                data:{"posterId" : posterId},
                beforesend:function(){
                    showLoader()
                },
                success:function(response){
                    $("#reportModal").html(response);
                    $("#reportModal").modal("show");
                },
                error:function(response){
                    toastr.error(response.responseJSON.message,'{{trans("global.alert.error")}}');
                },
                complete:function(){
                    hideLoader();
                }
            }) 
            return;
        @endif

        toastr.info("{{trans('messages.logged_in_report')}}",'{{trans("global.alert.info")}}');
    });

    $("#followBtn").click(function(){
        $this = $(this);
        @if(Auth::check())
            var posterId = $(this).attr("data-post-id");
            var follwoStatus = $(this).attr("data-follow-status");
            $.ajax({
                headers :{
                    'X-CSRF-TOKEN' : $("meta[name=csrf-token]").attr('content')
                },
                url : "{{route('post.follow')}}",
                type: "post",
                data:{"posterId" : posterId,"follwoStatus" : follwoStatus},
                beforesend:function(){
                    showLoader()
                },
                success:function(response){
                    if(response.follow_status == 0){
                      
                        $this.text('{{trans("pages.poster.following")}}');
                        $this.attr('data-follow-status', "{{Crypt::encrypt('0')}}");
                        console.log("following");
                    }else{
                        $this.text('{{trans("pages.poster.follow")}}');
                        $this.attr('data-follow-status', "{{Crypt::encrypt('1')}}");
                        console.log("unfollow");
                    }
                    toastr.success(response.message,'{{trans("global.alert.success")}}');
                },
                error:function(response){
                    toastr.error(response.responseJSON.message,'{{trans("global.alert.error")}}');
                },
                complete:function(){
                    hideLoader();
                }
            }) 
            return;
        @endif

        toastr.info("{{trans('messages.logged_in_follow')}}",'{{trans("global.alert.info")}}');
    });

    $(document).on("click",".btn-close",function(){
        $("#reportModal").modal("hide");
    });

    $(document).on("click",".closePurchaseForm",function(){
        $("#purchaseModal").modal("hide");
    });

    $(document).on("submit","#reportForm",function(e){
        e.preventDefault();
        var formdata = new FormData (this);
        $.ajax({
            headers :{
                'X-CSRF-TOKEN' : $("meta[name=csrf-token]").attr('content')
            },
            url:"{{route('report.store')}}",
            method:'post',
            data : formdata,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function(response){
                $('.overlay').show();
            },
            success:function(response){
                Swal.fire({
                    title: '{{trans("global.alert.success")}}',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: '{{trans("global.okay")}}'
                    confirmButtonColor: '#ff6359',
                }).then((result) => {
                    location.reload();  
                })
            },
            error:function(jqXHR){
                if(jqXHR.status == 422){
                        $(".errors").remove();
                        $.each(jqXHR.responseJSON.errors,function(index,value){
                        $("#"+index).parents(".form-group").append("<span class='text-danger errors'>"+value+"</span>");
                    });
                }else{
                    $("#reportModal").modal("hide");
                    toastr.error(jqXHR.responseJSON.message, '{{trans("global.alert.error")}}');
                }
            },
            complete:function(){
                 $('.overlay').hide();
            }
        });
    });

    $(".buy_episode").click(function(){
        @if(Auth::check())
            var episodeId = $(this).attr("data-episodeid");
            $.ajax({
                headers :{
                    'X-CSRF-TOKEN' : $("meta[name=csrf-token]").attr('content')
                },
                url : "{{route('post.purchase.create')}}",
                type: "post",
                data:{"episodeId" : episodeId},
                beforesend:function(){
                    showLoader()
                },
                success:function(response){
                    $("#purchaseModal").html(response);
                    $("#purchaseModal").modal("show");
                },
                error:function(response){
                    toastr.error(response.responseJSON.message,'{{trans("global.alert.error")}}');
                },
                complete:function(){
                    hideLoader();
                }
            }) 
            return;
        @endif

        toastr.info("{{trans('messages.purchase.logged_in')}}",'{{trans("global.alert.info")}}');
        return;
    });

    $(document).on("submit","#purchaseForm",function(e){
        e.preventDefault();
        var formdata = new FormData (this);
        $.ajax({
            headers :{
                'X-CSRF-TOKEN' : $("meta[name=csrf-token]").attr('content')
            },
            url:"{{route('post.purchase.store')}}",
            method:'post',
            data : formdata,
            dataType:"json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function(response){
                $('.overlay').show();
            },
            success:function(response){
                $("#purchaseModal").modal("hide");
                if(response.alert_type == "info"){
                    toastr.info(response.message, '{{trans("global.alert.info")}}');
                    return ; 
                }
                
                Swal.fire({
                    title: '{{trans("global.alert.success")}}',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: '{{trans("global.okay")}}'
                }).then((result) => {
                    location.reload();  
                })
            },
            error:function(jqXHR){
                $(document).find("#purchaseModal").modal("hide");
                toastr.error(jqXHR.responseJSON.message, '{{trans("global.alert.error")}}');
            },
            complete:function(){
                $('.overlay').hide();
            }
        });
    });
});

</script>