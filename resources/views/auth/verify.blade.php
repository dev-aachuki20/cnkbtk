@extends('layouts.app')
@section("links")
<style>
.verify_email .card-header {
    background-color: #ff625b;
    color: #ffffff;
    font-size: 24px;
    font-weight: 700;
    border-color: #ff625b;
}
.verify_email {
    padding: 4rem 0;
}
.verify_email .card {
    border: none;
}
.verify_email .card .card-body {
    border-top: none !important;
    border: 1px solid #c7c7c7;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 6px;
}
.verify_email .card .card-body form.d-inline {
    color: #ff615d;
    font-size: 12px;
    margin-top: 1rem;
    display: block !important;
}

.verify_email .card .card-body form.d-inline button {
    font-size: 14px;
    text-decoration: none;
    color: #ff615d;
    font-weight: 600;
    margin-top: 1rem;
    padding-top: 1rem;
}
</style>
@section('content')
<!-- hero privacy  -->
    <section class="privacy-hero">
        <div class="container">
            <div class="hero-banner">
                <div class="prc-title">
                    <h2>
                        {{trans('pages.verify_page.verify_your')}}  <span> {{trans('pages.verify_page.email')}}</span>
                    </h2>
                </div>
            </div>
        </div>
    </section>
    <!-- end  -->
<div class="verify_email">
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{trans('pages.verify_page.verify_your_email_address')}}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{trans('pages.verify_page.fresh_mail_sent')}}
                        </div>
                    @endif

                    {{trans('pages.verify_page.verification_link_sent')}}
                    {{trans('pages.verify_page.not_recieve_mail')}},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{trans('pages.verify_page.request_another_mail')}}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
