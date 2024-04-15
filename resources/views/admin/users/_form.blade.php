<div class="card-body">

    <div class="row">

        <div class="form-group {{ $errors->has('user_name') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.user.fields.user_name")}} <span class="required">*</span></label>

            <input type="text" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '').replace(/(\..*)\./g, '$1');"   name="user_name" value="{{ old('user_name', isset($user->user_name) ? $user->user_name : '') }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{trans("cruds.user.fields.user_name")}} *">

            @if ($errors->has('user_name'))

                <span class="text-danger">{{ $errors->first('user_name') }}</span>

            @endif

        </div> 



        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} col-md-6">

            <label>{{trans("cruds.user.fields.email")}} <span class="required">*</span></label>

            <input type="email" name="email" value="{{ old('email', isset($user->email) ? $user->email : '') }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{trans("cruds.user.fields.email")}} * ">

            @if ($errors->has('email'))

                <span class="text-danger">{{ $errors->first('email') }}</span>

            @endif

        </div> 



        <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }} col-md-6">

            <label for="profileImage">{{trans("cruds.user.fields.profile_image")}} <small>{{trans('cruds.global.allowed_file_type')}}</small></label>

            <div class="input-group">

                <div class="custom-file">

                    <input type="file" class="custom-file-input" name="image"  id="profileImage" accept="image/png, image/jpg, image/jpeg, image/PNG, image/JPG, image/JPEG">
                    <label class="custom-file-label" for="profileImage">{{trans("cruds.global.choose_file")}}</label>

                </div>

            </div>



            @if ($errors->has('image'))

                <span class="text-danger">{{ $errors->first('image') }}</span>

            @endif

            

            @php 

                                        

                if(isset($user->uploads) && !empty($user->uploads) && count($user->uploads) > 0){
                    $imagePath = asset('storage/'. $user->uploads->first()->path );
                    $display = "block";
                } else {
                    $imagePath = null;
                    $display = "none";
                }

                

            @endphp

            <a href="{{$imagePath}}" data-toggle="lightbox" id="lightBox">

                <img class="profile-user-img img-fluid" src="{{$imagePath}}" alt="User profile picture" id="preview" style="display:{{$display}}">

            </a>

            

        </div> 



        <div class="form-group {{ $errors->has('role_id') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.user.fields.role")}} <span class="text-danger" >*</span></label>
            <select class="form-control" name="role_id">
                <option value="2" {{isset($user) ? $user->role_id == config("constant.role.creator")  ?  'selected' : '' : ''}}>{{trans("global.role.creator")}}</option>
                <option value="3" {{isset($user) ? $user->role_id == config("constant.role.user")  ?  'selected' : '' : ''}}>{{trans("global.role.user")}}</option>
            </select>

            @if ($errors->has('role_id'))
                <span class="text-danger">{{ $errors->first('role_id') }}</span>
            @endif

        </div>  



        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} col-md-6">

            <label>{{trans("cruds.global.status")}} <span class="text-danger" >*</span></label>

            <select class="form-control" name="status">

                <option value="1" {{isset($user) ? $user->status == 1  ?  'selected' : '' : ''}}>{{trans("cruds.global.active")}}</option>

                <option value="0" {{isset($user) ? $user->status == 0  ?  'selected' : '' : ''}}>{{trans("cruds.global.in_active")}}</option>

            </select>

            @if ($errors->has('status'))

                <span class="text-danger">{{ $errors->first('status') }}</span>

            @endif

        </div>     

    </div>

</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{isset($user) ? trans("cruds.global.update") : trans("cruds.global.save")}}</button>
</div>