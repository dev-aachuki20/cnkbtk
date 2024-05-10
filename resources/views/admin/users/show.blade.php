@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('admins/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection
@section('content')
<div class="content-wrapper faq-wrap">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{trans("cruds.global.view")}} {{trans("cruds.user.title_singular")}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">{{trans("cruds.user.title")}}</a></li>
                        <li class="breadcrumb-item active">{{trans("cruds.global.view")}} {{trans("cruds.user.title_singular")}}</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{trans("cruds.global.view")}} {{trans("cruds.user.title_singular")}}</h3>
                        </div>
                        <div class="card-body" style="padding:0px;">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>{{trans("cruds.user.fields.user_name")}}</th>
                                            <td>{{ $user->user_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{trans("cruds.user.fields.email")}}</th>
                                            <td>{{ $user->email }}</td>
                                        </tr>

                                        <tr>
                                            <th>{{trans("cruds.user.fields.role")}}</th>
                                            <td>{{$user->role_id == config("constant.role.creator")  ? "Creator" : "User"}}</td>
                                        </tr>
                                        <tr>
                                            <th>{{trans("cruds.global.status")}}</th>
                                            <td>
                                                @if($user->status == 1)
                                                <span class="badge badge-info mr-1">{{trans("cruds.global.active")}}</span>
                                                @else
                                                <span class="badge badge-danger mr-1">{{trans("cruds.global.in_active")}}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{trans("cruds.user.fields.image")}}</th>
                                            @php
                                            if(isset($user->uploads) && !empty($user->uploads) && count($user->uploads) > 0){
                                            $imagePath = asset('storage/'. $user->uploads->first()->path );
                                            } else {
                                            $imagePath = null;
                                            }
                                            @endphp
                                            <td>
                                                <a href="{{ !empty($imagePath) ? $imagePath : ''}}" data-toggle="lightbox" id="lightBox">
                                                    <img class="profile-user-img img-fluid" src="{{$imagePath}}" alt="Image" id="preview" style="{{ empty($imagePath) ? 'display:none;' : ''}}"></a>
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
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
<script src="{{ asset('admins/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });
    });
</script>

@endsection