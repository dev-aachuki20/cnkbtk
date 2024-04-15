<div class="card-body">
    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        <label>Name <span class="required">*</span></label>
        <input type="text" name="name"value="{{ old('name', isset($role) ? $role->name : '') }}" class="form-control"  placeholder="Enter Role Name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');">
        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>   
    <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
        <label for="permissions">Permissions<span class="required">*</span>
            <span class="btn btn-info btn-xs select-all">Select All</span>
            <span class="btn btn-info btn-xs deselect-all">Deselect All</span>
        </label>
        <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple">
            @foreach($permissions as $id => $permissions)
                <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
            @endforeach
        </select>
        @if($errors->has('permissions'))
           <span class="text-danger">{{ $errors->first('permissions') }}</span>
        @endif
    </div> 
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{isset($role) ? 'Update' : 'Save'}}</button>
</div>