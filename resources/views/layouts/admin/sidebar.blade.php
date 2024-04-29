<aside class="main-sidebar sidebar-dark-primary elevation-4">
  @php
  $siteSettingData = getSiteSetting();
  @endphp
  <!-- Brand Logo -->
  {{-- <a href="" class="brand-link"> --}}
  {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
  @if(!is_null($siteSettingData['logo']))

  <span class="brand-link brand-text font-weight-light text-center">
    <a href="{{route('home')}}">
      <img src="{{ asset('storage/'. $siteSettingData['logo']) }}" class="img-fluid logoadmin dashboard-logo" alt="login">
    </a>
  </span>
  @endif
  {{-- </a> --}}

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            @php
                if(isset(auth()->user()->uploads->first()->path) && auth()->user()->uploads->first()->path != null && Storage::disk('public')->exists(auth()->user()->uploads->first()->path)){
                $profileImage = asset('storage/'.auth()->user()->uploads->first()->path);
                }else{
                    $profileImage = asset('admins/dist/img/user2-160x160.jpg');
                }
            @endphp
          <img src="{{$profileImage}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:void();" class="d-block">{{auth::user()->name}}</a>
        </div>
      </div> -->

    <!-- Sidebar Menu -->
    <nav class="mt-4">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('admin.dashboard')}}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-dashboard" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">

              <path d="M4 4h6v8h-6z" />
              <path d="M4 16h6v4h-6z" />
              <path d="M14 12h6v8h-6z" />
              <path d="M14 4h6v4h-6z" />
            </svg>
            <p>{{trans("global.dashboard")}}</p>
          </a>
        </li>


        <li class="nav-item">
          <a href="{{ route('admin.email-templates.index')}}" class="nav-link {{ request()->is('admin/email-templates') || request()->is('admin/email-templates/*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-forward" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">

              <path d="M12 18h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5" />
              <path d="M3 6l9 6l9 -6" />
              <path d="M15 18h6" />
              <path d="M18 15l3 3l-3 3" />
            </svg>
            <p>{{trans("cruds.email_template.title")}}</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('admin.users.index')}}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">

              <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
              <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
              <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
            </svg>
            <p> {{trans("cruds.user.title")}}</p>
          </a>
        </li>

        {{-- <li class="nav-item">
            <a href="{{ route('admin.contactusEnquiry')}}" class="nav-link {{ request()->is('admin/contact-us-enquiry') || request()->is('admin/enquiry-show/*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-2-question" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">

          <path d="M8 9h8" />
          <path d="M8 13h6" />
          <path d="M14.5 18.5l-2.5 2.5l-3 -3h-3a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5" />
          <path d="M19 22v.01" />
          <path d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" />
        </svg>
        <p> Contact Us Enquiries</p>
        </a>
        </li>

        <li class="nav-item {{ request()->is('admin/pages') || request()->is('admin/pages/*') ? 'menu-open' : '' }}">
          <a href="javascript:void();" class="nav-link {{ request()->is('admin/pages') || request()->is('admin/pages/*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-text" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">

              <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
              <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
              <path d="M9 12h6" />
              <path d="M9 16h6" />
            </svg>
            <p>
              Pages
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.page.editPage','about_us')}}" class="nav-link {{ request()->is('admin/pages/about_us') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>About Us</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.page.editPage','term_condition')}}" class="nav-link {{ request()->is('admin/pages/term_condition') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Terms & Conditions</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.page.editPage','privacy_policy')}}" class="nav-link {{ request()->is('admin/pages/privacy_policy') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Privacy Policy</p>
              </a>
            </li>
          </ul>
        </li> --}}

        <li class="nav-item">
          <a href="{{ route('admin.settings.create')}}" class="nav-link {{ request()->is('admin/take-tour') || request()->is('admin/take-tour/*') || request()->is('admin/settings') || request()->is('admin/settings/*') || request()->is('admin/featured-filter') || request()->is('admin/featured-filter/*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings-cog" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">

              <path d="M12.003 21c-.732 .001 -1.465 -.438 -1.678 -1.317a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c.886 .215 1.325 .957 1.318 1.694" />
              <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
              <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
              <path d="M19.001 15.5v1.5" />
              <path d="M19.001 21v1.5" />
              <path d="M22.032 17.25l-1.299 .75" />
              <path d="M17.27 20l-1.3 .75" />
              <path d="M15.97 17.25l1.3 .75" />
              <path d="M20.733 20l1.3 .75" />
            </svg>
            <p>{{trans("cruds.setting.title")}}</p>
          </a>
        </li>

        <li class="nav-item {{ request()->is('admin/section') ||  request()->is('admin/section*') ? 'menu-open' : '' }}">
          <a href="javascript:void(0)" class="nav-link {{ request()->is('admin/section') ||  request()->is('admin/section*') ? 'active' : '' }}">
            <svg width="45" height="45" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="6" y="28" width="36" height="14" rx="4" stroke="#333" stroke-width="1" />
              <path d="M20 7H10C7.79086 7 6 8.79086 6 11V17C6 19.2091 7.79086 21 10 21H20" stroke="#333" stroke-width="1" stroke-linecap="round" />
              <circle cx="34" cy="14" r="8" fill="none" stroke="#333" stroke-width="1" />
              <circle class="fill-ch" cx="34" cy="14" r="3" fill="#333" />
            </svg>
            <p> {{trans("cruds.section_management.title_singular")}}</p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admin.parent-section.index')}}" class="nav-link {{ request()->is('admin/section/parent-section') || request()->is('admin/section/parent-section*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>{{trans("cruds.section_management.parent_section.title")}}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.sub-section.index')}}" class="nav-link {{ request()->is('admin/section/sub-section') || request()->is('admin/section/sub-section*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>{{trans("cruds.section_management.sub_section.title")}}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.child-section.index')}}" class="nav-link {{ request()->is('admin/section/child-section') || request()->is('admin/section/child-section*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>{{trans("cruds.section_management.child_section.title")}}</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item {{ request()->is('admin/tag') ||  request()->is('admin/tag*') ? 'menu-open' : '' }}">
          <a href="javascript:void(0)" class="nav-link {{ request()->is('admin/tag') ||  request()->is('admin/tag*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
              <path d="M21.68,9.108L13.204,.723C12.655,.173,11.869-.089,11.098,.013L4.209,.955c-.274,.038-.466,.29-.428,.563,.037,.273,.293,.461,.562,.428l6.889-.942c.46-.066,.934,.095,1.267,.427l8.476,8.385c1.356,1.356,1.363,3.569,.01,4.94l-.19,.199c-.209-.677-.58-1.314-1.114-1.848L11.204,4.723c-.549-.55-1.337-.812-2.106-.709l-6.889,.942c-.228,.031-.404,.213-.43,.44l-.765,6.916c-.083,.759,.179,1.503,.72,2.044l8.417,8.326c.85,.85,1.979,1.318,3.181,1.318h.014c1.208-.004,2.341-.479,3.189-1.339l3.167-3.208c.886-.898,1.317-2.081,1.292-3.257l.708-.743c1.732-1.754,1.724-4.6-.022-6.345Zm-2.688,9.643l-3.167,3.208c-.66,.669-1.542,1.039-2.481,1.042h-.011c-.935,0-1.812-.364-2.476-1.027L2.439,13.646c-.324-.324-.48-.77-.431-1.225l.722-6.528,6.502-.889c.462-.063,.934,.095,1.267,.427l8.476,8.385c1.356,1.356,1.363,3.569,.017,4.934ZM8,10c0,.552-.448,1-1,1s-1-.448-1-1,.448-1,1-1,1,.448,1,1Z" />
            </svg>
            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tags" viewBox="0 0 16 16"> <path d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z"/> <path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z"/> </svg> -->
            <p> {{trans("cruds.tag_management.title_singular")}}</p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admin.tag-type.index')}}" class="nav-link {{ request()->is('admin/tags/tag-type') || request()->is('admin/tags/tag-type*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>{{trans("cruds.tag_management.tag_type.title")}}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.tag.index')}}" class="nav-link {{ request()->is('admin/tags/tag') || request()->is('admin/tags/tag/*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>{{trans("cruds.tag_management.tag.title")}}</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="{{route('admin.advertisement.index')}}" class="nav-link {{ request()->is('admin/advertisement') || request()->is('admin/advertisement/*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
              <path d="M19.5,2H4.5C2.019,2,0,4.019,0,6.5v11c0,2.481,2.019,4.5,4.5,4.5h15c2.481,0,4.5-2.019,4.5-4.5V6.5c0-2.481-2.019-4.5-4.5-4.5Zm3.5,15.5c0,1.93-1.57,3.5-3.5,3.5H4.5c-1.93,0-3.5-1.57-3.5-3.5V6.5c0-1.93,1.57-3.5,3.5-3.5h15c1.93,0,3.5,1.57,3.5,3.5v11Zm-3.5-11.5c-.276,0-.5,.224-.5,.5v5.553c-.636-.65-1.522-1.053-2.5-1.053-1.93,0-3.5,1.57-3.5,3.5s1.57,3.5,3.5,3.5c.978,0,1.864-.404,2.5-1.053v.553c0,.276,.224,.5,.5,.5s.5-.224,.5-.5V6.5c0-.276-.224-.5-.5-.5Zm-3,11c-1.378,0-2.5-1.122-2.5-2.5s1.122-2.5,2.5-2.5,2.5,1.122,2.5,2.5-1.122,2.5-2.5,2.5ZM8.477,6.349c-.132-.415-.821-.415-.953,0l-3.5,11c-.083,.263,.062,.544,.325,.628,.263,.085,.543-.062,.628-.325l.525-1.651h4.996l.525,1.651c.068,.213,.265,.349,.477,.349,.05,0,.101-.007,.151-.023,.263-.084,.409-.365,.325-.628l-3.5-11Zm-2.656,8.651l2.18-6.851,2.18,6.851H5.82Z" />
            </svg>
            <p>{{trans("cruds.advertisement.title")}}</p>
          </a>
        </li>


        <li class="nav-item">
          <a href="{{route('admin.plan.index')}}" class="nav-link {{ request()->is('admin/plan') || request()->is('admin/plan/*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
              <path d="M19.5,3h-7.03c-.23,0-.46-.05-.67-.16l-3.16-1.58c-.34-.17-.73-.26-1.12-.26h-3.03C2.02,1,0,3.02,0,5.5v13c0,2.48,2.02,4.5,4.5,4.5H12.5c.28,0,.5-.22,.5-.5s-.22-.5-.5-.5H4.5c-1.93,0-3.5-1.57-3.5-3.5V8H23v6.5c0,.28,.22,.5,.5,.5s.5-.22,.5-.5V7.5c0-2.48-2.02-4.5-4.5-4.5ZM1,5.5c0-1.93,1.57-3.5,3.5-3.5h3.03c.23,0,.46,.05,.67,.16l3.16,1.58c.34,.17,.73,.26,1.12,.26h7.03c1.76,0,3.22,1.31,3.46,3H1v-1.5Zm23,14s0,0,0,0c0,.5-.19,1-.58,1.38l-2.57,2.52c-.1,.1-.22,.14-.35,.14s-.26-.05-.36-.15c-.19-.2-.19-.51,0-.71l2.57-2.52c.06-.06,.1-.12,.14-.18H13.5c-.28,0-.5-.22-.5-.5s.22-.5,.5-.5h9.36c-.04-.07-.09-.13-.15-.19l-2.57-2.51c-.2-.19-.2-.51,0-.71,.19-.2,.51-.2,.71,0l2.57,2.52c.38,.38,.58,.89,.58,1.39,0,0,0,0,0,0Z" />
            </svg>
            <p>{{trans("cruds.plan.title")}}</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('admin.query.index')}}" class="nav-link {{ request()->is('admin/query') || request()->is('admin/query/*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
              <path d="m21.5,4h-3.5v-1.5c0-1.379-1.121-2.5-2.5-2.5H2.5C1.122,0,0,1.121,0,2.5v15.854c0,.608.333,1.166.87,1.453.245.131.512.195.779.195.319,0,.637-.093.913-.276l3.438-2.292v3.566h11.349l4.09,2.727c.275.184.594.276.913.276.267,0,.534-.064.778-.195.537-.288.87-.845.87-1.453V6.5c0-1.379-1.121-2.5-2.5-2.5ZM2.007,18.895c-.202.136-.451.147-.665.031-.214-.114-.342-.328-.342-.571V2.5c0-.827.673-1.5,1.5-1.5h13c.827,0,1.5.673,1.5,1.5v13.5H6.349l-4.341,2.895Zm20.993,3.46c0,.243-.128.457-.342.571-.217.116-.462.103-.666-.031l-4.341-2.895H7v-3h11V5h3.5c.827,0,1.5.673,1.5,1.5v15.854Zm-13-9.354c0,.552-.448,1-1,1s-1-.448-1-1,.448-1,1-1,1,.448,1,1Zm-3-7h-1c0-.889.391-1.727,1.071-2.298.681-.572,1.58-.811,2.468-.654,1.209.212,2.201,1.204,2.413,2.413.224,1.273-.381,2.547-1.506,3.168-.492.271-.947.685-.947,1.871v.5h-1v-.5c0-1.324.465-2.197,1.464-2.747.762-.42,1.156-1.252,1.003-2.119-.14-.802-.798-1.46-1.601-1.602-.603-.104-1.191.049-1.652.436-.454.381-.714.939-.714,1.532Z" />
            </svg>
            <p>{{trans("cruds.enquiries.title")}}</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('admin.report.index')}}" class="nav-link {{ request()->is('admin/report') || request()->is('admin/report/*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
              <path d="m19.5,0h-10c-2.481,0-4.5,2.019-4.5,4.5v2.5h-1c-2.206,0-4,1.794-4,4v10c0,1.654,1.346,3,3,3h16.5c2.481,0,4.5-2.019,4.5-4.5V4.5c0-2.481-2.019-4.5-4.5-4.5ZM5,21c0,1.103-.897,2-2,2s-2-.897-2-2v-10c0-1.654,1.346-3,3-3h1v13Zm18-1.5c0,1.93-1.57,3.5-3.5,3.5H5.234c.476-.531.766-1.232.766-2V4.5c0-1.93,1.57-3.5,3.5-3.5h10c1.93,0,3.5,1.57,3.5,3.5v15Zm-2-12c0,.276-.224.5-.5.5h-5c-.276,0-.5-.224-.5-.5s.224-.5.5-.5h5c.276,0,.5.224.5.5Zm0,4c0,.276-.224.5-.5.5h-12c-.276,0-.5-.224-.5-.5s.224-.5.5-.5h12c.276,0,.5.224.5.5Zm0,4c0,.276-.224.5-.5.5h-12c-.276,0-.5-.224-.5-.5s.224-.5.5-.5h12c.276,0,.5.224.5.5Zm0,4c0,.276-.224.5-.5.5h-12c-.276,0-.5-.224-.5-.5s.224-.5.5-.5h12c.276,0,.5.224.5.5Zm-11.5-11.5h2c.827,0,1.5-.673,1.5-1.5v-2c0-.827-.673-1.5-1.5-1.5h-2c-.827,0-1.5.673-1.5,1.5v2c0,.827.673,1.5,1.5,1.5Zm-.5-3.5c0-.276.224-.5.5-.5h2c.276,0,.5.224.5.5v2c0,.276-.224.5-.5.5h-2c-.276,0-.5-.224-.5-.5v-2Z" />
            </svg>
            <p>{{trans("cruds.reports.title")}}</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.blacklist-tag.index')}}" class="nav-link {{ request()->is('admin/blacklist-tag') || request()->is('admin/blacklist-tag/*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
              <path d="M21.68,9.108L13.204,.723C12.655,.173,11.869-.089,11.098,.013L4.209,.955c-.274,.038-.466,.29-.428,.563,.037,.273,.293,.461,.562,.428l6.889-.942c.46-.066,.934,.095,1.267,.427l8.476,8.385c1.356,1.356,1.363,3.569,.01,4.94l-.19,.199c-.209-.677-.58-1.314-1.114-1.848L11.204,4.723c-.549-.55-1.337-.812-2.106-.709l-6.889,.942c-.228,.031-.404,.213-.43,.44l-.765,6.916c-.083,.759,.179,1.503,.72,2.044l8.417,8.326c.85,.85,1.979,1.318,3.181,1.318h.014c1.208-.004,2.341-.479,3.189-1.339l3.167-3.208c.886-.898,1.317-2.081,1.292-3.257l.708-.743c1.732-1.754,1.724-4.6-.022-6.345Zm-2.688,9.643l-3.167,3.208c-.66,.669-1.542,1.039-2.481,1.042h-.011c-.935,0-1.812-.364-2.476-1.027L2.439,13.646c-.324-.324-.48-.77-.431-1.225l.722-6.528,6.502-.889c.462-.063,.934,.095,1.267,.427l8.476,8.385c1.356,1.356,1.363,3.569,.017,4.934ZM8,10c0,.552-.448,1-1,1s-1-.448-1-1,.448-1,1-1,1,.448,1,1Z" />
            </svg>
            <p>{{trans("cruds.blacklist_tag.title")}}</p>
          </a>
        </li>


        {{-- <li class="nav-item">
            <a href="{{route('admin.advertisement.index')}}" class="nav-link {{ request()->is('admin/advertisement') || request()->is('admin/advertisement/*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="44px" height="44px" fill="currentColor" class="bi bi-file-earmark-post" viewBox="0 0 16 16">
          <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
          <path d="M4 6.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-7zm0-3a.5.5 0 0 1 .5-.5H7a.5.5 0 0 1 0 1H4.5a.5.5 0 0 1-.5-.5z" />
        </svg>

        <p>{{trans("cruds.post_management.title")}}</p>
        </a>
        </li> --}}
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>