@extends('layouts.app')
@section('content')
@php 
    $siteSettingData = getSiteSetting();
@endphp
  <!-- hero  -->
  <section class="privacy-hero">
    <div class="container">
      <div class="hero-banner">
        <div class="prc-title">
          <h2>{{trans("pages.selftopup.self_service")}} <span>{{trans("pages.selftopup.top_up")}}</span></h2>
        </div>
      </div>
    </div>
  </section>
  <!-- end  -->  

  <section class="breadcrumb-wrap">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans("global.home")}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">
              {{trans("pages.selftopup.self_service")}} {{trans("pages.selftopup.top_up")}}
          </li>
        </ol>
      </nav>
    </div>
  </section>

  <section class="payment-wrapper py-3 my-5">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-12">
          <form id="selftipup-form">
              @if($plan)
              <input name="plan_id" type="hidden" value="{{Crypt::encrypt($plan->id)}}">
             
              <div class="product-pay-details">
                <div class="product-inner d-flex">
                  <div class="product-box">
                    <div class="product-name">
                      <h3>
                          {{trans("pages.selftopup.product_name")}} : <span>{{$plan->title}}</span>
                      </h3>
                    </div>
                    {{-- <div class="product-number product-name">
                      <h3>
                        {{trans("global.order_number")}}: <span>{{$orderId}}</span>
                      </h3>
                    </div> --}}
                  </div>
                  <div class="order-box product-name">
                    <h3>
                        {{trans("pages.selftopup.points")}} : <span>{{$plan->points}}</span>
                    </h3>
                  </div>
                  <div class="order-box product-name">
                    <h3>
                        {{trans("pages.selftopup.order_amount")}} : <span>{{$plan->amount}}</span>
                    </h3>
                  </div>
                </div>
              </div>

              <div class="payment-box mt-4">
                <div class="payment-inner">
                  <div class="payment-title">
                    <h3>
                        {{trans("pages.selftopup.payment_method")}}
                    </h3>
                  </div>
                  <div class="payment-method mt-3">
                    <div class="method-box active">
                      <div class="title">
                          {{trans("global.paypal")}}
                      </div>
                      <div class="logo">
                        <img class="img-fluid" src="assest/images/Alipay-logo.png" alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="payment-button-box mt-4">
                <div class="pay-btn-inner">
                  <span>
                      {{trans("pages.selftopup.need_to_pay")}} : {{$plan->amount }} yuan
                  </span>
                  <button type="submit" class="btn  pay-btn">{{trans("pages.selftopup.pay_immediately")}}</a>
                </div>
              </div>
             @endif
          </form>

        </div>
      </div>
    </div>
  </section>

  @endsection

@section("scripts")
<script src="{{ asset('admins/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
  $(document).on("submit","#selftipup-form",function(e){
      e.preventDefault();
      var formdata = new FormData (this);
      $.ajax({
          headers :{
              'X-CSRF-TOKEN' : $("meta[name=csrf-token]").attr('content')
          },
          url:"{{route('user.self-top-up.submit')}}",
          method:'post',
          data : formdata,
          contentType: false,
          cache: false,
          processData: false,
          beforeSend:function(response){
              $('.overlay').show();
          },
          // success:function(response){
          //     Swal.fire({
          //         title: '{{trans("global.alert.success")}}',
          //         text: response.message,
          //         icon: 'success',
          //         confirmButtonText: '{{trans("global.okay")}}'
          //     }).then((result) => {
          //       window.location.replace(
          //         "{{route('user.profile',['tab' => 'information'])}}"
          //       );
          //     });
          // }, 
          success:function(response){
            if (response.approvalUrl) {
              window.location.replace(response.approvalUrl);
            } else {
              console.error('Error creating PayPal order');
            }
          },
          error:function(jqXHR){
              toastr.error(jqXHR.responseJSON.message, '{{trans("global.alert.error")}}');  
          },
          complete:function(){
              $('.overlay').hide();
          }
      });
  });
</script>
@endsection
