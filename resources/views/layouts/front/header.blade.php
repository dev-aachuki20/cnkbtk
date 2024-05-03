    <!-- Start Header  -->
    <header>

      <nav class="navbar navbar-expand-lg bg-body-tertiary">

        <div class="container">

          <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{ asset('storage/'.$siteSettingData['logo']) }}" class="img-fluid" width="120" alt="" />

          </a>

          <div class="lang-wrapper mobile-vc">
            @auth
            <div class="avatar-nav-profile">

              <div class="dropdown">

                <a class="dropdown-toggle user-nav-title" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                  @php
                  $imagePath = asset('front/asset/images/user.png');
                  if(isset(auth()->user()->uploads) && !empty(auth()->user()->uploads) && count(auth()->user()->uploads) > 0){
                  $imagePath = asset('storage/'.auth()->user()->uploads->first()->path);
                  }
                  @endphp

                  <img src="{{$imagePath}}" class="img-fluid" alt="" />

                  <span>{{ucfirst(auth()->user()->user_name)}}</span>

                </a>

                <div class="drop-space">

                  <div class="dropdown-menu dropdown-menu-top">
                    <ul class="profile-listing-cp">

                      @if(auth()->user()->role_id == config("constant.role.admin"))
                      <li>
                        <a class="dropdown-item {{Request::is('admin/dashboard') ? 'active' : ''}} " href="{{route('admin.dashboard')}}">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-dashboard" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 4h6v8h-6z" />
                            <path d="M4 16h6v4h-6z" />
                            <path d="M14 12h6v8h-6z" />
                            <path d="M14 4h6v4h-6z" />
                          </svg>
                          {{trans("global.dashboard")}}
                        </a>
                      </li>

                      @endif

                      <li>
                        <a class="dropdown-item profileDropdown {{Request::is('user/profile') ? 'active' : ''}}" href="{{route('user.profile')}}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <g clip-path="url(#clip0_22_2)">
                              <path d="M20.59 22C20.59 18.13 16.74 15 12 15C7.26003 15 3.41003 18.13 3.41003 22M12 12C13.3261 12 14.5979 11.4732 15.5356 10.5355C16.4733 9.59785 17 8.32608 17 7C17 5.67392 16.4733 4.40215 15.5356 3.46447C14.5979 2.52678 13.3261 2 12 2C10.674 2 9.40218 2.52678 8.4645 3.46447C7.52682 4.40215 7.00003 5.67392 7.00003 7C7.00003 8.32608 7.52682 9.59785 8.4645 10.5355C9.40218 11.4732 10.674 12 12 12Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <defs>
                              <clipPath id="clip0_22_2">
                                <rect width="24" height="24" fill="white" />
                              </clipPath>
                            </defs>
                          </svg>
                          {{trans("global.profile")}}
                        </a>
                      </li>
                      <li>

                        <a class="dropdown-item basicInfoDropdown" href="{{ route('user.profile', ['tab' => 'information'])}}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M12 8V13M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M11.995 16H12.004" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                          </svg>
                          {{trans("global.basic_information")}}
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" id="changePassDropdown" href="{{route('user.profile',['tab' => 'changepassword'])}}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M6 10V8C6 4.69 7 2 12 2C17 2 18 4.69 18 8V10M12 18.5C12.663 18.5 13.2989 18.2366 13.7678 17.7678C14.2366 17.2989 14.5 16.663 14.5 16C14.5 15.337 14.2366 14.7011 13.7678 14.2322C13.2989 13.7634 12.663 13.5 12 13.5C11.337 13.5 10.7011 13.7634 10.2322 14.2322C9.76339 14.7011 9.5 15.337 9.5 16C9.5 16.663 9.76339 17.2989 10.2322 17.7678C10.7011 18.2366 11.337 18.5 12 18.5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M17 22H7C3 22 2 21 2 17V15C2 11 3 10 7 10H17C21 10 22 11 22 15V17C22 21 21 22 17 22Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                          </svg>
                          {{trans("global.change_password")}}
                        </a>
                      </li>
                      @if(auth()->user()->role_id != config("constant.role.admin"))
                      <li>
                        <a class="dropdown-item" id="creditHistoryDropdown" href="{{route('user.profile',['tab' => 'credithistory'])}}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M2 10H22" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M11.548 20.5H6.43804C2.88804 20.5 1.98804 19.62 1.98804 16.11V7.89001C1.98804 4.71001 2.72804 3.69001 5.51804 3.53001C5.79804 3.52001 6.10804 3.51001 6.43804 3.51001H17.548C21.098 3.51001 21.998 4.39001 21.998 7.90001V12.31" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6 16H10M22 18C22 18.75 21.79 19.46 21.42 20.06C21.0675 20.6525 20.5667 21.143 19.967 21.4831C19.3674 21.8233 18.6894 22.0014 18 22C17.3106 22.0014 16.6326 21.8233 16.033 21.4831C15.4333 21.143 14.9325 20.6525 14.58 20.06C14.1993 19.4404 13.9985 18.7272 14 18C14 15.79 15.79 14 18 14C20.21 14 22 15.79 22 18Z" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M19.561 18.99H17.431L17.5 17" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                          </svg>
                          {{trans("global.credit_history")}}
                        </a>
                      </li>
                      @endif
                      <li>
                        <a class="dropdown-item" id="basicInfoDropdown" href="{{route('post.create')}}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M16 2H8C4 2 2 4 2 8V21C2 21.55 2.45 22 3 22H16C20 22 22 20 22 16V8C22 4 20 2 16 2Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12.91 7.84003L7.72004 13.03C7.52004 13.23 7.33004 13.62 7.29004 13.9L7.01004 15.88C6.91004 16.6 7.41004 17.1 8.13004 17L10.11 16.72C10.39 16.68 10.78 16.49 10.98 16.29L16.17 11.1C17.06 10.21 17.49 9.17003 16.17 7.85003C14.85 6.52003 13.81 6.94003 12.91 7.84003Z" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12.17 8.58002C12.3871 9.3552 12.8002 10.0614 13.3694 10.6306C13.9387 11.1999 14.6449 11.6129 15.42 11.83" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                          </svg>
                          {{trans("global.create_post")}}

                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="{{route('post.index')}}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M13.5 21.5H2C1.45 21.5 1 21.05 1 20.5V7.5C1 3.5 3 1.5 7 1.5H15C19 1.5 21 3.5 21 7.5V12.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M11.91 7.34003L6.72004 12.53C6.52004 12.73 6.33004 13.12 6.29004 13.4L6.01004 15.38C5.91004 16.1 6.41004 16.6 7.13004 16.5L9.11004 16.22C9.39004 16.18 9.78004 15.99 9.98004 15.79L15.17 10.6C16.06 9.71003 16.49 8.67003 15.17 7.35003C13.85 6.02003 12.81 6.44003 11.91 7.34003Z" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M11.17 8.08002C11.3871 8.8552 11.8002 9.56141 12.3694 10.1306C12.9387 10.6999 13.6449 11.1129 14.42 11.33" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M23 18.5C23 19.25 22.79 19.96 22.42 20.56C22.0675 21.1525 21.5667 21.643 20.967 21.9831C20.3674 22.3233 19.6894 22.5014 19 22.5C18.3106 22.5014 17.6326 22.3233 17.033 21.9831C16.4333 21.643 15.9325 21.1525 15.58 20.56C15.1993 19.9404 14.9985 19.2272 15 18.5C15 16.29 16.79 14.5 19 14.5C21.21 14.5 23 16.29 23 18.5Z" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M20.561 19.49H18.431L18.5 17.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                          </svg>
                          {{trans("global.post_history")}}
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="{{route('chats.index')}}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M13.5 21.5H2C1.45 21.5 1 21.05 1 20.5V7.5C1 3.5 3 1.5 7 1.5H15C19 1.5 21 3.5 21 7.5V12.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M11.91 7.34003L6.72004 12.53C6.52004 12.73 6.33004 13.12 6.29004 13.4L6.01004 15.38C5.91004 16.1 6.41004 16.6 7.13004 16.5L9.11004 16.22C9.39004 16.18 9.78004 15.99 9.98004 15.79L15.17 10.6C16.06 9.71003 16.49 8.67003 15.17 7.35003C13.85 6.02003 12.81 6.44003 11.91 7.34003Z" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M11.17 8.08002C11.3871 8.8552 11.8002 9.56141 12.3694 10.1306C12.9387 10.6999 13.6449 11.1129 14.42 11.33" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M23 18.5C23 19.25 22.79 19.96 22.42 20.56C22.0675 21.1525 21.5667 21.643 20.967 21.9831C20.3674 22.3233 19.6894 22.5014 19 22.5C18.3106 22.5014 17.6326 22.3233 17.033 21.9831C16.4333 21.643 15.9325 21.1525 15.58 20.56C15.1993 19.9404 14.9985 19.2272 15 18.5C15 16.29 16.79 14.5 19 14.5C21.21 14.5 23 16.29 23 18.5Z" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M20.561 19.49H18.431L18.5 17.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                          </svg>
                          {{trans("global.chat")}}
                        </a>
                      </li>
                      <li>
                        <form method="post" action="{{route('logout')}}">

                          @csrf

                          <button type="submit" class="dropdown-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <path d="M8.9 7.55999C9.21 3.95999 11.06 2.48999 15.11 2.48999H15.24C19.71 2.48999 21.5 4.27999 21.5 8.74999V15.27C21.5 19.74 19.71 21.53 15.24 21.53H15.11C11.09 21.53 9.24 20.08 8.91 16.54M15 12H3.62M5.85 8.64999L2.5 12L5.85 15.35" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            {{trans("global.logout")}} </button>

                        </form>
                      </li>
                    </ul>
                  </div>

                </div>

              </div>

            </div>
            @endauth
            <div class="sl-nav">

              <!-- Lang -->

              <ul>

                <li>

                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="512" height="512">

                    <g id="Layer_2" data-name="Layer 2">

                      <path d="M87.95636,73.23224a44.29242,44.29242,0,0,0,6.54358-23.23145L94.5,50l-.00006-.00079a44.2927,44.2927,0,0,0-6.54376-23.23169l-.02442-.03815a44.5022,44.5022,0,0,0-75.8634-.00031l-.02472.03864a44.51347,44.51347,0,0,0-.00018,46.46436l.02514.03918a44.50213,44.50213,0,0,0,75.86292-.00037Zm-32.26825,13.641a10.81448,10.81448,0,0,1-2.8894,1.99561,6.52134,6.52134,0,0,1-5.59748,0,13.62135,13.62135,0,0,1-5.04809-4.44233,39.77474,39.77474,0,0,1-5.74762-12.47064Q43.19588,71.538,50,71.53021q6.80127,0,13.59521.42572a50.19826,50.19826,0,0,1-2.438,6.71222A25.80323,25.80323,0,0,1,55.68811,86.87329ZM10.587,52.5H28.536a88.30459,88.30459,0,0,0,1.62274,14.91418q-7.35983.64766-14.68207,1.779A39.23059,39.23059,0,0,1,10.587,52.5Zm4.88964-21.69324Q22.796,31.941,30.16388,32.58618A88.15014,88.15014,0,0,0,28.5376,47.5H10.587A39.2306,39.2306,0,0,1,15.47662,30.80676ZM44.31183,13.12665a10.81146,10.81146,0,0,1,2.8894-1.99561,6.52134,6.52134,0,0,1,5.59748,0,13.62131,13.62131,0,0,1,5.04809,4.44232A39.77482,39.77482,0,0,1,63.59436,28.044Q56.804,28.46185,50,28.46973q-6.80127-.00009-13.59528-.42578a50.18985,50.18985,0,0,1,2.43805-6.71216A25.80254,25.80254,0,0,1,44.31183,13.12665ZM89.413,47.5H71.464a88.31173,88.31173,0,0,0-1.62274-14.91425q7.35992-.64764,14.68207-1.779A39.2306,39.2306,0,0,1,89.413,47.5ZM35.18756,67.02545A82.69645,82.69645,0,0,1,33.53729,52.5H66.4632a82.67828,82.67828,0,0,1-1.64728,14.52563Q57.41607,66.54,50,66.53027,42.58927,66.53018,35.18756,67.02545Zm29.62482-34.051A82.70224,82.70224,0,0,1,66.46259,47.5H33.53674A82.67914,82.67914,0,0,1,35.184,32.97424q7.39985.4855,14.816.49543Q57.41074,33.46967,64.81238,32.97449ZM71.46228,52.5H89.413a39.23052,39.23052,0,0,1-4.88971,16.69318q-7.31936-1.13435-14.68719-1.77942A88.14559,88.14559,0,0,0,71.46228,52.5ZM81.52539,26.20477q-6.39945.92331-12.83734,1.462a57.01792,57.01792,0,0,0-2.9754-8.39581,35.48007,35.48007,0,0,0-4.13984-7.04529A39.49152,39.49152,0,0,1,81.52539,26.20477ZM22.06915,22.06915a39.48682,39.48682,0,0,1,16.3559-9.84289c-.09369.12134-.19006.2373-.28241.36114A45.64338,45.64338,0,0,0,31.321,27.66754q-6.43816-.54528-12.84643-1.46277A39.82535,39.82535,0,0,1,22.06915,22.06915Zm-3.5946,51.726q6.39943-.9234,12.83728-1.462A57.01789,57.01789,0,0,0,34.28729,80.729a35.48425,35.48425,0,0,0,4.13983,7.04529A39.49154,39.49154,0,0,1,18.47455,73.79517Zm59.45624,4.13562a39.48587,39.48587,0,0,1-16.3559,9.84289c.09369-.12134.19-.2373.28241-.36114A45.64338,45.64338,0,0,0,68.679,72.3324q6.43816.54528,12.84643,1.46277A39.82535,39.82535,0,0,1,77.93079,77.93079Z" />

                    </g>

                  </svg>

                  <i class="fa fa-angle-down" aria-hidden="true"></i>

                  <div class="triangle"></div>

                  <ul>

                    <li>
                      <a href="{{route('update-language',config('constant.language.chinese'))}}"><i class="sl-flag flag-de">
                          <div id="chinese"></div>
                        </i><span class="{{app()->getLocale() == config('constant.language.chinese')  ? 'active' : ''}}">中国人</span></a>
                      {{-- {{trans("global.chinese")}} --}}
                    </li>

                    <li>
                      <a href="{{route('update-language',config('constant.language.english'))}}"><i class="sl-flag flag-usa">
                          <div id="english"></div>
                        </i><span class="{{app()->getLocale() == config('constant.language.english')  ? 'active' : ''}}">English</span></a>
                      {{-- {{trans("global.english")}} --}}
                    </li>

                  </ul>

                </li>

              </ul>

            </div>
          </div>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link {{Request::is('/') ? 'active' : ''}}" aria-current="page" href="{{route('home')}}">{{trans("global.forum")}}</a>
              </li>

              <li class="nav-item">
                <a class="nav-link site-statistics {{Request::is('site-statistics') ? 'active' : ''}}" href="{{route('site-statistics')}}">{{trans("global.site_statistics")}}</a>
              </li>


              <li class="nav-item">

                <!-- @if(isset($menues))
              @php  $headerMenus  =  $menues->where("show_in_header",1);  @endphp
              @forelse($headerMenus as $headerMenu)
              <li class="nav-item">
                <a class="nav-link {{Request::is(".$headerMenu->slug.") ? 'active' : ''}}" href="{{route("section.page",[$headerMenu->level,$headerMenu->slug])}}">{{$headerMenu->name}}</a>
              </li>
              @empty
              @endforelse
            @endif -->



            </ul>

            <div class="login-nav d-flex align-item-center login-search">
              <form class="d-flex searchbox-wrapper-listing" role="search" id="searchForm">
                <input class="form-control me-2" id="searchBar" type="search" placeholder="{{trans("global.search")}}" aria-label="Search" />
                <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->

              </form>
              @auth

              <div class="avatar-nav-profile">

                <div class="dropdown">

                  <a class="dropdown-toggle user-nav-title" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                    @php
                    $imagePath = asset('front/asset/images/user.png');
                    if(isset(auth()->user()->uploads) && !empty(auth()->user()->uploads) && count(auth()->user()->uploads) > 0){
                    $imagePath = asset('storage/'.auth()->user()->uploads->first()->path);
                    }
                    @endphp

                    <img src="{{$imagePath}}" class="img-fluid" alt="" />

                    <span>{{ucfirst(auth()->user()->user_name)}}</span>

                  </a>

                  <div class="drop-space">

                    <div class="dropdown-menu dropdown-menu-top">
                      <ul class="profile-listing-cp">

                        @if(auth()->user()->role_id == config("constant.role.admin"))
                        <li>
                          <a class="dropdown-item {{Request::is('admin/dashboard') ? 'active' : ''}}" href="{{route('admin.dashboard')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-dashboard" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M4 4h6v8h-6z" />
                              <path d="M4 16h6v4h-6z" />
                              <path d="M14 12h6v8h-6z" />
                              <path d="M14 4h6v4h-6z" />
                            </svg>
                            {{trans("global.dashboard")}}
                          </a>
                        </li>

                        @endif

                        <li>
                          <a class="dropdown-item  {{Request::is('user/profile') && empty(request()->input("tab")) ? 'active' : ''}}" href="{{route('user.profile')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <g clip-path="url(#clip0_22_2)">
                                <path d="M20.59 22C20.59 18.13 16.74 15 12 15C7.26003 15 3.41003 18.13 3.41003 22M12 12C13.3261 12 14.5979 11.4732 15.5356 10.5355C16.4733 9.59785 17 8.32608 17 7C17 5.67392 16.4733 4.40215 15.5356 3.46447C14.5979 2.52678 13.3261 2 12 2C10.674 2 9.40218 2.52678 8.4645 3.46447C7.52682 4.40215 7.00003 5.67392 7.00003 7C7.00003 8.32608 7.52682 9.59785 8.4645 10.5355C9.40218 11.4732 10.674 12 12 12Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              </g>
                              <defs>
                                <clipPath id="clip0_22_2">
                                  <rect width="24" height="24" fill="white" />
                                </clipPath>
                              </defs>
                            </svg>
                            {{trans("global.profile")}}
                          </a>
                        </li>
                        <li>

                          <a class="dropdown-item {{Request::is('user/profile') && request()->input("tab") == "information" ? 'active' : ''}}" href="{{ route('user.profile', ['tab' => 'information'])}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <path d="M12 8V13M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M11.995 16H12.004" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            {{trans("global.basic_information")}}
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item  {{Request::is('user/profile') && request()->input("tab") == "changepassword" ? 'active' : ''}}" href="{{route('user.profile',['tab' => 'changepassword'])}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <path d="M6 10V8C6 4.69 7 2 12 2C17 2 18 4.69 18 8V10M12 18.5C12.663 18.5 13.2989 18.2366 13.7678 17.7678C14.2366 17.2989 14.5 16.663 14.5 16C14.5 15.337 14.2366 14.7011 13.7678 14.2322C13.2989 13.7634 12.663 13.5 12 13.5C11.337 13.5 10.7011 13.7634 10.2322 14.2322C9.76339 14.7011 9.5 15.337 9.5 16C9.5 16.663 9.76339 17.2989 10.2322 17.7678C10.7011 18.2366 11.337 18.5 12 18.5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M17 22H7C3 22 2 21 2 17V15C2 11 3 10 7 10H17C21 10 22 11 22 15V17C22 21 21 22 17 22Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            {{trans("global.change_password")}}
                          </a>
                        </li>
                        @if(auth()->user()->role_id != config("constant.role.admin"))
                        <li>
                          <a class="dropdown-item  {{Request::is('user/profile') && request()->input("tab") == "credithistory" ? 'active' : ''}}" href="{{route('user.profile',['tab' => 'credithistory'])}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <path d="M2 10H22" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M11.548 20.5H6.43804C2.88804 20.5 1.98804 19.62 1.98804 16.11V7.89001C1.98804 4.71001 2.72804 3.69001 5.51804 3.53001C5.79804 3.52001 6.10804 3.51001 6.43804 3.51001H17.548C21.098 3.51001 21.998 4.39001 21.998 7.90001V12.31" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M6 16H10M22 18C22 18.75 21.79 19.46 21.42 20.06C21.0675 20.6525 20.5667 21.143 19.967 21.4831C19.3674 21.8233 18.6894 22.0014 18 22C17.3106 22.0014 16.6326 21.8233 16.033 21.4831C15.4333 21.143 14.9325 20.6525 14.58 20.06C14.1993 19.4404 13.9985 18.7272 14 18C14 15.79 15.79 14 18 14C20.21 14 22 15.79 22 18Z" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M19.561 18.99H17.431L17.5 17" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            {{trans("global.credit_history")}}
                          </a>
                        </li>
                        @endif
                        <li>
                          <a class="dropdown-item {{Request::is('post/create') ? 'active' : ''}}" href="{{route('post.create')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <path d="M16 2H8C4 2 2 4 2 8V21C2 21.55 2.45 22 3 22H16C20 22 22 20 22 16V8C22 4 20 2 16 2Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M12.91 7.84003L7.72004 13.03C7.52004 13.23 7.33004 13.62 7.29004 13.9L7.01004 15.88C6.91004 16.6 7.41004 17.1 8.13004 17L10.11 16.72C10.39 16.68 10.78 16.49 10.98 16.29L16.17 11.1C17.06 10.21 17.49 9.17003 16.17 7.85003C14.85 6.52003 13.81 6.94003 12.91 7.84003Z" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M12.17 8.58002C12.3871 9.3552 12.8002 10.0614 13.3694 10.6306C13.9387 11.1999 14.6449 11.6129 15.42 11.83" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            {{trans("global.create_post")}}

                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item {{Request::is('post') ? 'active' : ''}}" href="{{route('post.index')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <path d="M13.5 21.5H2C1.45 21.5 1 21.05 1 20.5V7.5C1 3.5 3 1.5 7 1.5H15C19 1.5 21 3.5 21 7.5V12.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M11.91 7.34003L6.72004 12.53C6.52004 12.73 6.33004 13.12 6.29004 13.4L6.01004 15.38C5.91004 16.1 6.41004 16.6 7.13004 16.5L9.11004 16.22C9.39004 16.18 9.78004 15.99 9.98004 15.79L15.17 10.6C16.06 9.71003 16.49 8.67003 15.17 7.35003C13.85 6.02003 12.81 6.44003 11.91 7.34003Z" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M11.17 8.08002C11.3871 8.8552 11.8002 9.56141 12.3694 10.1306C12.9387 10.6999 13.6449 11.1129 14.42 11.33" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M23 18.5C23 19.25 22.79 19.96 22.42 20.56C22.0675 21.1525 21.5667 21.643 20.967 21.9831C20.3674 22.3233 19.6894 22.5014 19 22.5C18.3106 22.5014 17.6326 22.3233 17.033 21.9831C16.4333 21.643 15.9325 21.1525 15.58 20.56C15.1993 19.9404 14.9985 19.2272 15 18.5C15 16.29 16.79 14.5 19 14.5C21.21 14.5 23 16.29 23 18.5Z" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M20.561 19.49H18.431L18.5 17.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            {{trans("global.post_history")}}
                          </a>
                        </li>
                        @if(auth()->user()->role_id == config("constant.role.admin") || auth()->user()->role_id == config("constant.role.creator"))
                        <li>
                          <a class="dropdown-item {{Request::is('blacklist/users*') || Route::currentRouteName() === 'blacklist.user.show' ? 'active' : ''}}" href="{{route('blacklist.user')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <g clip-path="url(#clip0_22_2)">
                                <path d="M20.59 22C20.59 18.13 16.74 15 12 15C7.26003 15 3.41003 18.13 3.41003 22M12 12C13.3261 12 14.5979 11.4732 15.5356 10.5355C16.4733 9.59785 17 8.32608 17 7C17 5.67392 16.4733 4.40215 15.5356 3.46447C14.5979 2.52678 13.3261 2 12 2C10.674 2 9.40218 2.52678 8.4645 3.46447C7.52682 4.40215 7.00003 5.67392 7.00003 7C7.00003 8.32608 7.52682 9.59785 8.4645 10.5355C9.40218 11.4732 10.674 12 12 12Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              </g>
                              <defs>
                                <clipPath id="clip0_22_2">
                                  <rect width="24" height="24" fill="white" />
                                </clipPath>
                              </defs>
                            </svg>
                            {{trans("global.blacklist_user")}}
                          </a>
                        </li>
                        @endif

                        @if(auth()->user()->role_id == config("constant.role.creator"))
                        <li>
                          <a class="dropdown-item {{Route::currentRouteName() === 'user.project.request' ? 'active' : ''}}" href="{{route('user.project.request')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <g clip-path="url(#clip0_22_2)">
                                <path d="M20.59 22C20.59 18.13 16.74 15 12 15C7.26003 15 3.41003 18.13 3.41003 22M12 12C13.3261 12 14.5979 11.4732 15.5356 10.5355C16.4733 9.59785 17 8.32608 17 7C17 5.67392 16.4733 4.40215 15.5356 3.46447C14.5979 2.52678 13.3261 2 12 2C10.674 2 9.40218 2.52678 8.4645 3.46447C7.52682 4.40215 7.00003 5.67392 7.00003 7C7.00003 8.32608 7.52682 9.59785 8.4645 10.5355C9.40218 11.4732 10.674 12 12 12Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              </g>
                              <defs>
                                <clipPath id="clip0_22_2">
                                  <rect width="24" height="24" fill="white" />
                                </clipPath>
                              </defs>
                            </svg>
                            Project Request
                          </a>
                        </li>
                        @endif


                        <li>
                          <a class="dropdown-item {{Request::is('chats') ? 'active' : ''}}" href="{{route('chats.index')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <path d="M13.5 21.5H2C1.45 21.5 1 21.05 1 20.5V7.5C1 3.5 3 1.5 7 1.5H15C19 1.5 21 3.5 21 7.5V12.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M11.91 7.34003L6.72004 12.53C6.52004 12.73 6.33004 13.12 6.29004 13.4L6.01004 15.38C5.91004 16.1 6.41004 16.6 7.13004 16.5L9.11004 16.22C9.39004 16.18 9.78004 15.99 9.98004 15.79L15.17 10.6C16.06 9.71003 16.49 8.67003 15.17 7.35003C13.85 6.02003 12.81 6.44003 11.91 7.34003Z" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M11.17 8.08002C11.3871 8.8552 11.8002 9.56141 12.3694 10.1306C12.9387 10.6999 13.6449 11.1129 14.42 11.33" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M23 18.5C23 19.25 22.79 19.96 22.42 20.56C22.0675 21.1525 21.5667 21.643 20.967 21.9831C20.3674 22.3233 19.6894 22.5014 19 22.5C18.3106 22.5014 17.6326 22.3233 17.033 21.9831C16.4333 21.643 15.9325 21.1525 15.58 20.56C15.1993 19.9404 14.9985 19.2272 15 18.5C15 16.29 16.79 14.5 19 14.5C21.21 14.5 23 16.29 23 18.5Z" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M20.561 19.49H18.431L18.5 17.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            {{trans("global.chat")}}
                          </a>
                        </li>

                        @if(Auth::user() != null && auth()->user()->role_id == config("constant.role.user"))

                        <li>
                          <a class="dropdown-item {{Request::is('user/project*') ? 'active' : ''}}" href="{{route('user.project.index')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <path d="M13.5 21.5H2C1.45 21.5 1 21.05 1 20.5V7.5C1 3.5 3 1.5 7 1.5H15C19 1.5 21 3.5 21 7.5V12.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M11.91 7.34003L6.72004 12.53C6.52004 12.73 6.33004 13.12 6.29004 13.4L6.01004 15.38C5.91004 16.1 6.41004 16.6 7.13004 16.5L9.11004 16.22C9.39004 16.18 9.78004 15.99 9.98004 15.79L15.17 10.6C16.06 9.71003 16.49 8.67003 15.17 7.35003C13.85 6.02003 12.81 6.44003 11.91 7.34003Z" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M11.17 8.08002C11.3871 8.8552 11.8002 9.56141 12.3694 10.1306C12.9387 10.6999 13.6449 11.1129 14.42 11.33" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M23 18.5C23 19.25 22.79 19.96 22.42 20.56C22.0675 21.1525 21.5667 21.643 20.967 21.9831C20.3674 22.3233 19.6894 22.5014 19 22.5C18.3106 22.5014 17.6326 22.3233 17.033 21.9831C16.4333 21.643 15.9325 21.1525 15.58 20.56C15.1993 19.9404 14.9985 19.2272 15 18.5C15 16.29 16.79 14.5 19 14.5C21.21 14.5 23 16.29 23 18.5Z" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M20.561 19.49H18.431L18.5 17.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            {{trans("cruds.create_project.project_details")}}
                          </a>
                        </li>
                        @endif
                        <li>
                          <form method="post" action="{{route('logout')}}">

                            @csrf

                            <button type="submit" class="dropdown-item">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M8.9 7.55999C9.21 3.95999 11.06 2.48999 15.11 2.48999H15.24C19.71 2.48999 21.5 4.27999 21.5 8.74999V15.27C21.5 19.74 19.71 21.53 15.24 21.53H15.11C11.09 21.53 9.24 20.08 8.91 16.54M15 12H3.62M5.85 8.64999L2.5 12L5.85 15.35" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                              </svg>
                              {{trans("global.logout")}}
                            </button>

                          </form>
                        </li>
                      </ul>
                    </div>

                    </form>
                    </li>
                    </ul>
                  </div>

                </div>

              </div>

            </div>

            @else



            <ul class="d-flex align-item-center login-text">

              <li class="nav-item">

                <a class="nav-link  {{ request()->is('login') ? 'active' : '' }}" href="{{route('login')}}">{{trans("global.sign_in")}}</a>

              </li>

              <li class="nav-item">

                <a class="nav-link {{ request()->is('register') ? 'active' : '' }}" href="{{route('register')}}">{{trans("global.sign_up")}}</a>

              </li>

            </ul>

            @endauth



            <div class="lang-wrapper desktop-vc">

              <div class="sl-nav">

                <!-- Lang -->

                <ul>

                  <li>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="512" height="512">

                      <g id="Layer_2" data-name="Layer 2">

                        <path d="M87.95636,73.23224a44.29242,44.29242,0,0,0,6.54358-23.23145L94.5,50l-.00006-.00079a44.2927,44.2927,0,0,0-6.54376-23.23169l-.02442-.03815a44.5022,44.5022,0,0,0-75.8634-.00031l-.02472.03864a44.51347,44.51347,0,0,0-.00018,46.46436l.02514.03918a44.50213,44.50213,0,0,0,75.86292-.00037Zm-32.26825,13.641a10.81448,10.81448,0,0,1-2.8894,1.99561,6.52134,6.52134,0,0,1-5.59748,0,13.62135,13.62135,0,0,1-5.04809-4.44233,39.77474,39.77474,0,0,1-5.74762-12.47064Q43.19588,71.538,50,71.53021q6.80127,0,13.59521.42572a50.19826,50.19826,0,0,1-2.438,6.71222A25.80323,25.80323,0,0,1,55.68811,86.87329ZM10.587,52.5H28.536a88.30459,88.30459,0,0,0,1.62274,14.91418q-7.35983.64766-14.68207,1.779A39.23059,39.23059,0,0,1,10.587,52.5Zm4.88964-21.69324Q22.796,31.941,30.16388,32.58618A88.15014,88.15014,0,0,0,28.5376,47.5H10.587A39.2306,39.2306,0,0,1,15.47662,30.80676ZM44.31183,13.12665a10.81146,10.81146,0,0,1,2.8894-1.99561,6.52134,6.52134,0,0,1,5.59748,0,13.62131,13.62131,0,0,1,5.04809,4.44232A39.77482,39.77482,0,0,1,63.59436,28.044Q56.804,28.46185,50,28.46973q-6.80127-.00009-13.59528-.42578a50.18985,50.18985,0,0,1,2.43805-6.71216A25.80254,25.80254,0,0,1,44.31183,13.12665ZM89.413,47.5H71.464a88.31173,88.31173,0,0,0-1.62274-14.91425q7.35992-.64764,14.68207-1.779A39.2306,39.2306,0,0,1,89.413,47.5ZM35.18756,67.02545A82.69645,82.69645,0,0,1,33.53729,52.5H66.4632a82.67828,82.67828,0,0,1-1.64728,14.52563Q57.41607,66.54,50,66.53027,42.58927,66.53018,35.18756,67.02545Zm29.62482-34.051A82.70224,82.70224,0,0,1,66.46259,47.5H33.53674A82.67914,82.67914,0,0,1,35.184,32.97424q7.39985.4855,14.816.49543Q57.41074,33.46967,64.81238,32.97449ZM71.46228,52.5H89.413a39.23052,39.23052,0,0,1-4.88971,16.69318q-7.31936-1.13435-14.68719-1.77942A88.14559,88.14559,0,0,0,71.46228,52.5ZM81.52539,26.20477q-6.39945.92331-12.83734,1.462a57.01792,57.01792,0,0,0-2.9754-8.39581,35.48007,35.48007,0,0,0-4.13984-7.04529A39.49152,39.49152,0,0,1,81.52539,26.20477ZM22.06915,22.06915a39.48682,39.48682,0,0,1,16.3559-9.84289c-.09369.12134-.19006.2373-.28241.36114A45.64338,45.64338,0,0,0,31.321,27.66754q-6.43816-.54528-12.84643-1.46277A39.82535,39.82535,0,0,1,22.06915,22.06915Zm-3.5946,51.726q6.39943-.9234,12.83728-1.462A57.01789,57.01789,0,0,0,34.28729,80.729a35.48425,35.48425,0,0,0,4.13983,7.04529A39.49154,39.49154,0,0,1,18.47455,73.79517Zm59.45624,4.13562a39.48587,39.48587,0,0,1-16.3559,9.84289c.09369-.12134.19-.2373.28241-.36114A45.64338,45.64338,0,0,0,68.679,72.3324q6.43816.54528,12.84643,1.46277A39.82535,39.82535,0,0,1,77.93079,77.93079Z" />

                      </g>

                    </svg>

                    <i class="fa fa-angle-down" aria-hidden="true"></i>

                    <div class="triangle"></div>

                    <ul>

                      <li>

                        <a href="{{route('update-language',config("constant.language.chinese"))}}"><i class="sl-flag flag-de">

                            <div id="chinese2"></div>

                          </i>

                          <span class="{{app()->getLocale() == config('constant.language.chinese')  ? 'active' : ''}}">中国人</span></a>
                        {{-- {{trans("global.chinese")}} --}}

                      </li>

                      <li>

                        <a href="{{route('update-language',config('constant.language.english'))}}"><i class="sl-flag flag-usa">

                            <div id="english2"></div>

                          </i>

                          <span class="{{app()->getLocale() == config('constant.language.english')  ? 'active' : ''}}">English</span></a>
                        {{-- {{trans("global.english")}} --}}

                      </li>

                    </ul>

                  </li>

                </ul>

              </div>

            </div>

          </div>

        </div>

        </div>

      </nav>

    </header>



    <!-- end header  -->