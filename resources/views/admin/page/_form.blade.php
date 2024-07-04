{{-- for english --}}
<div class="card-body">
    <div class="form-group {{ $errors->has('content_en') ? 'has-error' : '' }}">
        <label>{{ trans('cruds.pages.fields.content') }} ({{ trans('global.english') }}) <span class="required">*</span></label>
        <textarea id="contentEn" name="content_en">
            {{ isset($pageRecord) ? $pageRecord[0]['content_en'] : '' }}    
    </textarea>
        @if ($errors->has('content_en'))
            <span class="text-danger">{{ $errors->first('content_en') }}</span>
        @endif
    </div>
</div>

{{-- for chinese --}}
<div class="card-body">
    <div class="form-group {{ $errors->has('content_ch') ? 'has-error' : '' }}">
        <label>{{ trans('cruds.pages.fields.content') }} ({{ trans('global.chinese') }}) <span class="required">*</span></label>
        <textarea id="contentCh" name="content_ch">
            {{ isset($pageRecord) ? $pageRecord[0]['content_ch'] : '' }}    
    </textarea>
        @if ($errors->has('content_ch'))
            <span class="text-danger">{{ $errors->first('content_ch') }}</span>
        @endif
    </div>
</div>

{{-- update button --}}
<div class="card-footer">
    <button type="submit"
        class="btn btn-primary">{{ isset($pageRecord) ? trans('cruds.global.update') : trans('cruds.global.save') }}</button>
</div>
