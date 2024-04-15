@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{trans("cruds.change_password.title_singular")}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
                        <li class="breadcrumb-item active">{{trans("cruds.change_password.title_singular")}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{trans("cruds.change_password.title_singular")}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.changePassword') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{trans("cruds.change_password.fields.old_password")}} <span class="text-danger">*</span></label>
                        <input type="password" name="old_password" class="form-control" id="exampleInputPassword1" placeholder="{{trans("cruds.change_password.fields.old_password")}}">
                        @if ($errors->has('old_password'))
                            <span class="text-danger">{{ $errors->first('old_password') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{trans("cruds.change_password.fields.password")}} <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="{{trans("cruds.change_password.fields.password")}}">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{trans("cruds.change_password.fields.confirm_password")}} <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="{{trans("cruds.change_password.fields.confirm_password")}}">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{trans("cruds.change_password.title_singular")}}</button>
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

@endsection