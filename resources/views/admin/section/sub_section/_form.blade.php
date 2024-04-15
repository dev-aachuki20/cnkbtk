<div class="card-body">

    <div class="row">

        <div class="form-group {{ $errors->has('name_en') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.section_management.sub_section.fields.title")}} <small>({{trans("cruds.lang.english")}})</small> <span class="required">*</span></label>
            <input type="text" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');"   name="name_en" value="{{ old('name_en', isset($section->name_en) ? $section->name_en : '') }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{trans("cruds.section_management.sub_section.fields.title")}}">
            @if ($errors->has('name_en'))
                <span class="text-danger">{{ $errors->first('name_en') }}</span>
            @endif
        </div> 

        <div class="form-group {{ $errors->has('name_ch') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.section_management.sub_section.fields.title")}} <small>({{trans("cruds.lang.chinese")}})</small> <span class="required">*</span></label>
            <input type="text"    name="name_ch" value="{{ old('name_ch', isset($section->name_ch) ? $section->name_ch : '') }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{trans("cruds.section_management.sub_section.fields.title")}}">
            @if ($errors->has('name_ch'))
                <span class="text-danger">{{ $errors->first('name_ch') }}</span>
            @endif
        </div> 


        <div class="form-group {{ $errors->has('description_en') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.section_management.sub_section.fields.description")}} <small>({{trans("cruds.lang.english")}})</small> <span class="required">*</span></label>
            <textarea class="form-control"  name="description_en" placeholder="{{trans("cruds.global.enter")}} {{trans("cruds.section_management.sub_section.fields.description")}} " id="description_en" >{{old('description_en', isset($section->description_en) ? $section->description_en : '')}}</textarea>
            @if ($errors->has('description_en'))
                <span class="text-danger">{{ $errors->first('description_en') }}</span>
            @endif
        </div> 

        <div class="form-group {{ $errors->has('description_ch') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.section_management.sub_section.fields.description")}} <small>({{trans("cruds.lang.chinese")}})</small> <span class="required">*</span></label>
            <textarea class="form-control"  name="description_ch" placeholder="{{trans("cruds.global.enter")}} {{trans("cruds.section_management.sub_section.fields.description")}} " id="description_ch" >{{old('description_ch', isset($section->description_ch) ? $section->description_ch : '')}}</textarea>
            @if ($errors->has('description_ch'))
                <span class="text-danger">{{ $errors->first('description_ch') }}</span>
            @endif
        </div>


         <div class="form-group {{ $errors->has('section_logo') ? 'has-error' : '' }} col-md-6">
            <label for="profileImage">{{trans("cruds.section_management.sub_section.fields.section_logo")}} <small>({{trans("cruds.global.allowed_file_type_png")}})</small></label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="section_logo"  id="profileImage" accept="image/png, image/jpg, image/jpeg, image/PNG, image/JPG, image/JPEG">
                    <label class="custom-file-label" for="profileImage">{{trans("cruds.global.choose_file")}}</label>
                </div>
            </div>
            @if ($errors->has('section_logo'))
                <span class="text-danger">{{ $errors->first('section_logo') }}</span>
            @endif
            @php 
                if(isset($section->uploads) && !empty($section->uploads) && count($section->uploads) > 0){
                    $imagePath = asset('storage/'. $section->uploads->first()->path );
                    $display = "block";
                } else {
                    $imagePath = null;
                    $display = "none";
                }
            @endphp

            {{-- <a href="{{$imagePath}}" data-toggle="lightbox" id="lightBox"> --}}
                <img class="profile-user-img img-fluid" src="{{$imagePath}}" alt="User profile picture" id="preview" style="display:{{$display}}">
            {{-- </a> --}}
        </div> 

        <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.section_management.sub_section.fields.parent_section")}} <span class="text-danger" >*</span></label>
            <select class="form-control" name="parent_id">
                @forelse($parentSections as $parentSection)
                <option value="{{$parentSection->id}}"  {{ old('parent_id', isset($section->parent_id) ? $section->parent_id : '')  ==  $parentSection->id ? 'selected' : ''}}>{{$parentSection->name}}</option>
                @empty
                <option value="">--Select--</option>
                @endforelse
            </select>
            @if ($errors->has('parent_id'))
                <span class="text-danger">{{ $errors->first('parent_id') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('creator_can_post') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.section_management.sub_section.fields.creator_can_post")}} <span class="text-danger" >*</span></label>
            <select class="form-control" name="creator_can_post">
                <option value="{{config("constant.creatorCanPost.yes")}}" {{isset($section) ? $section->creator_can_post == config("constant.creatorCanPost.yes")  ?  'selected' : '' : ''}}>{{trans("cruds.global.yes")}}</option>
                <option value="{{config("constant.creatorCanPost.no")}}" {{isset($section) ? $section->creator_can_post == config("constant.creatorCanPost.no")  ?  'selected' : '' : ''}}>{{trans("cruds.global.no")}}</option>
            </select>
            @if ($errors->has('creator_can_post'))
                <span class="text-danger">{{ $errors->first('creator_can_post') }}</span>
            @endif
        </div>  

         <div class="form-group {{ $errors->has('user_can_post') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.section_management.sub_section.fields.user_can_post")}} <span class="text-danger" >*</span></label>
            <select class="form-control" name="user_can_post">
                <option value="{{config("constant.userCanPost.yes")}}" {{isset($section) ? $section->user_can_post == config("constant.userCanPost.yes")  ?  'selected' : '' : ''}}>{{trans("cruds.global.yes")}}</option>
                <option value="{{config("constant.userCanPost.no")}}" {{isset($section) ? $section->user_can_post == config("constant.userCanPost.no")  ?  'selected' : '' : ''}}>{{trans("cruds.global.no")}}</option>
            </select>
            @if ($errors->has('user_can_post'))
                <span class="text-danger">{{ $errors->first('user_can_post') }}</span>
            @endif
        </div>
        
        <div class="form-group {{ $errors->has('show_in_header') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.section_management.sub_section.fields.show_in_header")}} <span class="text-danger" >*</span></label>
            <select class="form-control" name="show_in_header">
                <option value="{{config("constant.option.yes")}}" {{isset($section) ? $section->show_in_header == config("constant.option.yes")  ?  'selected' : '' : ''}}>{{trans("cruds.global.yes")}}</option>
                <option value="{{config("constant.option.no")}}" {{isset($section) ? $section->show_in_header == config("constant.option.no")  ?  'selected' : '' : ''}}>{{trans("cruds.global.no")}}</option>
            </select>
            @if ($errors->has('show_in_header'))
                <span class="text-danger">{{ $errors->first('show_in_header') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('show_in_footer') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.section_management.sub_section.fields.show_in_footer")}} <span class="text-danger" >*</span></label>
            <select class="form-control" name="show_in_footer">
                <option value="{{config("constant.option.yes")}}" {{isset($section) ? $section->show_in_footer == config("constant.option.yes")  ?  'selected' : '' : ''}}>{{trans("cruds.global.yes")}}</option>
                <option value="{{config("constant.option.no")}}" {{isset($section) ? $section->show_in_footer == config("constant.option.no")  ?  'selected' : '' : ''}}>{{trans("cruds.global.no")}}</option>
            </select>
            @if ($errors->has('show_in_footer'))
                <span class="text-danger">{{ $errors->first('show_in_footer') }}</span>
            @endif
        </div>
        

        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.global.status")}} <span class="text-danger" >*</span></label>
            <select class="form-control" name="status">
                <option value="1" {{isset($section) ? $section->status == 1  ?  'selected' : '' : ''}}>{{trans("cruds.global.active")}}</option>
                <option value="0" {{isset($section) ? $section->status == 0  ?  'selected' : '' : ''}}>{{trans("cruds.global.in_active")}}</option>
            </select>
            @if ($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
            @endif
        </div>     
    </div>

</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{isset($section) ? trans("cruds.global.update") : trans("cruds.global.save") }}</button>
</div>