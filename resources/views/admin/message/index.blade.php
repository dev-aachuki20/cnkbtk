@extends('layouts.admin')
@section('content')
<div class="content-wrapper faq-wrap">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{trans("cruds.global.read_chat")}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
                        <li class="breadcrumb-item active">{{trans("cruds.global.read_chat")}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section> -->
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
                                        <div class="col-auto px-0"><h6 class="m-0"><span>Admin</span></h6></div>
                                        <div class="col-auto px-0"><h6 class="m-0"><span class="outgoing">Creator</span></h6></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 h-100 flex-fill overflow-hidden">
                                <div class="messageBoxBg">
                                    <div class="message-container pl-3 py-3 h-100" id="messageContainer">
                                        <div class="chatbody overflow-y-auto pr-3 h-100">
                                            <div class="date-message">
                                                <div class="datemention"><span>13 May 2024</span></div>
                                                <div class="message incoming"><div class="message-content">Lorem ipsum dolor sit.<span class="message_time"><span class="pe-1">Admin</span> 12:29</span></div></div>
                                            </div>
                                            <div class="date-message">
                                                <div class="message outgoing multipal-message">
                                                    <div class="message-content">Hello i am admin <span class="message_time"><span class="pe-1">Creator</span> 12:29</span></div>
                                                    <div class="message-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, culpa.</div>
                                                    <div class="message-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, culpa.</div>
                                                </div>
                                            </div>
                                            <div class="date-message">
                                                <div class="datemention"><span>15 May 2024</span></div>
                                                <div class="message incoming multipal-message">
                                                    <div class="message-content">Hello i am admin <span class="message_time"><span class="pe-1">Admin</span> 12:29</span></div>
                                                    <div class="message-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium inventore beatae omnis rem cumque? Voluptas.</div>
                                                    <div class="message-content">Lorem ipsum dolor sit amet consectetur.</div>
                                                </div>
                                                <div class="message outgoing">
                                                    <div class="message-content">Lorem, ipsum dolor sit amet !<span class="message_time"><span class="pe-1">Creator</span> 12:29</span></div>
                                                </div>
                                                <div class="message incoming"><div class="message-content">Ohh! i am user <span class="message_time"><span class="pe-1">Admin</span> 12:29</span></div></div>
                                            </div>
                                            <div class="date-message">
                                                <div class="datemention"><span>15 May 2024</span></div>
                                                <div class="message incoming"><div class="message-content">Hello team Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, exercitationem? <span class="message_time"><span class="pe-1">Admin</span> 12:29</span></div></div>
                                                <div class="message outgoing">
                                                    <div class="message-content">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam, numquam!<span class="message_time"><span class="pe-1">Creator</span> 12:29</span></div>
                                                </div>
                                                <div class="message incoming"><div class="message-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Est voluptates impedit inventore commodi fugit facere autem sunt voluptas omnis modi, velit, dolore perspiciatis totam iste consequatur consectetur dicta tempore! Quasi! <span class="message_time"><span class="pe-1">Admin</span> 01:45</span></div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- right panel end -->
            </div>
        </div>
</section>



    @endsection