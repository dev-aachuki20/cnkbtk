<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="English">
        <title>CNKBTK</title>
         <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('admins/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('admins/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('admins/plugins/select2/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{ asset('admins/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
        
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('admins/dist/css/adminlte.min.css')}}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('admins/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
       
      
        <link rel="stylesheet" href="{{ asset('admins/plugins/toastr/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admins/plugins/sweetalert2/sweetalert2.min.css') }}">

        <!-- Datatable -->
        <link rel="stylesheet" href="{{ asset('admins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admins/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
        
        <link rel="stylesheet" href="{{ asset('admins/css/custom.css')}}">
        
        {{-- <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" /> --}}
        
        @yield('styles')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed deepskyblue">
    <div class="overlay" style="background: #000000ad;z-index: 9999999999999999999;display: none;position: fixed;width: 100%;height: 100%;top: 0;left: 0;">
      <img src="http://developmentrealestate.hipl-staging2.com/front/assets/images/loader.gif" alt="Logo" width="140"> 
      <i class="fas fa-2x fa-sync-alt fa-spin" style="position: absolute;top: 50%;left: 50%;color: white;font-size: 80px;"></i>
    </div>
        <div class="wrapper">

            <!-- Preloader -->
            {{-- <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="{{ asset('admins/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
            </div> --}}
            @include('layouts.admin.header')
            @include('layouts.admin.sidebar')
            @yield('content')
            @include('layouts.admin.footer')
        </div>

        <script src="{{ asset('admins/plugins/jquery/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('admins/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('admins/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admins/plugins/select2/js/select2.full.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('admins/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('admins/dist/js/adminlte.js') }}"></script>
        <script src="{{ asset('admins/plugins/toastr/toastr.min.js') }}"></script>
        <script src="{{ asset('admins/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
        <!-- Datatables -->
        <script src="{{ asset('admins/plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('admins/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('admins/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{ asset('admins/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('admins/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{ asset('admins/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('admins/plugins/jszip/jszip.min.js')}}"></script>
        <script src="{{ asset('admins/plugins/pdfmake/pdfmake.min.js')}}"></script>
        <script src="{{ asset('admins/plugins/pdfmake/vfs_fonts.js')}}"></script>
        <script src="{{ asset('admins/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{ asset('admins/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{ asset('admins/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
        <script src="{{ asset('admins/js/common.js')}}"></script>
        <!-- End Datatables -->
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script> --}}

        <script type="text/javascript">
            toastr.options = {
                'closeButton': true,
                'debug': false,
                'newestOnTop': false,
                'progressBar': false,
                'positionClass': 'toast-top-right',
                'preventDuplicates': false,
                'showDuration': '10000',
                'hideDuration': '1000',
                'timeOut': '5000',
                'extendedTimeOut': '10000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut',
            }

            @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
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

            function fireSuccessSwal(title,message){
                Swal.fire({
                    title: title, 
                    text: message, 
                    type: "success",
                    icon: "success",
                    confirmButtonText: "{{trans('global.okay')}}",
                    confirmButtonColor: "#04a9f5"
                });
            }

            function fireWarningSwal(title,message){
            Swal.fire({
                    title: title, 
                    text: message, 
                    type: "warning",
                    icon: "warning",
                    confirmButtonText: "{{trans('global.okay')}}",
                    confirmButtonColor: "#04a9f5"
                });
            }

            function fireErrorSwal(title,message){
                Swal.fire({
                    title: title, 
                    text: message, 
                    type: "error",
                    icon: "error",
                    confirmButtonText: "{{trans('global.okay')}}",
                    confirmButtonColor: "#04a9f5"
                });
            }

            function fireConfirmSwal(title,message){
                Swal.fire({
                    title: title,
                    text: message,
                    icon: "warning",
                    showDenyButton: true,  
                    showCancelButton: true,  
                    confirmButtonText: `Yes, I am sure`,  
                    denyButtonText: `'No, cancel it!`,
                })
            }
            
        </script>
        @yield('scripts')
    </body>
</html>
