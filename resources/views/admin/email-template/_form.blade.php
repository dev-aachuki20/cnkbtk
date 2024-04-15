<div class="card-body">
    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        <label>{{trans("cruds.email_template.fields.name")}} <span class="required">*</span></label>
        <input type="text" name="name" value="{{ old('name', isset($emailTemp) ? $emailTemp->name : '') }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{trans("cruds.email_template.fields.name")}}">
        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>    
    <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
        <label>{{trans("cruds.email_template.fields.subject")}} <span class="required">*</span></label>
        <input type="text" name="subject" value="{{ old('subject', isset($emailTemp) ? $emailTemp->subject : '') }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}}  {{trans("cruds.email_template.fields.subject")}}">
        @if ($errors->has('subject'))
            <span class="text-danger">{{ $errors->first('subject') }}</span>
        @endif
    </div>
    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
        <label>{{trans("cruds.global.status")}}</label>
            <select class="form-control" name="status">
                <option value="1" {{isset($emailTemp) ? $emailTemp->status == 1  ?  'selected' : '' : ''}}>{{trans("cruds.global.active")}}</option>
                <option value="0" {{isset($emailTemp) ? $emailTemp->status == 0  ?  'selected' : '' : ''}}>{{trans("cruds.global.in_active")}}</option>
            </select>
        @if ($errors->has('status'))
            <span class="text-danger">{{ $errors->first('status') }}</span>
        @endif
    </div>    
    <div class="form-group {{ $errors->has('email_body') ? 'has-error' : '' }}">
    <label>{{trans("cruds.email_template.fields.email_body")}} <span class="required">*</span></label>
    <textarea id="emailBody" name="email_body">
            {{ isset($emailTemp) ? $emailTemp->email_body : '' }}    
    </textarea>
    @if ($errors->has('email_body'))
        <span class="text-danger">{{ $errors->first('email_body') }}</span>
    @endif
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{isset($emailTemp) ? trans("cruds.global.update") : trans("cruds.global.save")}}</button>
</div>