@extends('layouts.app')
@section('content')
<!-- Start Login Wrapper -->
    <div class="sufee-login login-wrapper d-flex align-content-center">
        <div class="login-content-left">
            <div class="login-content">
                <div class="login-form">
                    <div class="login-title">
                        <h2>
                             {{trans('pages.reset_password.reset_password')}}
                        </h2>
                        <p>
                            {{trans('pages.reset_password.password_instruction')}}
                        </p>
                    </div>
                      
                    <form  method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group mb-4">
                            <label for="loginEmail">{{trans('pages.reset_password.form.fields.email_address')}}<span class="mailstar" style="color: red;">*</span></label>
                            <input  id="email" type="email" class="form-control @error('email') is-invalid @enderror"  placeholder="{{trans('global.enter')}} {{trans('pages.reset_password.form.fields.email_address')}}" name="email"
                                value="{{ $email ?? old('email') }}"  autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label for="loginPassword">{{trans('pages.reset_password.form.fields.password')}}<span class="mailstar" style="color: red;">*</span></label>
                                <div class="input-password-wrap">
                                <input id="password" type="password" class="form-control @if($errors->has("password")) is-invalid @endif " name="password"  autocomplete="new-password"  placeholder="{{trans('global.enter')}} {{trans('pages.reset_password.form.fields.password')}}">
                                    <i class="fa fa-eye toggle-password opened_eye" style="margin-left: -30px; cursor: pointer; display:none"></i>
                                        <i class="fa fa-eye-slash toggle-password closed_eye" style="cursor: pointer;"></i>
                                        @if($errors->has("password"))
                                    
                                            <span class="invalid-feedback is-invalid" role="alert">
                                                <strong>{{$errors->first("password")}}</strong>
                                            </span>
                                        @endif
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                            <div class="form-group">
                                <label for="loginPassword3">{{trans('pages.reset_password.form.fields.confirm_password')}}<span class="mailstar"  style="color: red;">*</span></label>
                                <div class="input-password-wrap">
                                    <input id="password-confirm" type="password"   placeholder="{{trans('global.enter')}} {{trans('pages.reset_password.form.fields.confirm_password')}}" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                    <i class="fa fa-eye toggle-password opened_eye" style="margin-left: -30px; cursor: pointer; display:none"></i>
                                        <i class="fa fa-eye-slash toggle-password closed_eye" style="cursor: pointer;"></i>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="submitBtn btn btn-success btn-flat m-b-30 m-t-30 mb-4 mt-3">{{trans('pages.reset_password.reset_password')}}</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="login-content-right">
            <div class="login-bg-wrapo">
                <img src="{{asset('front/asset/images/login.svg')}}" alt="login">
            </div>
        </div>
    </div>
    <!-- End Login Wrapper -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $(document).on('click', '.toggle-password', function() {
                var input = $(this).closest('.input-password-wrap').find('input');
                
                if (input.attr("type") == "password") {
                    $(this).siblings('.opened_eye').show();
                    $(this).hide();
                    input.attr("type", "text");
                } else {
                     $(this).siblings('.closed_eye').show();
                    input.attr("type", "password");
                    $(this).hide();
                }   
            });
            $('#registerForm').submit(function(e) {
                e.preventDefault();
                $('.overlay').show();
                $('#registerForm').unbind('submit').submit();
            });
        });
    </script>
@endsection