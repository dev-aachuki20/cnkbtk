@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('admins/plugins/summernote/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admins/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{trans("cruds.setting.title")}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
              <li class="breadcrumb-item">{{trans("cruds.setting.title_singular")}}</li>
              <!--<li class="breadcrumb-item active">Site Setting</li>-->
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
                <h3 class="card-title">{{trans("cruds.setting.title")}}</h3>
              </div>
              <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('admin.settings.store') }}" id="addForm" enctype="multipart/form-data">
                    @csrf
               
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                          <h5>{{trans("cruds.setting.basic_details")}}</h5>
                          <hr/> 
                          </div>     
                          @php
                            $lang = app()->getLocale();
                          @endphp  
                          @foreach ($basic_details as $key =>$val)
                            @php
                              $labels = json_decode($val->label);
                            @endphp
                            @if($val->type == 'text' || $val->type == 'number' || $val->type == 'email' || $val->type == 'url')
                              <div class="col-md-6">
                                <input type="hidden" value="{{$val->id}}" name="settings[{{$key}}][id]" >
                                <input type="hidden" value="{{$val->type}}" name="settings[{{$key}}][type]" >
                                  <div class="form-group">
                                      <label>{{ $labels->$lang }} </label>
                                      @if($val->key == "contact_no")
                                      
                                      <input type="tel" name="settings[{{$key}}][value]" value="{{ $val->value }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{$labels->$lang}}" id="{{$val->key}}">
                                      @else
                                      <input type="{{$val->type}}" name="settings[{{$key}}][value]" value="{{ $val->value }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{$labels->$lang}}" id="{{$val->key}}">
                                      @endif
                                  </div>  
                              </div>
                            @elseif($val->type == 'select')
                              <div class="col-md-6">
                              <input type="hidden" value="{{$val->id}}" name="settings[{{$key}}][id]" >
                              <input type="hidden" value="{{$val->type}}" name="settings[{{$key}}][type]" >
                                <div class="form-group">
                                  <label>{{$labels->$lang}} </label>
                                  <select name="settings[{{$key}}][value]" class="form-control">
                                    @foreach($val->options as $optionKey => $option)
                                      <option value="{{ $option }}" {{ (!empty($val->value) && $val->value == $option) ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>

                            @elseif($val->type == 'file')
                              <div class="col-md-6">
                                  <input type="hidden" value="{{$val->id}}" name="settings[{{$key}}][id]" >
                                  <input type="hidden" value="{{$val->type}}" name="settings[{{$key}}][type]" >
                                  <div class="form-group">
                                    <label for="LogoImage">{{$labels->$lang}} @if(!isset($setting)) @endif<small>(Allowed type jpg | png | svg | jpeg | JPG | JPEG | PNG | SVG)</small></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input  logoimage" name="settings[{{$key}}][value]"  id="LogoImage" accept="image/png, image/jpg, image/jpeg, image/PNG, image/JPG, image/JPEG, image/SVG, image/svg">
                                            <label class="custom-file-label" for="LogoImage">Choose file</label>
                                        </div>
                                    </div>
                                    @php
                                      if(!empty($val->value)){
                                          $imagePath = asset('storage/'. $val->value);
                                      } else {
                                          $imagePath = '';
                                      }
                                  @endphp
                                    <a href="{{ !empty($imagePath) ? $imagePath : ''}}" data-toggle="lightbox" id="lightBox">
                                      <img class="profile-user-img img-fluid" src="{{ !empty($imagePath) ? $imagePath : ''}}" alt="Image" id="preview" style="{{ empty($imagePath) ? 'display:none;' : ''}}">
                                    </a>
                                  
                                  </div>  
                              </div>
                            
                            @elseif($val->type == 'textarea')

                              <div class="col-md-6">
                              
                                <input type="hidden" value="{{$val->id}}" name="settings[{{$key}}][id]" >
                                <input type="hidden" value="{{$val->type}}" name="settings[{{$key}}][type]" >
                                  <div class="form-group">
                                      <label>{{$labels->$lang}} </label>
                                      @if($val->key == "contact_no")
                                     
                                      <input type="tel" name="settings[{{$key}}][value]" value="{{ $val->value }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{$labels->$lang}}" id="{{$val->key}}">
                                      @else
                                      <input type="{{$val->type}}" name="settings[{{$key}}][value]" value="{{ $val->value }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{$labels->$lang}}" id="{{$val->key}}">
                                      @endif
                                  </div>  
                              </div>
                            @endif
                          @endforeach
                       
                          

                        

                        <div class="col-12">
                          <h5>{{trans("cruds.setting.footer")}}</h5>
                          <hr/>
                        </div>

                        @foreach ($footer_details as $key =>$val)
                            @php
                              $labels = json_decode($val->label);
                            @endphp
                            @if($val->type == 'text' || $val->type == 'number' || $val->type == 'email' || $val->type == 'url')
                              <div class="col-md-6">
                                <input type="hidden" value="{{$val->id}}" name="settings[{{$key}}][id]" >
                                <input type="hidden" value="{{$val->type}}" name="settings[{{$key}}][type]" >
                                  <div class="form-group">
                                      <label>{{ $labels->$lang }} </label>
                                      @if($val->key == "contact_no")
                                      <input type="tel" name="settings[{{$key}}][value]" value="{{ $val->value }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{$labels}}" id="{{$val->key}}">
                                      @else
                                      <input type="{{$val->type}}" name="settings[{{$key}}][value]" value="{{ $val->value }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{$labels->$lang}}" id="{{$val->key}}">
                                      @endif
                                  </div>  
                              </div>
                            @elseif($val->type == 'select')
                              <div class="col-md-6">
                              <input type="hidden" value="{{$val->id}}" name="settings[{{$key}}][id]" >
                              <input type="hidden" value="{{$val->type}}" name="settings[{{$key}}][type]" >
                                <div class="form-group">
                                  <label>{{$labels->$lang}} </label>
                                  <select name="settings[{{$key}}][value]" class="form-control">
                                    @foreach($val->options as $optionKey => $option)
                                      <option value="{{ $option }}" {{ (!empty($val->value) && $val->value == $option) ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>

                            @elseif($val->type == 'file')
                              <div class="col-md-6">
                                  <input type="hidden" value="{{$val->id}}" name="settings[{{$key}}][id]" >
                                  <input type="hidden" value="{{$val->type}}" name="settings[{{$key}}][type]" >
                                  <div class="form-group">
                                    <label for="LogoImage">Logo @if(!isset($setting)) @endif<small>(Allowed type jpg | png | svg | jpeg | JPG | JPEG | PNG | SVG)</small></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input  logoimage" name="settings[{{$key}}][value]"  id="LogoImage" accept="image/png, image/jpg, image/jpeg, image/PNG, image/JPG, image/JPEG, image/SVG, image/svg">
                                            <label class="custom-file-label" for="LogoImage">Choose file</label>
                                        </div>
                                    </div>
                                    @php
                                      if(!empty($val->value)){
                                          $imagePath = asset('storage/'. $val->value);
                                      } else {
                                          $imagePath = '';
                                      }
                                  @endphp
                                    <a href="{{ !empty($imagePath) ? $imagePath : ''}}" data-toggle="lightbox" id="lightBox">
                                      <img class="profile-user-img img-fluid" src="{{ !empty($imagePath) ? $imagePath : ''}}" alt="Image" id="preview" style="{{ empty($imagePath) ? 'display:none;' : ''}}">
                                    </a>
                                  
                                  </div>  
                              </div>
                            
                            @elseif($val->type == 'textarea')

                              <div class="col-md-6">
                              
                                <input type="hidden" value="{{$val->id}}" name="settings[{{$key}}][id]" >
                                <input type="hidden" value="{{$val->type}}" name="settings[{{$key}}][type]" >
                                  <div class="form-group">
                                      <label>{{$labels->$lang}} </label>
                                      @if($val->key == "contact_no")
                                      <input type="tel" name="settings[{{$key}}][value]" value="{{ $val->value }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{$labels->$lang}}" id="{{$val->key}}">
                                      @else
                                      <input type="{{$val->type}}" name="settings[{{$key}}][value]" value="{{ $val->value }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{$labels->$lang}}" id="{{$val->key}}">
                                      @endif
                                  </div>  
                              </div>
                            @endif
                          @endforeach


                        <div class="col-12">
                          <h5>{{trans("cruds.setting.social_links")}}</h5>
                          <hr/>
                        </div>

                        @foreach ($social_details as $key =>$val)
                            @php
                              $labels = json_decode($val->label);
                            @endphp
                            @if($val->type == 'text' || $val->type == 'number' || $val->type == 'email' || $val->type == 'url')
                              <div class="col-md-6">
                                <input type="hidden" value="{{$val->id}}" name="settings[{{$key}}][id]" >
                                <input type="hidden" value="{{$val->type}}" name="settings[{{$key}}][type]" >
                                  <div class="form-group">
                                      <label>{{ $labels->$lang }} </label>
                                      @if($val->key == "contact_no")
                                      <input type="tel" name="settings[{{$key}}][value]" value="{{ $val->value }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{$labels}}" id="{{$val->key}}">
                                      @else
                                      <input type="{{$val->type}}" name="settings[{{$key}}][value]" value="{{ $val->value }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{$labels->$lang}}" id="{{$val->key}}">
                                      @endif
                                  </div>  
                              </div>
                            @elseif($val->type == 'select')
                              <div class="col-md-6">
                              <input type="hidden" value="{{$val->id}}" name="settings[{{$key}}][id]" >
                              <input type="hidden" value="{{$val->type}}" name="settings[{{$key}}][type]" >
                                <div class="form-group">
                                  <label>{{$labels->$lang}} </label>
                                  <select name="settings[{{$key}}][value]" class="form-control">
                                    @foreach($val->options as $optionKey => $option)
                                      <option value="{{ $option }}" {{ (!empty($val->value) && $val->value == $option) ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>

                            @elseif($val->type == 'file')
                              <div class="col-md-6">
                                  <input type="hidden" value="{{$val->id}}" name="settings[{{$key}}][id]" >
                                  <input type="hidden" value="{{$val->type}}" name="settings[{{$key}}][type]" >
                                  <div class="form-group">
                                    <label for="LogoImage">Logo @if(!isset($setting)) @endif<small>(Allowed type jpg | png | svg | jpeg | JPG | JPEG | PNG | SVG)</small></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input  logoimage" name="settings[{{$key}}][value]"  id="LogoImage" accept="image/png, image/jpg, image/jpeg, image/PNG, image/JPG, image/JPEG, image/SVG, image/svg">
                                            <label class="custom-file-label" for="LogoImage">Choose file</label>
                                        </div>
                                    </div>
                                    @php
                                      if(!empty($val->value)){
                                          $imagePath = asset('storage/'. $val->value);
                                      } else {
                                          $imagePath = '';
                                      }
                                  @endphp
                                    <a href="{{ !empty($imagePath) ? $imagePath : ''}}" data-toggle="lightbox" id="lightBox">
                                      <img class="profile-user-img img-fluid" src="{{ !empty($imagePath) ? $imagePath : ''}}" alt="Image" id="preview" style="{{ empty($imagePath) ? 'display:none;' : ''}}">
                                    </a>
                                  
                                  </div>  
                              </div>
                            
                            @elseif($val->type == 'textarea')

                              <div class="col-md-6">
                              
                                <input type="hidden" value="{{$val->id}}" name="settings[{{$key}}][id]" >
                                <input type="hidden" value="{{$val->type}}" name="settings[{{$key}}][type]" >
                                  <div class="form-group">
                                      <label>{{$labels->$lang}} </label>
                                      @if($val->key == "contact_no")
                                      <input type="tel" name="settings[{{$key}}][value]" value="{{ $val->value }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{$labels->$lang}}" id="{{$val->key}}">
                                      @else
                                      <input type="{{$val->type}}" name="settings[{{$key}}][value]" value="{{ $val->value }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{$labels->$lang}}" id="{{$val->key}}">
                                      @endif
                                  </div>  
                              </div>
                            @endif
                          @endforeach


                        
                        

                        



                        
                      </div>
                      
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
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
    $(document).ready(function () {
        $.validator.addMethod("filesize", function (value, element, param) {
          return this.optional(element) || (element.files[0].size <= param);
        }, "File size must be less than or equal to 1 MB.");

        $('#addForm').validate({
          ignore: '.ignore, .select2-input',
          focusInvalid: false,
          rules: {
           "settings[9][value]": {
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
        $(function () {
          bsCustomFileInput.init();
        });

        $('#LogoImage').on('change', function () {
            var input = $(this)[0];
            if (input.files && input.files[0]) {
            var file = input.files[0];
              var reader = new FileReader();
              
              // Check the file extension
              var allowedExtensions = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'svg','SVG'];
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
              @if(isset($imagePath))
                  var imagePath = "{{$imagePath}}";
              @endif
              
              if(imagePath != ''){
                $('#preview').attr('src', imagePath);
                $('#lightBox').attr('href', imagePath);
              } else {
                
                $('#preview').hide();
              }
              
            }
        });

        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
              alwaysShowClose: true
            });
        });
    });
</script>
@endsection