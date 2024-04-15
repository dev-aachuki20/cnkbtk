@extends('admin.layouts.master')
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
            @php
              $pageTitle = config()->get('constants.pages.'.$slug);
            @endphp
            <h1>{{$pageTitle}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
              <li class="breadcrumb-item">Pages</li>
              <li class="breadcrumb-item active">{{$pageTitle}}</li>
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
                <h3 class="card-title">{{$pageTitle}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <form method="POST" action="{{ route('admin.page.store') }}">
                    @csrf
               
                    <div class="card-body">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label>Title</label>
                            <input type="text" name="title" value="{{ old('title', isset($pageData) ? $pageData->title : '') }}" class="form-control"  placeholder="Enter Title">
                            {{-- @if ($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            @endif --}}
                        </div>    
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label>Description</label>
                            <textarea id="description" name="description">
                                    {{ isset($pageData) ? $pageData->description : '' }}    
                            </textarea>
                            {{-- @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif --}}
                            <input type="hidden" value={{$slug}} name="slug">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{isset($pageData) ? 'Update' : 'Save'}}</button>
                    </div>
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
        $('#description').summernote({
            height: 200,
            focus: false
        })
    });
</script>
@endsection