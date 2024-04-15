                            <div class="tab-pane tab-pane-box fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                <div class="cp-title">
                                    <h2>
                                        {{trans("pages.user.change_password_tab.change_password")}}
                                    </h2>
                                </div>
                                <div class="edit-profile mt-3">
                                    <form  method="post" id="changePasswordForm"> 
                                        @csrf()
                                        <div class="row gutters">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                                <div class="form-group">
                                                    <label for="old_password">{{trans("pages.user.change_password_tab.old_password")}}<span class="mailstar"  style="color: red;">*</span></label>
                                                    <div class="input-password-wrap">
                                                        <input type="password" value="{{old('old_password')}}" placeholder="{{trans("global.enter")}} {{trans("pages.user.change_password_tab.old_password")}}" class="form-control" id="old_password" name="old_password">
                                                        <i class="fa fa-eye-slash toggle-password" id="togglePassword"   style="margin-left: -30px; cursor: pointer;"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                                                <div class="form-group">
                                                    <label for="password">{{trans("pages.user.change_password_tab.new_password")}}<span class="mailstar" style="color: red;">*</span></label>
                                                    <div class="input-password-wrap">
                                                        <input type="password" value="{{old('password')}}" placeholder="{{trans("global.enter")}} {{trans("pages.user.change_password_tab.new_password")}}"  class="form-control" id="password"  name="password">
                                                        <i class="fa fa-eye-slash toggle-password" id="togglePassword2"   style="margin-left: -30px; cursor: pointer;"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                                                <div class="form-group">
                                                    <label for="password_confirmation">{{trans("pages.user.change_password_tab.confirm_password")}}<span class="mailstar" style="color: red;">*</span></label>
                                                    <div class="input-password-wrap">
                                                        <input type="password" value="{{old('password_confirmation')}}" placeholder="{{trans("global.enter")}} {{trans("pages.user.change_password_tab.confirm_password")}}"  class="form-control" id="password_confirmation"  name="password_confirmation">
                                                        <i class="fa fa-eye-slash toggle-password" id="togglePassword3" style="margin-left: -30px; cursor: pointer;"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gutters mt-3">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="text-right profile-update-wrap">
                                                    <button type="submit" id="submit" name="submit" class="btn submitBtn save-btn">{{trans("global.update")}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>