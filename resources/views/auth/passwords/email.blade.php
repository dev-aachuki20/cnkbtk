@extends('layouts.app')
@section('content')
<div class="sufee-login login-wrapper d-flex align-content-center flex-wrap">
        <div class="login-content-left">
            <div class="login-content">
                <div class="login-form">
                    <div class="login-title">
                        <h2>
                            {{trans('pages.forget_password.forget_password_q')}}
                        </h2>
                        <p>
                            {{trans('pages.forget_password.send_instruction')}}
                        </p>
                    </div>
                   <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="loginEmail">{{trans('pages.forget_password.form.fields.email_address')}}<span class="mailstar" style="color: red;">*</span></label>
                            <input type="email" value="{{ old('email') }}" placeholder="{{trans('global.enter')}} {{trans('pages.forget_password.form.fields.email_address')}}" class="form-control  @error('email') is-invalid @enderror" id="loginEmail" name="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit"  class="submitBtn btn btn-success btn-flat m-b-30 m-t-30 mb-4"> {{trans('pages.forget_password.reset_password')}}</button>
                        <div class="fr-signup-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l14 0"></path>
                                <path d="M5 12l6 6"></path>
                                <path d="M5 12l6 -6"></path>
                            </svg>
                            <a href="{{ route('login') }}"> {{trans('pages.forget_password.back_to_sign_in')}}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="login-content-right">
            <div class="login-bg-wrapo">
                <img class="align-content" src="{{ asset('front/asset/images/login.svg') }}" alt="">
            </div>
        </div>
    </div>
@endsection
