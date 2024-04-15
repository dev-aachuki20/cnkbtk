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
            <h1>{{trans("cruds.global.edit")}} {{trans("cruds.email_template.title_singular")}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.email-templates.index')}}">{{trans("cruds.email_template.title")}}</a></li>
              <li class="breadcrumb-item active">{{trans("cruds.global.edit")}} {{trans("cruds.email_template.title_singular")}}</li>
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
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{trans("cruds.global.edit")}} {{trans("cruds.email_template.title_singular")}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.email-templates.update',$emailTemp->id) }}">
                @csrf
                @method('PATCH')
                 @include('admin/email-template/_form')
              </form>
            </div>
          </div>
          @if(!empty($emailTemp->short_codes))
          <div class="col-4">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">{{trans("cruds.global.short_code")}} {{trans("cruds.global.details")}}</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <th>{{trans("cruds.global.short_code")}}</th>
                    <th>{{trans("cruds.global.description")}}</th>
                    <tbody>
                      @php
                        $short_codes = json_decode($emailTemp->short_codes);
                        
                      @endphp
                      @forelse($short_codes as $shortcode => $key)
                      <tr>
                        <th style="width:50%" class="copy-content">@php echo "{{". $shortcode ."}}"  @endphp <span class="float-right fas fa-copy ml-2 Copy" title="{{trans("cruds.global.copy")}}"></span></th>
                        <td>{{ $key }}</td>
                      </tr>
                      @empty
                          <tr>
                              <td colspan="100%" class="text-muted text-center">{{trans("cruds.global.no")}} {{trans("cruds.global.short_code")}}</td>
                          </tr>
                      @endforelse
                    
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          @endif
          
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
      $('#emailBody').summernote({
          height: 200,
          focus: true
      })

      $(".Copy").click(function(event){
        var $tempElement = $("<input>");
        $("body").append($tempElement);
        $tempElement.val($(this).closest('th').text()).select();
        document.execCommand("Copy");
        $tempElement.remove();
        toastr.info("Code Copied Successfully", 'Info!');
      });
    });
</script>

@endsection