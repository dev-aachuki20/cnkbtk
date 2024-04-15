<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php 
    $siteSettingData = getSiteSetting();
    @endphp
    <title>{{ $siteSettingData['site_title'] }}</title>
    <meta name="description" content="CNBTK">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="">
    <link rel="shortcut icon" href="">
    <!-- Boot strap Start  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- End Boot strap Start  -->
    <!-- font-awesome Start  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <!-- End font-awesome Start  -->
    <!-- slick-carousel  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- End slick-carousel  -->
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"  integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="  crossorigin="anonymous"  referrerpolicy="no-referrer"/>

    
    <!-- Custom Css Start  -->
    <link rel="stylesheet" href="{{ asset('front/asset/css/style.css')}}">
    <!-- End Custom Css Start  -->
    <!-- Responsive Css Start  -->
    <link rel="stylesheet" href="{{ asset('front/asset/css/responsive.css')}}">
    <!-- End Responsive Css Start  -->

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('admins/plugins/toastr/toastr.min.css') }}">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    @yield('styles')
    
</head>
<body>
    <div class="overlay" style=" background: #000000ad;z-index: 9999999999999999999;display: block;position: fixed;width: 100%;height: 100%;top: 0;left: 0;display:none;">
      <img src="http://developmentrealestate.hipl-staging2.com/front/assets/images/loader.gif" alt="Logo" width="140"> 
      <i class="fas fa-2x fa fa-refresh fa-spin" style="position: absolute;top: 50%;left: 50%;color: white;font-size: 80px;"></i>
    </div>
    @php $siteSettingData = getSiteSetting(); @endphp
    @include('layouts.front.header')
    @yield('content')

    <!-- back drop  -->
    <div class="back-to-top">
      <a href="" id="topup" class="back-to-top-box">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-up" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M12 5l0 14" />
          <path d="M16 9l-4 -4" />
          <path d="M8 9l4 -4" />
        </svg>
      </a>
    </div>
    <!-- end back-drop  -->
    @include('layouts.front.footer')
    <!-- Start Bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- End Bootstrap Js -->
    <!-- Start Jquery Js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- End Jquery Js -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <!-- slick-carousel  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- End slick-carousel  -->
    <script src="https://unpkg.com/stimulus/dist/stimulus.umd.js"></script>
    <script src="{{ asset('admins/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('front/asset/js/custom.js') }}"></script>
    <!--<script src="https://hipl-staging2.com/chat/chat-plugin/main.js"></script>-->
   
    @include('scripts.app')
    @yield("scripts")
</body>
</html>
