@extends('layouts.app')
@section('content')
    <div class="sufee-login login-wrapper d-flex align-content-center">
        <div class="login-content-left">
            <div class="login-content">
                <div class="login-form">
                    <div class="login-title">
                    {{--  --}}
                        <h2>{{trans('pages.login.form.form_title')}}  </h2>
                        <p>{{trans('pages.login.form.form_decription')}}</p>
                    </div>
                    <form id="loginForm" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="loginEmail">{{trans('pages.login.form.fields.user')}}<span class="mailstar" style="color: red;">*</span></label>
                            <input type="text" name="user_name" value="{{ old('user_name') }}" placeholder="{{trans('global.enter')}} {{trans('pages.login.form.fields.user')}}" class="form-control @error('user_name') is-invalid @enderror" id="loginEmail">
                          
                           
                            @error('user_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user_name') }}</strong>
                                </span>
                            @enderror
                           
                        </div>
                        <div class="form-group">
                            <label for="loginPassword">{{trans('pages.login.form.fields.password')}}<span class="mailstar" style="color: red;">*</span></label>
                            <div class="input-password-wrap">

                            <input type="password" placeholder="{{trans('global.enter')}} {{trans('pages.login.form.fields.password')}}" class="form-control @error('password') is-invalid @enderror" id="loginPassword" name="password">
                                <i class="fa fa-eye-slash" id="togglePassword"style="margin-left: -30px; cursor: pointer;"></i>

                                <!-- <input type="password" placeholder="{{trans('global.enter')}} {{trans('pages.login.form.fields.password')}}" class="form-control @error('password') is-invalid @enderror" id="loginPassword" name="password">
                                <i class="fa fa-eye toggle-password opened_eye" id="togglePassword" style="margin-left: -30px; cursor: pointer; display:none;" ></i>
                                <i class="fa fa-eye-slash toggle-password closed_eye"></i> -->
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first("password") }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="forgot-wrapper mt-4 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember_me" value="" id="remember">
                                <label class="form-check-label" for="remember">
                                    {{ __('global.remember_me') }}
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                            {{-- --}}
                            <a href="{{ route('password.request') }}" id="remember"> {{ __('global.forget_password') }}</a>
                            @endif
                        </div>
                        {{--  --}}
                        <button type="submit"  class="submitBtn btn btn-success btn-flat m-b-30 m-t-30 mb-4">{{ __('global.sign_in') }}</button>
                        <div class="fr-signup-wrapper">
                        {{--  --}}
                           {{ __('global.not_account') }}<a href="{{route('register')}}">{{ __('global.sign_up') }}</a> 
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
    
@endsection
@section('scripts')
    <script>
        // $(document).ready(function(){
        //     $(document).on('click', '.toggle-password', function() {
        //         var input = $("#loginPassword");
        //         if (input.attr("type") == "password") {
        //             $('.opened_eye').css('display','block');
        //             $('.closed_eye').css('display','none');
        //             input.attr("type", "text");
        //         } else {
        //             input.attr("type", "password");
        //             $('.opened_eye').css('display','none');
        //             $('.closed_eye').css('display','block');
        //         }   
        //     });
        // });

        document.addEventListener("DOMContentLoaded", () => {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#loginPassword');
            togglePassword.addEventListener('click', function (e) {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye');
            });
        });
    </script>
@endsection