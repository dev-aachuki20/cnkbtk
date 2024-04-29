<div class="card-body">
    <div class="row">
        <div class="form-group {{ $errors->has('name_en') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.tag_management.tag.fields.title")}} <small>({{trans("cruds.lang.english")}})</small> <span class="required">*</span></label>
            <input type="text" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');" name="name_en" value="{{ old('name_en', isset($blacklistTag->name_en) ? $blacklistTag->name_en : '') }}" class="form-control" placeholder="{{trans("cruds.global.enter")}} {{trans("cruds.tag_management.tag.fields.title")}}">
            @if ($errors->has('name_en'))
            <span class="text-danger">{{ $errors->first('name_en') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('name_ch') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.tag_management.tag.fields.title")}} <small>({{trans("cruds.lang.chinese")}})</small> <span class="required">*</span></label>
            <input type="text" name="name_ch" value="{{ old('name_ch', isset($blacklistTag->name_ch) ? $blacklistTag->name_ch : '') }}" class="form-control" placeholder="{{trans("cruds.global.enter")}} {{trans("cruds.tag_management.tag.fields.title")}}">
            @if ($errors->has('name_ch'))
            <span class="text-danger">{{ $errors->first('name_ch') }}</span>
            @endif
        </div>


        <div class="form-groupF {{ $errors->has('status') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.global.status")}} <span class="text-danger">*</span></label>
            <select class="form-control" name="status">
                <option value="1" {{isset($blacklistTag) ? $blacklistTag->status == 1  ?  'selected' : '' : ''}}>{{trans("cruds.global.active")}}</option>
                <option value="0" {{isset($blacklistTag) ? $blacklistTag->status == 0  ?  'selected' : '' : ''}}>{{trans("cruds.global.in_active")}}</option>
            </select>
            @if ($errors->has('status'))
            <span class="text-danger">{{ $errors->first('status') }}</span>
            @endif
        </div>
    </div>

</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{isset($blacklistTag) ? trans("cruds.global.update") :trans("cruds.global.save")}}</button>
</div>