@extends('layouts.admin')
@section('content')
<div class="content-wrapper faq-wrap">
    <section class="single-wrapper">
        <div class="px-0 chatboxGroup open" id="chatboxGroup">
            <div class="row h-100 gx-3">
                <!-- right panel start -->
                <div class="col-12 chat-panel h-100 chatscreen">
                    <div class="card chatcard h-100 overflow-hidden">
                        <div class="row h-100 flex-column flex-nowrap overflow-hidden">
                            <div class="col-12 auto-flex">
                                <div class="authorname chat-header">
                                    <div class="row mx-0 gap-3">
                                        <div class="col-auto px-0">
                                            <h6 class="m-0"><span>User ({{$user->user_name ?? ''}})</span></h6>
                                        </div>
                                        <div class="col-auto px-0">
                                            <h6 class="m-0"><span class="outgoing">Creator ({{$creator->user_name ?? ''}})</span></h6>
                                        </div>

                                        {{-- <a href="{{route('admin.projects.readChat', $projectId)}}" id="refresh-messages" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                                        </a> --}}

                                        <a id="refresh-messages" class="btn btn-primary" data-project-id="{{$projectId}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                                        </a> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 h-100 flex-fill overflow-hidden chat">
                                @include("admin.message.message") 
                            </div>
                        </div>
                    </div>
                </div>
                <!-- right panel end -->
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
@include('admin.message.partials.script', ['projectId' => $projectId, 'creatorId' => $creatorId, 'userId' => $userId])
@endsection