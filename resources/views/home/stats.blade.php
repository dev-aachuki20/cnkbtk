        <!-- chart-wrapper  -->
        <section class="chart-wrapper">
            <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                <div class="current-day chart-innerbox">
                    <div class="chart-icon">
                    <img src="{{asset('front/asset/images/calendar.svg')}}" alt="" />
                    </div>
                    <div class="chart-title">
                    <h3>{{trans('pages.home.stats.today')}}: <span>{{$todayVisitor}}</span></h3>
                    </div>
                </div>
                </div>
                <div class="col-md-3 col-sm-6">
                <div class="last-day chart-innerbox">
                    <div class="chart-icon">
                    <img src="{{asset('front/asset/images/calendar-2.svg')}}" alt="" />
                    </div>
                    <div class="chart-title">
                    <h3>{{trans('pages.home.stats.yesterday')}}: <span>{{$yesterdayVisitor}}</span></h3>
                    </div>
                </div>
                </div>
                <div class="col-md-3 col-sm-6">
                <div class="save-day chart-innerbox">
                    <div class="chart-icon">
                    <img src="{{asset('front/asset/images/document.svg')}}" alt="" />
                    </div>
                    <div class="chart-title">
                    <h3>{{trans('pages.home.stats.posts')}}: <span>{{$posterCount}}</span></h3>
                    </div>
                </div>
                </div>
                <div class="col-md-3 col-sm-6">
                <div class="members-day chart-innerbox">
                    <div class="chart-icon">
                    <img src="{{asset('front/asset/images/friends.svg')}}" alt="" />
                    </div>
                    <div class="chart-title">
                    <h3>{{trans('pages.home.stats.members')}}: <span>{{$members}}</span></h3>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </section>
        <!-- end  -->