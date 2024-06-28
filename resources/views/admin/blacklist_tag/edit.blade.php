@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{trans("cruds.global.edit")}} {{trans("cruds.blacklist_tag.title_singular")}}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.blacklist-tag.index')}}">{{trans("cruds.blacklist_tag.title")}}</a></li>
            <li class="breadcrumb-item active">{{trans("cruds.global.edit")}} {{trans("cruds.blacklist_tag.title_singular")}}</li>
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
              <h3 class="card-title">{{trans("cruds.global.edit")}} {{trans("cruds.blacklist_tag.title_singular")}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('admin.blacklist-tag.update',$blacklistTag->id) }}" id="edtiForm">
              @csrf
              @method("PATCH")
              @include("admin.blacklist_tag._form")
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