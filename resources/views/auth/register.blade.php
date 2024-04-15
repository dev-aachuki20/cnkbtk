@extends('layouts.app')
@section('content')
    <!-- Start Login Wrapper -->
    <div class="sufee-login login-wrapper d-flex align-content-center flex-wrap register-wrapper">
        <div class="login-content-left">
            <div class="login-content">
                <div class="login-form">
                    <div class="login-title">
                        <h2>{{trans('pages.sign_up.form.form_title')}}</h2>
                    </div>
                    <form id="registerForm" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label for="loginname">{{trans('pages.sign_up.form.fields.user_name')}}<span class="mailstar" style="color: red;">*</span></label>

                                    <input type="text" value="{{ old('user_name') }}" placeholder="{{trans('global.enter')}} {{trans('pages.sign_up.form.fields.user_name')}}" class="form-control @error('user_name') is-invalid @enderror" name="user_name" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '').replace(/(\..*)\./g, '$1');">
                                    @error('user_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label for="loginEmail">{{trans('pages.sign_up.form.fields.email_address')}}<span class="mailstar" style="color: red;">*</span></label>
                                    <input type="email" value="{{ old('email') }}" placeholder="{{trans('global.enter')}} {{trans('pages.sign_up.form.fields.email_address')}}" class="form-control @error('email') is-invalid @enderror" id="loginEmail" name="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                           
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label for="loginPassword">{{trans('pages.sign_up.form.fields.password')}}<span class="mailstar" style="color: red;">*</span></label>
                                    <div class="input-password-wrap">
                                        <input type="password" value="" placeholder="{{trans('global.enter')}} {{trans('pages.sign_up.form.fields.password')}}" class="form-control @error('password') is-invalid @enderror" id="loginPassword" name="password">
                                        <i class="fa fa-eye toggle-password opened_eye" style="margin-left: -30px; cursor: pointer; display:none"></i>
                                        <i class="fa fa-eye-slash toggle-password closed_eye" style="cursor: pointer;"></i>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="loginPassword3">{{trans('pages.sign_up.form.fields.confirm_password')}}<span class="mailstar" style="color: red;">*</span></label>
                                    <div class="input-password-wrap">
                                        <input type="password" value="" placeholder="{{trans('global.enter')}} {{trans('pages.sign_up.form.fields.confirm_password')}}" class="form-control" id="loginPassword3" name="password_confirmation">
                                        <i class="fa fa-eye toggle-password opened_eye" style="margin-left: -30px; cursor: pointer; display:none"></i>
                                        <i class="fa fa-eye-slash toggle-password closed_eye" style="cursor: pointer;"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <button type="submit"  class="submitBtn btn btn-success btn-flat m-b-30 m-t-30 mb-4">{{trans('global.sign_up')}}</button>
                                <div class="fr-signup-wrapper">
                                    {{trans('global.already_account')}} <a href="{{route('login')}}"> {{trans('global.sign_in')}} </a> 
                                </div>
                            </div>
                        </div>
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
                var input = $(this).closest('.input-password-wrap').find('input')
                
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