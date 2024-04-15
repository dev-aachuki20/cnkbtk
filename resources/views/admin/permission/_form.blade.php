<div class="card-body">
    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        <label>Name <span class="required">*</span></label>
        <input type="text" name="name"value="{{ old('name', isset($permission) ? $permission->name : '') }}" class="form-control"  placeholder="Enter Permission Name" oninput="this.value = this.value.replace(/[^a-zA-Z-_ ]/g, '').replace(/(\..*)\./g, '$1');">
        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>    
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{isset($permission) ? 'Update' : 'Save'}}</button>
</div>