<nav class="main-header">
  <div class="nav-inner  navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item web_location">
        <a class="nav-link btn btn-primary text-white"  href="{{route('home')}}">{{trans("global.go_to_webiste")}}</i></a>
      </li> 
      <li class="nav-item dropdown">
       
        <a class="nav-link" data-toggle="dropdown" href="javascript:void);">
          {{auth::user()->user_name}} <i class="fas fa-angle-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right userdrop-down-listing">
          <a href="{{route('admin.profile')}}" class="dropdown-item">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <g clip-path="url(#clip0_22_2)">
            <path d="M20.59 22C20.59 18.13 16.74 15 12 15C7.26003 15 3.41003 18.13 3.41003 22M12 12C13.3261 12 14.5979 11.4732 15.5356 10.5355C16.4733 9.59785 17 8.32608 17 7C17 5.67392 16.4733 4.40215 15.5356 3.46447C14.5979 2.52678 13.3261 2 12 2C10.674 2 9.40218 2.52678 8.4645 3.46447C7.52682 4.40215 7.00003 5.67392 7.00003 7C7.00003 8.32608 7.52682 9.59785 8.4645 10.5355C9.40218 11.4732 10.674 12 12 12Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </g>
            <defs>
            <clipPath id="clip0_22_2">
            <rect width="24" height="24" fill="white"></rect>
            </clipPath>
            </defs>
          </svg>
          {{trans("global.profile")}}
        </a>
          <div class="dropdown-divider"></div>
           <a href="{{route('admin.changePasswordForm')}}" class="dropdown-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
              <path d="M6 10V8C6 4.69 7 2 12 2C17 2 18 4.69 18 8V10M12 18.5C12.663 18.5 13.2989 18.2366 13.7678 17.7678C14.2366 17.2989 14.5 16.663 14.5 16C14.5 15.337 14.2366 14.7011 13.7678 14.2322C13.2989 13.7634 12.663 13.5 12 13.5C11.337 13.5 10.7011 13.7634 10.2322 14.2322C9.76339 14.7011 9.5 15.337 9.5 16C9.5 16.663 9.76339 17.2989 10.2322 17.7678C10.7011 18.2366 11.337 18.5 12 18.5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
              <path d="M17 22H7C3 22 2 21 2 17V15C2 11 3 10 7 10H17C21 10 22 11 22 15V17C22 21 21 22 17 22Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            {{trans("global.change_password")}}
          </a>
          <div class="dropdown-divider"></div>
          <form method="post" action="{{route('logout')}}">
            @csrf
            <button type="submit" class="dropdown-item">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M8.9 7.55999C9.21 3.95999 11.06 2.48999 15.11 2.48999H15.24C19.71 2.48999 21.5 4.27999 21.5 8.74999V15.27C21.5 19.74 19.71 21.53 15.24 21.53H15.11C11.09 21.53 9.24 20.08 8.91 16.54M15 12H3.62M5.85 8.64999L2.5 12L5.85 15.35" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>    
              {{trans("global.logout")}}
            </button>
            </form>
          <div class="dropdown-divider"></div>
          
        </div>

        
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link anchor_language" data-toggle="dropdown" href="javascript:void);">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="20" height="20">
            <g id="Layer_2" data-name="Layer 2">

              <path d="M87.95636,73.23224a44.29242,44.29242,0,0,0,6.54358-23.23145L94.5,50l-.00006-.00079a44.2927,44.2927,0,0,0-6.54376-23.23169l-.02442-.03815a44.5022,44.5022,0,0,0-75.8634-.00031l-.02472.03864a44.51347,44.51347,0,0,0-.00018,46.46436l.02514.03918a44.50213,44.50213,0,0,0,75.86292-.00037Zm-32.26825,13.641a10.81448,10.81448,0,0,1-2.8894,1.99561,6.52134,6.52134,0,0,1-5.59748,0,13.62135,13.62135,0,0,1-5.04809-4.44233,39.77474,39.77474,0,0,1-5.74762-12.47064Q43.19588,71.538,50,71.53021q6.80127,0,13.59521.42572a50.19826,50.19826,0,0,1-2.438,6.71222A25.80323,25.80323,0,0,1,55.68811,86.87329ZM10.587,52.5H28.536a88.30459,88.30459,0,0,0,1.62274,14.91418q-7.35983.64766-14.68207,1.779A39.23059,39.23059,0,0,1,10.587,52.5Zm4.88964-21.69324Q22.796,31.941,30.16388,32.58618A88.15014,88.15014,0,0,0,28.5376,47.5H10.587A39.2306,39.2306,0,0,1,15.47662,30.80676ZM44.31183,13.12665a10.81146,10.81146,0,0,1,2.8894-1.99561,6.52134,6.52134,0,0,1,5.59748,0,13.62131,13.62131,0,0,1,5.04809,4.44232A39.77482,39.77482,0,0,1,63.59436,28.044Q56.804,28.46185,50,28.46973q-6.80127-.00009-13.59528-.42578a50.18985,50.18985,0,0,1,2.43805-6.71216A25.80254,25.80254,0,0,1,44.31183,13.12665ZM89.413,47.5H71.464a88.31173,88.31173,0,0,0-1.62274-14.91425q7.35992-.64764,14.68207-1.779A39.2306,39.2306,0,0,1,89.413,47.5ZM35.18756,67.02545A82.69645,82.69645,0,0,1,33.53729,52.5H66.4632a82.67828,82.67828,0,0,1-1.64728,14.52563Q57.41607,66.54,50,66.53027,42.58927,66.53018,35.18756,67.02545Zm29.62482-34.051A82.70224,82.70224,0,0,1,66.46259,47.5H33.53674A82.67914,82.67914,0,0,1,35.184,32.97424q7.39985.4855,14.816.49543Q57.41074,33.46967,64.81238,32.97449ZM71.46228,52.5H89.413a39.23052,39.23052,0,0,1-4.88971,16.69318q-7.31936-1.13435-14.68719-1.77942A88.14559,88.14559,0,0,0,71.46228,52.5ZM81.52539,26.20477q-6.39945.92331-12.83734,1.462a57.01792,57.01792,0,0,0-2.9754-8.39581,35.48007,35.48007,0,0,0-4.13984-7.04529A39.49152,39.49152,0,0,1,81.52539,26.20477ZM22.06915,22.06915a39.48682,39.48682,0,0,1,16.3559-9.84289c-.09369.12134-.19006.2373-.28241.36114A45.64338,45.64338,0,0,0,31.321,27.66754q-6.43816-.54528-12.84643-1.46277A39.82535,39.82535,0,0,1,22.06915,22.06915Zm-3.5946,51.726q6.39943-.9234,12.83728-1.462A57.01789,57.01789,0,0,0,34.28729,80.729a35.48425,35.48425,0,0,0,4.13983,7.04529A39.49154,39.49154,0,0,1,18.47455,73.79517Zm59.45624,4.13562a39.48587,39.48587,0,0,1-16.3559,9.84289c.09369-.12134.19-.2373.28241-.36114A45.64338,45.64338,0,0,0,68.679,72.3324q6.43816.54528,12.84643,1.46277A39.82535,39.82535,0,0,1,77.93079,77.93079Z"></path>

            </g>
          </svg><i class="fas fa-angle-down ml-1"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="{{route('update-language',config('constant.language.chinese'))}}" class="dropdown-item {{app()->getLocale() == config('constant.language.chinese')  ? 'active' : ''}}"><i class="sl-flag flag-de"> <div id="chinese"></div></i><span class=" ml-1" >中国人</span></a>
          <div class="dropdown-divider"></div>
           <a class="dropdown-item {{app()->getLocale() == config('constant.language.english')  ? 'active' : ''}} " href="{{route('update-language',config('constant.language.english'))}}"><i class="sl-flag flag-usa"> <div id="english"></div></i><span class="ml-1">English</span></a>
         
        </div>
       
      
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </div>
</nav>