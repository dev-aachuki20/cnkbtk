@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('admins/plugins/summernote/summernote-bs4.min.css') }}">

@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{trans("cruds.global.edit")}} {{trans("cruds.pages.title_singular")}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
              <li class="breadcrumb-item">{{trans("cruds.pages.title")}}</li>
              <li class="breadcrumb-item">{{$title == 'privacy-policy' ? trans("cruds.pages.sub_pages.privacy_policy") : trans("cruds.pages.sub_pages.terms_condition")  }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{trans("cruds.global.edit")}}  {{$title == 'privacy-policy' ? trans("cruds.pages.sub_pages.privacy_policy") : trans("cruds.pages.sub_pages.terms_condition")}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.pages.update', $title) }}">
                @csrf
                @method('POST')
                 @include('admin/page/_form')
              </form>
            </div>
          </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('scripts')
<script src="{{asset('admins/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $(document).ready(function () {
      $('#contentEn, #contentCh').summernote({
          height: 200,
          focus: true
      })

      // $(".Copy").click(function(event){
      //   var $tempElement = $("<input>");
      //   $("body").append($tempElement);
      //   $tempElement.val($(this).closest('th').text()).select();
      //   document.execCommand("Copy");
      //   $tempElement.remove();
      //   toastr.info("Code Copied Successfully", 'Info!');
      // });
    });
</script>

@endsection