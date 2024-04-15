                        <div class="popular-tag profile-wrap">
                            <div class="inner-popular">
                                <div class="title">
                                    <h4>{{trans("global.set_up")}}</h4>
                                </div>
                                <div class="tag-listing">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link filter-tabs active" id="home-tab" data-bs-toggle="tab"
                                                data-bs-target="#home-tab-pane" type="button" role="tab"
                                                aria-controls="home-tab-pane" aria-selected="true" data-filter=".profile">{{trans("global.profile")}}</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link filter-tabs" id="contact-tab" data-bs-toggle="tab"
                                                data-bs-target="#contact-tab-pane" type="button" role="tab"
                                                aria-controls="contact-tab-pane" aria-selected="false" data-filter=".basic-information">{{trans("global.basic_information")}}</button>
                                        </li>

                                        
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link filter-tabs" id="profile-tab" data-bs-toggle="tab"
                                                data-bs-target="#profile-tab-pane" type="button" role="tab"
                                                aria-controls="profile-tab-pane" aria-selected="false" data-filter=".change-password">{{trans("global.change_password")}}</button>
                                        </li>
                                        @if(auth()->user()->role_id != config("constant.role.admin"))
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link filter-tabs" id="create-history-tab" data-bs-toggle="tab"
                                            data-bs-target="#create-history" type="button" role="tab"
                                            aria-controls="create-history" aria-selected="false" data-filter=".create-history">{{trans("global.credit_history")}}</button>
                                        </li>
                                        @endif
                                        
                                        

                                        <li class="nav-item" role="presentation">
                                            <a href="{{route('post.create')}}" class="nav-link filter-tabs" aria-selected="false" tabindex="-1" role="tab">
                                               {{trans("global.create_post")}}
                                            </a>
                                        </li>
                                        
                                        <li class="nav-item" role="presentation">
                                            <a href="{{route('post.index')}}" class="nav-link filter-tabs" aria-selected="false" tabindex="-1" role="tab">
                                                {{trans("global.post_history")}}
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>