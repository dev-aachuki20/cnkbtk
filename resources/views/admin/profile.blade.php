@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('admins/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{trans("cruds.profile.title_singular")}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
                <li class="breadcrumb-item active">{{trans("cruds.profile.title_singular")}}</li>
                </ol>
            </div>
            </div>
        </div>
        </section>

        
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @php
                                    if(isset(auth()->user()->uploads->first()->path) && auth()->user()->uploads->first()->path != null && Storage::disk('public')->exists(auth()->user()->uploads->first()->path)){
                                    $profileImage = asset('storage/'.auth()->user()->uploads->first()->path);
                                    }else{
                                        $profileImage = asset('admins/dist/img/user2-160x160.jpg');
                                    }
                                @endphp
                               
                                <img class="profile-user-img img-fluid img-circle" src="{{$profileImage }}" alt="User profile picture">
                            </div>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>{{trans("cruds.profile.fields.user_name")}}</b> <a class="float-right">{{ $user->user_name}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{trans("cruds.profile.fields.email")}}</b> <a class="float-right">{{ $user->email}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{trans("cruds.profile.fields.role")}}</b> <a class="float-right">Admin</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{trans("cruds.profile.title_singular")}}</h3>
                            </div>
                    
                            <form method="POST" action="{{ route('admin.update_profile',$user->id) }}" id="profileForm" enctype="multipart/form-data">
                                @csrf
                            
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>{{trans("cruds.profile.fields.user_name")}} <span class="text-danger">*</span></label>
                                        <input type="text" name="user_name" value="{{ old('user_name',$user->user_name) }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}}  {{trans("cruds.profile.fields.user_name")}}">
                                        @if ($errors->has('user_name'))
                                            <span class="text-danger">{{ $errors->first('user_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{trans("cruds.profile.fields.email")}} <span class="text-danger">*</span></label>
                                        <input type="email" name="email" value="{{ old('email',$user->email) }}" class="form-control" id="exampleInputEmail1" placeholder="{{trans("cruds.global.enter")}} {{trans("cruds.profile.fields.email")}}">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="profileImage">{{trans("cruds.profile.fields.profile_image")}} <small>({{trans('cruds.global.allowed_file_type')}})</small></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image"  id="profileImage" accept="image/png, image/jpg, image/jpeg, image/PNG, image/JPG, image/JPEG">
                                                <label class="custom-file-label" for="profileImage">{{trans("cruds.global.choose_file")}}</label>
                                            </div>
                                        </div>
                                        @if ($errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                        <a href="" data-toggle="lightbox" id="lightBox">
                                            <img class="profile-user-img img-fluid" src="" alt="User profile picture" id="preview" style="display:none;">
                                        </a>
                                    </div>
                                    
                                    
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{trans("cruds.global.save")}}</button>
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
<script src="{{ asset('admins/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('admins/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<script src="{{ asset('admins/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script>
$(document).ready(function(){
    $.validator.addMethod("filesize", function (value, element, param) {
      return this.optional(element) || (element.files[0].size <= param);
    }, "File size must be less than or equal to 1 MB.");
    $(function () {
        $('#profileForm').validate({
          ignore: '.ignore, .select2-input',
          focusInvalid: false,
          rules: {
            'image': {
              filesize: 1024000,
              required: false
            }
          },
          // Errors //
          errorPlacement: function errorPlacement(error, element) {
            var $parent = $(element).parents('.form-group');
    
            // Do not duplicate errors
            if ($parent.find('.jquery-validation-error').length) {
              return;
            }
    
            $parent.append(
              error.addClass('jquery-validation-error small form-text invalid-feedback')
            );
          },
          highlight: function (element) {
            var $el = $(element);
            var $parent = $el.parents('.form-group');
            $el.addClass('is-invalid');
          },
          unhighlight: function (element) {
            $(element).parents('.selectBoxDiv').find('.is-invalid').removeClass('is-invalid');
          }
        });
    });
    $(function () {
        bsCustomFileInput.init();
    });

    $('#profileImage').on('change', function () {
        var input = $(this)[0];
        if (input.files && input.files[0]) {
            var file = input.files[0];
            var reader = new FileReader();
            
            // Check the file extension
            var allowedExtensions = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];
            var fileExtension = file.name.split('.').pop().toLowerCase();
            if (allowedExtensions.indexOf(fileExtension) === -1) {
              // Invalid file extension
              toastr.error(trans("messages.invalid_file_format"),trans("global.alert.error"));
              $(this).val('');
              $('#preview').hide();
              return;
            }
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
                $('#lightBox').attr('href', e.target.result);
               
            };
            reader.readAsDataURL(input.files[0]);
            $('#preview').show();
        } else {
            $('#preview').hide();
        }
    });

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
        alwaysShowClose: true
        });
    });
    /* profileImage.onchange = evt => {
        const [file] = profileImage.files
        if (file) {
            preview.src = URL.createObjectURL(file)
            $('#preview').show();

        }
    } */
})
</script>
@endsection