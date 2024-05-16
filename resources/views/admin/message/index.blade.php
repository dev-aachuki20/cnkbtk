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
    <div class="container">
        <div class="px-0 chatboxGroup open" id="chatboxGroup">
            <div class="row h-100 gx-3">
                                                <div class="col-xxl-3 col-lg-4 col-md-5 h-100 animate__animated animate__fadeInUp">
                    <div class="sidebar h-100 p-3 rounded-4">
                        <div class="user-list h-100">
                            <div class="row h-100 overflow-hidden flex-column flex-nowrap">
                                <div class="col-12 mb-3">
                                    <div class="input-group searchbar">
                                        <!-- saerch user -->
                                        <input type="text" id="searchInput" class="form-control rounded-pill" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                        <!-- search user end -->
                                        <button class="shadow-none btn add_btn dash-btn green-bg w-115 m-0 border-0 rounded-pill">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20.71 19.29L17.31 15.9C18.407 14.5025 19.0022 12.7767 19 11C19 9.41775 18.5308 7.87103 17.6518 6.55544C16.7727 5.23985 15.5233 4.21447 14.0615 3.60897C12.5997 3.00347 10.9911 2.84504 9.43928 3.15372C7.88743 3.4624 6.46197 4.22433 5.34315 5.34315C4.22433 6.46197 3.4624 7.88743 3.15372 9.43928C2.84504 10.9911 3.00347 12.5997 3.60897 14.0615C4.21447 15.5233 5.23985 16.7727 6.55544 17.6518C7.87103 18.5308 9.41775 19 11 19C12.7767 19.0022 14.5025 18.407 15.9 17.31L19.29 20.71C19.383 20.8037 19.4936 20.8781 19.6154 20.9289C19.7373 20.9797 19.868 21.0058 20 21.0058C20.132 21.0058 20.2627 20.9797 20.3846 20.9289C20.5064 20.8781 20.617 20.8037 20.71 20.71C20.8037 20.617 20.8781 20.5064 20.9289 20.3846C20.9797 20.2627 21.0058 20.132 21.0058 20C21.0058 19.868 20.9797 19.7373 20.9289 19.6154C20.8781 19.4936 20.8037 19.383 20.71 19.29ZM5 11C5 9.81332 5.3519 8.65328 6.01119 7.66658C6.67047 6.67989 7.60755 5.91085 8.7039 5.45673C9.80026 5.0026 11.0067 4.88378 12.1705 5.11529C13.3344 5.3468 14.4035 5.91825 15.2426 6.75736C16.0818 7.59648 16.6532 8.66558 16.8847 9.82946C17.1162 10.9933 16.9974 12.1997 16.5433 13.2961C16.0892 14.3925 15.3201 15.3295 14.3334 15.9888C13.3467 16.6481 12.1867 17 11 17C9.4087 17 7.88258 16.3679 6.75736 15.2426C5.63214 14.1174 5 12.5913 5 11Z" fill="black"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <!-- dynamic users -->
                                <div class="col-12 h-100 flex-fill overflow-y-auto">
                                    <ul id="userGroupList" class="list-group rounded-0">
                                                                                                                        <li class="list-group-item userporfile activeAccount dynamicUserList active" data-user-id="2" data-project-id="4" data-user-name="Creator">
                                                                                        <div class="userimage">
                                                <img class="userpic" src="https://devcnkbtk.hipl-staging2.com/dummy-user.svg" alt="User Image">
                                            </div>
                                            <div class="useraccount">
                                                <h5 class="content"><span class="text-truncate">Creator</span> <span class="time">11:41 AM</span></h5>
                                                
                                            </div>
                                        </li>
                                                                                <li class="list-group-item userporfile activeAccount dynamicUserList" data-user-id="16" data-project-id="4" data-user-name="Dummytesting">
                                                                                        <div class="userimage">
                                                <img class="userpic" src="https://devcnkbtk.hipl-staging2.com/dummy-user.svg" alt="User Image">
                                            </div>
                                            <div class="useraccount">
                                                <h5 class="content"><span class="text-truncate">Dummytesting</span> <span class="time">11:41 AM</span></h5>
                                                
                                            </div>
                                        </li>
                                                                                                                    </ul>
                                </div>
                                <!-- dynamic users end -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- right panel for creator -->
                                <!-- right panel end for creator -->


                <!-- Welcome screen for user. -->
                <!-- right panel start -->
                <div class="col-xxl-9 col-lg-8 col-md-7 col-md-12 chat-panel h-100 chatscreen">
                    <div class="card chatcard h-100 overflow-hidden">
                        <div class="row h-100 flex-column flex-nowrap overflow-hidden">
                            <div class="col-12">
                                <div class="chat-header p-3 d-flex justify-content-between align-items-center">
                                    <div class="userporfile activeAccount">
                                                            <div class="userimage">
                                            <img class="userpic" src="https://devcnkbtk.hipl-staging2.com/dummy-user.svg" alt="user image" height="30px" width="30px">
                                        </div>
                                        <div class="useraccount text-truncate">
                                            <h4 class="m-0 text-truncate" id="chatHeader">Creator</h4>
                                            <!-- <p class="text-truncate content m-0 activeuser">Active</p> -->
                                        </div>
                                    </div>
                                    <div class="usersetting d-flex align-items-center gap-2">
                                        <div class="">
                                            <button type="button" class="dropdown-item del_btn dash-btn red-bg rounded-3 px-3 py-2" id="lockProjectBtn" data-project-id="4" data-creator-id="2">Assign</button>
                                            
                                        </div>
                                        
                                    <button class="btn close-btn d-md-none d-flex shadow-none border-0">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.4099 11.9999L19.7099 5.70994C19.8982 5.52164 20.004 5.26624 20.004 4.99994C20.004 4.73364 19.8982 4.47825 19.7099 4.28994C19.5216 4.10164 19.2662 3.99585 18.9999 3.99585C18.7336 3.99585 18.4782 4.10164 18.2899 4.28994L11.9999 10.5899L5.70994 4.28994C5.52164 4.10164 5.26624 3.99585 4.99994 3.99585C4.73364 3.99585 4.47824 4.10164 4.28994 4.28994C4.10164 4.47825 3.99585 4.73364 3.99585 4.99994C3.99585 5.26624 4.10164 5.52164 4.28994 5.70994L10.5899 11.9999L4.28994 18.2899C4.19621 18.3829 4.12182 18.4935 4.07105 18.6154C4.02028 18.7372 3.99414 18.8679 3.99414 18.9999C3.99414 19.132 4.02028 19.2627 4.07105 19.3845C4.12182 19.5064 4.19621 19.617 4.28994 19.7099C4.3829 19.8037 4.4935 19.8781 4.61536 19.9288C4.73722 19.9796 4.86793 20.0057 4.99994 20.0057C5.13195 20.0057 5.26266 19.9796 5.38452 19.9288C5.50638 19.8781 5.61698 19.8037 5.70994 19.7099L11.9999 13.4099L18.2899 19.7099C18.3829 19.8037 18.4935 19.8781 18.6154 19.9288C18.7372 19.9796 18.8679 20.0057 18.9999 20.0057C19.132 20.0057 19.2627 19.9796 19.3845 19.9288C19.5064 19.8781 19.617 19.8037 19.7099 19.7099C19.8037 19.617 19.8781 19.5064 19.9288 19.3845C19.9796 19.2627 20.0057 19.132 20.0057 18.9999C20.0057 18.8679 19.9796 18.7372 19.9288 18.6154C19.8781 18.4935 19.8037 18.3829 19.7099 18.2899L13.4099 11.9999Z" fill="black"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 h-100 flex-fill overflow-y-auto messageBoxBg">
                            <div class="message-container px-3 overflow-y-auto" id="messageContainer" style="overflow-y: scroll;">
                                
                                            
                                            <div class="datemention"><span>13 May 2024</span></div>
                                            
                                            <div class="message incoming">
                                    <div class="message-content">hey <span class="message_time">06:26 PM</span></div>
                                </div>
                                                        
                                
                                            <div class="message outgoing">
                                    <div class="message-content">hello <span class="message_time">06:27 PM</span></div>
                                </div>
                                                        
                                            <div class="datemention"><span>15 May 2024</span></div>
                                            
                                            <div class="message outgoing">
                                    <div class="message-content">hii <span class="message_time">07:01 PM</span></div>
                                </div>
                                                    </div>
                        </div>
                        <div class="col-12">
                            <!-- form start -->
                            <form id="messageForm" data-sender-id="3" data-receiver-id="2">
                                <div class="message-input p-3">
                                    <div class="row gx-2 align-items-center">
                                        <div class="col">
                                            <textarea name="content" id="messageInput" rows="1" class="form-control shadow-none" placeholder="Type your message..." style="height: 48px;" required="" data-gramm="false" wt-ignore-input="true"></textarea>
                                        </div>
                                        <div class="col-auto d-flex">
                                            <div class="d-flex gap-2">
                                                <button id="sendMessageBtn" class="add_btn dash-btn green-bg w-115 m-0 shadow-none">
                                                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_717_4)">
                                                            <mask id="mask0_717_4" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="48" height="48">
                                                                <path d="M48 0H0V48H48V0Z" fill="white"></path>
                                                            </mask>
                                                            <g mask="url(#mask0_717_4)">
                                                                <path d="M6.16212 27.2536L20.1639 24.4531C21.4141 24.2033 21.4141 23.7968 20.1639 23.5471L6.16212 20.7466C5.32812 20.5801 4.51587 19.7671 4.34937 18.9338L1.54887 4.93209C1.29837 3.68109 2.03562 3.09984 3.19437 3.63459L45.9211 23.3543C46.6929 23.7106 46.6929 24.2896 45.9211 24.6458L3.19437 44.3656C2.03562 44.9003 1.29837 44.3191 1.54887 43.0681L4.34937 29.0663C4.51587 28.2331 5.32812 27.4201 6.16212 27.2536Z" fill="#ff6359"></path>
                                                            </g>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_717_4">
                                                                <rect width="48" height="48" fill="#ff6359"></rect>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- form end -->
                        </div>
                    </div>
                </div>
            </div>
                <!-- right panel end -->
                <!-- Welcome screen end for user. -->
            </div>
        </div>
    </div>
</section>



    @endsection