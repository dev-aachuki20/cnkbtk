@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="{{ asset('admins/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
@php 
    $siteSettingData = getSiteSetting();
    $notificationImage = $advertisements->where("advertisement_type","notification_image")->first();
    $popouImage = asset('front/asset/images/no_image.png');
    $image = app()->getLocale() == "en"  ?  "image_en" : "image_ch";
    if(!empty($notificationImage->{$image}) && Storage::disk('public')->exists($notificationImage->{$image})){                    
        $popouImage = asset('storage/'.$notificationImage->{$image});
    } 
@endphp
  @include("home.hero")
  @include("home.stats")
  @include("home.sections")
  @include("home.contact")
  @if($popouImage &&  !session()->has('modal'))
    @include("home.notification_pop_up")
  @endif
@endsection

@section('scripts')
<script src="{{ asset('admins/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $(".your-class").slick({
        slidesToShow: 1,
        margin: 10,
        infinite: false,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
          {
            breakpoint: 1199,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              infinite: true,
              margin: 1,
            },
          },
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
        ],
    });
 
  
    @if(!session()->has('modal') && !empty($popouImage))
      $(window).on("load",function(){
        $('#modal-subscribe').modal('show');
      });
      {{ session()->put('modal','shown') }}
      {{session()->save()}}
      $(".btn-close").click(function(){
          $("#modal-subscribe").modal("hide");
      });
    @endif



    $('#queryForm').on("submit",function(e){
        e.preventDefault();
        var formdata = new FormData (this);

        $.ajax({
            headers :{
                'X-CSRF-TOKEN' : $("meta[name=csrf-token]").attr('content')
            },
            url:"{{route('submit-query')}}",
            method:'post',
            data : formdata,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function(response){
                $('.overlay').show();
            },
            success:function(response){
              $("#queryForm").trigger("reset");
              Swal.fire({
                title: '{{trans("global.alert.success")}}',
                text: response.message,
                icon: 'success',
                confirmButtonText: '{{trans("global.okay")}}'
              }).then((result) => {
                  if (result.isConfirmed) {
                      // Clear the error message
                      $(".errors").text('');
                  }
              });
            },
            error:function(jqXHR,exception){
                
                if(jqXHR.status == 422){
                    $(".errors").remove();
                    $.each(jqXHR.responseJSON.errors,function(index,value){
                        if(index.indexOf(".") != -1){
                            index = index.replace(".", '');
                        }
                        $("#"+index).parents(".formbold-mb-5").append("<span class='text-danger errors'>"+value+"</span>");
                        
                    });
                }else{
                    toastr.error(jqXHR.responseJSON.message, '{{trans("global.alert.error")}}');
                }
            },
            complete:function(){
              $('.overlay').hide();
            }
        });
        
      });
  });
</script>

@endsection

