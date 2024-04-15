
<!-- footer  -->

<footer class="footer-section">

    <div class="container">

      <div class="footer-content pt-5 pb-5">

        <div class="row">

          <div class="col-xl-4 col-lg-4 mb-50">

            <div class="footer-widget">

              <div class="footer-logo">

                <a href="{{route('home')}}"><img src="{{ asset('storage/'.$siteSettingData['logo']) }}" class="img-fluid footer-logo" alt="logo" /></a>

              </div>

              <div class="footer-text">

                <p>{{ app()->getLocale() == "en" ? $siteSettingData['english_content'] : $siteSettingData['chinese_content'] }}</p>

              </div>
            </div>
          </div>

          <div class="col-xl-4 col-lg-4 col-md-6 mb-30">

            <div class="footer-widget">

              <div class="footer-widget-heading">

                <h3>{{trans("global.useful_links")}}</h3>

              </div>

              <ul>

                <li><a href="{{route('home')}}">{{ \App::getLocale() == "en"  ? "forum" :  "论坛"}}</a></li>

                <li><a href="{{route('site-statistics')}}">{{ \App::getLocale() == "en"  ? "site statistics" :  "网站统计"}}</a></li>

                <li>
                  <a class="nav-link  {{Request::is('user/self-top-up') ? 'active' : ''}}  self-top-up" href="{{auth()->check() ?  route('user.self-top-up') : 'javacript:void(0)'}}">{{trans("global.self_service")}}</a>
                @if(isset($menues))
                  @php  $footerMenus  =  $menues->where("show_in_footer",1);  @endphp
                  @forelse($footerMenus as $footerMenu)
                  <li class="nav-item">
                    <a class="nav-link {{Request::is(".$footerMenu->slug.") ? 'active' : ''}}" href="{{route("section.page",[$footerMenu->level,$footerMenu->slug])}}">{{$footerMenu->name}}</a>
                  </li>
                  @empty
                  @endforelse
                @endif
                
              </ul>

            </div>

          </div>

          <div class="col-xl-4 col-lg-4 col-md-6 mb-50">

            <div class="footer-widget">

              <div class="footer-widget-heading">

                <h3>{{trans("global.follow_us")}}</h3>

              </div>

              <div class="footer-social-icon">

                <a href="{{$siteSettingData['facebook_url']}}"><i class="fa fa-facebook facebook-bg" aria-hidden="true" title="facebook"></i></a>

                <a href="{{$siteSettingData['linkedin_url']}}"><i class="fa fa-linkedin  linkedin-bg" aria-hidden="true" title="linkedin"></i></a>

                <a href="{{$siteSettingData['instagram_url']}}"><i class="fa fa-instagram instagram-bg" aria-hidden="true" title="instagram"></i></a>

                <a href="{{$siteSettingData['youtube_url']}}"><i class="fa fa-youtube  youtube-bg" aria-hidden="true" title="youtube"></i></a>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

    <div class="copyright-area">

      <div class="container">

        <div class="row">

          <div class="col-xl-6 col-lg-6 text-center text-lg-left">

            <div class="copyright-text">

              <p>{{ app()->getLocale() == "en" ? $siteSettingData['english_disclaimer']  : $siteSettingData['chinese_disclaimer']  }}</p>

            </div>

          </div>

          <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">

            <div class="footer-menu">

              <ul>

                <li><a href="{{route('terms-condition')}}">{{ \App::getLocale() == "en"  ? "Terms & Conditions" :  "条款及条件"}}</a></li>

                <li><a href="{{route('privacy-policy')}}">{{ \App::getLocale() == "en"  ? "Privacy & Policy" :  "隐私政策"}}</a></li>

              </ul>

            </div>

          </div>

        </div>

      </div>

    </div>

  </footer>



<!-- end footer  -->