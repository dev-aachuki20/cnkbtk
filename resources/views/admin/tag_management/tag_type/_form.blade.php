<div class="card-body">

    <div class="row">

        <div class="form-group {{ $errors->has('name_en') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.tag_management.tag_type.fields.title")}} <small>({{trans("cruds.lang.english")}})</small> <span class="required">*</span></label>
            <input type="text" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');"   name="name_en" value="{{ old('name_en', isset($tagType->name_en) ? $tagType->name_en : '') }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{trans("cruds.tag_management.tag_type.fields.title")}}">
            @if ($errors->has('name_en'))
                <span class="text-danger">{{ $errors->first('name_en') }}</span>
            @endif
        </div> 

        <div class="form-group {{ $errors->has('name_ch') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.tag_management.tag_type.fields.title")}} <small>({{trans("cruds.lang.chinese")}})</small> <span class="required">*</span></label>
            <input type="text"    name="name_ch" value="{{ old('name_ch', isset($tagType->name_ch) ? $tagType->name_ch : '') }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{trans("cruds.tag_management.tag_type.fields.title")}}">
            @if ($errors->has('name_ch'))
                <span class="text-danger">{{ $errors->first('name_ch') }}</span>
            @endif
        </div> 

        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.global.status")}} <span class="text-danger" >*</span></label>
            <select class="form-control" name="status">
                <option value="1" {{isset($tagType) ? $tagType->status == 1  ?  'selected' : '' : ''}}>{{trans("cruds.global.active")}}</option>
                <option value="0" {{isset($tagType) ? $tagType->status == 0  ?  'selected' : '' : ''}}>{{trans("cruds.global.in_active")}}</option>
            </select>
            @if ($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
            @endif
        </div>     
    </div>

</div>

<div class="card-footer">

    <button type="submit" class="btn btn-primary">{{isset($tag_type) ? trans("cruds.global.update")  : trans("cruds.global.save") }}</button>

</div>