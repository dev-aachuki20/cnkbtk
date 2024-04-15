                        <div class="profile-inner">
                            <div class="avatar-icon">
                                @php 
                                    $imagePath = asset('front/asset/images/user.png');
                                    if(isset(auth()->user()->uploads) && !empty(auth()->user()->uploads) && count(auth()->user()->uploads) > 0){
                                        $imagePath = asset('storage/'.auth()->user()->uploads->first()->path );
                                    } 
                                    
                                @endphp
                                <img src="{{$imagePath}}" alt="">
                            </div>
                            <div class="avatar-title">
                                <h2>
                                {{auth()->user()->user_name}}
                                </h2>
                            </div>
                            <div class="post-count-list d-flex align-items-center justify-content-center">
                                <div class="post-count">{{trans("global.post")}}<span class="count-number">{{auth()->user()->postCount()}}</span></div>
                                <div class="post-count integral-count">{{trans("global.points")}}<span class="count-number">{{ getCurrentAvailablePoint() }}</span></div>
                            </div>
                        </div>