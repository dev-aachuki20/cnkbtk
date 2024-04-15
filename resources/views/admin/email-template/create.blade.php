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
            <h1>Add Email Template</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.email-templates.index')}}">Email Templates</a></li>
              <li class="breadcrumb-item active">Add Email Template</li>
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
          <div class="col-md-9">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add Email Template</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.email-templates.store') }}">
                @csrf
                @include('admin/email-template/_form')
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
        $('#emailBody').summernote({
            height: 200,
            focus: true
        })
    });
</script>

@endsection