<div class="card-body">

    <div class="row">
        <div class="form-group {{ $errors->has('image_en') ? 'has-error' : '' }} col-md-6">
            <label for="profileImageEn">{{trans("cruds.advertisement.fields.image")}}  ({{trans("cruds.lang.english")}}) {!! !isset($advertisement) ? '<span class="text-danger">*</span>' : '' !!} <small> {{trans("cruds.global.allowed_file_type")}}</small></label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="image_en"  id="profileImageEn" accept="image/png, image/jpg, image/jpeg, image/PNG, image/JPG, image/JPEG">
                    <label class="custom-file-label" for="profileImageEn">{{trans("cruds.global.choose_file")}}</label>
                </div>
            </div>
            @if ($errors->has('image_en'))
                <span class="text-danger">{{ $errors->first('image_en') }}</span>
            @endif
            @php 
                if(isset($advertisement->image_en) && !empty($advertisement->image_en)){
                    $imagePathEn = asset('storage/'. $advertisement->image_en );
                    $displayEn = "block";
                } else {
                    $imagePathEn = null;
                    $displayEn = "none";
                }
            @endphp
            <a href="{{$imagePathEn}}" data-toggle="lightbox" id="lightBox">
                <img class="profile-user-img img-fluid" src="{{$imagePathEn}}" alt="Image" id="preview2" style="display:{{$displayEn}}">
            </a>
        </div> 

        <div class="form-group {{ $errors->has('image_ch') ? 'has-error' : '' }} col-md-6">

            <label for="profileImageCh">{{trans("cruds.advertisement.fields.image")}}  ({{trans("cruds.lang.chinese")}})  {!! !isset($advertisement) ? '<span class="text-danger">*</span>' : '' !!} <small> {{trans("cruds.global.allowed_file_type")}}</small></label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="image_ch"  id="profileImageCh" accept="image/png, image/jpg, image/jpeg, image/PNG, image/JPG, image/JPEG">
                    <label class="custom-file-label" for="profileImageCh">{{trans("cruds.global.choose_file")}}</label>
                </div>
            </div>
            @if ($errors->has('image_ch'))
                <span class="text-danger">{{ $errors->first('image_ch') }}</span>
            @endif
            @php 
                if(isset($advertisement->image_ch) && !empty($advertisement->image_ch)){
                    $imagePathch = asset('storage/'. $advertisement->image_ch);
                    $displaych = "block";
                } else {
                    $imagePathch = null;
                    $displaych = "none";
                }
            @endphp
            <a href="{{$imagePathch}}" data-toggle="lightbox" id="lightBox">
                <img class="profile-user-img img-fluid" src="{{$imagePathch}}" alt="Image" id="preview1" style="display:{{$displaych}}">
            </a>
        </div> 
        
        <div class="form-group {{ $errors->has('url') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.advertisement.fields.url")}} </label>
            <input type="url"   name="url" value="{{ old('url', isset($advertisement->url) ? $advertisement->url : '') }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{trans("cruds.advertisement.fields.url")}}">
            @if ($errors->has('url'))
                <span class="text-danger">{{ $errors->first('url') }}</span>
            @endif
        </div> 
        @php $currentLocale = app()->getLocale(); @endphp
        <div class="form-group {{ $errors->has('advertisement_type') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.advertisement.fields.advertisement_type")}} <span class="text-danger" >*</span></label>
            <select class="form-control" name="advertisement_type" id="advertisement_type">
                @foreach (config("constant.advertisementType") as $key => $value)
                    <option value="{{$key}}" {{isset($advertisement) ? $advertisement->advertisement_type ==  $key  ?  'selected' : '' : ''}}>{{$value[$currentLocale]}}</option>
                @endforeach
            </select>
            @if ($errors->has('advertisement_type'))
                <span class="text-danger">{{ $errors->first('advertisement_type') }}</span>
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