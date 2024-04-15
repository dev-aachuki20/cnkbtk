                            <div class="tab-pane tab-pane-box fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                <div class="cp-title">
                                    <h2>{{trans("pages.user.profile_tab.profile")}}</h2>
                                </div>

                                <div class="avatar-main-cp">
                                    <div class="avtaricon">
                                        @php 
                                            $imagePath = asset('front/asset/images/user.png');
                                            if(isset(auth()->user()->uploads) && !empty(auth()->user()->uploads) && count(auth()->user()->uploads) > 0){
                                                $imagePath = asset('storage/'.auth()->user()->uploads->first()->path );
                                            } 
                                            
                                        @endphp
                                        <img src="{{$imagePath}}" class="img-fluid user-profile-image"  alt="profile-image" id="profileImage">
                                    </div>
                                    <div class="title-avt">
                                        <h2>{{ucfirst(auth()->user()->user_name)}}</h2>
                                        <span>{{auth()->user()->user_about ?? "User Has not write anything yet!"}} </span>
                                    </div>
                                </div>

                                <div class="edit-profile mt-3">
                                    <form action="{{route('user.profile.update')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-4">
                                                    <label for="user_name">{{trans("pages.user.profile_tab.form.field.user_name")}}<span class="mailstar" style="color: red;">*</span></label>
                                                    <input type="text" value="{{auth()->user()->user_name}}" placeholder="{{trans("global.enter")}} {{trans("pages.user.profile_tab.form.field.user_name")}}" class="form-control" id="user_name" name="user_name">
                                                    @if ($errors->has('user_name'))
                                                        <span class="text-danger">{{ $errors->first('user_name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-6">
                                                <div class="form-group mb-4">
                                                    <label for="loginEmail">{{trans("pages.user.profile_tab.form.field.email_address")}}<span class="mailstar"
                                                            style="color: red;">*</span></label>
                                                    <input type="email" value="{{auth()->user()->email}}" placeholder="{{trans("global.enter")}} {{trans("pages.user.profile_tab.form.field.email_address")}}"
                                                        class="form-control" id="loginEmail" name="loginEmail" disabled>
                                                </div>
                                            </div>
                                           
                                           <div class="col-md-12">
                                            <div class="form-group mb-4">
                                                    <label for="file">{{trans("pages.user.profile_tab.form.field.profile_image")}}   <small>({{trans("cruds.global.allowed_file_type")}})</small></label>
                                                    <div class='file-input' id="file-input">
                                                        <input type='file' name="image" id="image" accept="image/png, image/jpg, image/jpeg, image/PNG, image/JPG, image/JPEG" >
                                                        <span class='label' data-js-label>No file selected</span>
                                                        <span class='button'>{{trans("cruds.global.choose_file")}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-12 col-md-12">
                                                <div class="form-group mb-4">
                                                    <label for="user_about">{{trans("pages.user.profile_tab.form.field.about_your_self")}} </label>
                                                    <textarea class="form-control" rows="5" placeholder="{{trans("pages.user.profile_tab.form.field.about_your_self")}} " id="user_about"  name="user_about">{{auth()->user()->user_about}}</textarea>

                                                    @if ($errors->has('user_about'))
                                                        <span class="text-danger">{{ $errors->first('user_about') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="submitBtn btn">{{trans("global.update")}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>