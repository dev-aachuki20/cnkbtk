<script>

// Global Notification Toaster
    $(document).ready(function(){
        toastr.options = {
          'closeButton': true,
          'debug': false,
          'newestOnTop': false,
          'progressBar': false,
          'positionClass': 'toast-top-right',
          'preventDuplicates': false,
          'showDuration': '1000',
          'hideDuration': '1000',
          'timeOut': '5000',
          'extendedTimeOut': '1000',
          'showEasing': 'swing',
          'hideEasing': 'linear',
          'showMethod': 'fadeIn',
          'hideMethod': 'fadeOut',
        }

        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', trans('global.alert.info')) }}";
        
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('message') }}", '{{trans("global.alert.info")}}');
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}", '{{trans("global.alert.warning")}}');
                break;
            case 'success':
                toastr.success("{{ Session::get('message') }}", '{{trans("global.alert.success")}}');
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}", '{{trans("global.alert.error")}}');
                break;
        }
        @endif

        $('#searchBar').on("keyup",function(){
            var search_query = $(this).val();
            if(search_query != ''){
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN' : $('meta[name=csrf-token]').attr('content')
                    },
                    url:"{{route('search')}}",
                    type:"get",
                    data:{search_query:search_query},
                    dataType:'json',
                    success:function(response){
                      $(document).find("#serachResult").remove();
                      $("#searchForm").append(response.view);
                    },
                    error: function(response) {
                        toastr.error(response.message,trans("global.alert.error"));
                    }
                })
            }else{
              $(document).find("#serachResult").remove();
            }
        });
    });


    // back-top

    var btn = $("#topup");

    $(window).scroll(function () {
      if ($(window).scrollTop() > 300) {
        btn.addClass("show");
      } else {
        btn.removeClass("show");
      }
    });

    btn.on("click", function (e) {
      e.preventDefault();
      $("html, body").animate({ scrollTop: 0 }, "300");
    });


    $(".self-top-up, .site-statistics").click(function(e){
      e.preventDefault();
      @if(!auth()->check())
        toastr.info("{{ Session::get('message') }}", '{{trans("Please Login to access this page.")}}');
      @else
       window.location = $(this).attr('href');
      @endif
    })  
    
</script>