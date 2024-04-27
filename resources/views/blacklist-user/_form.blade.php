<div class="row">
  <div class="col-md-6">
    <div class="mb-4">
      <div class="form-group">
        <label for="">{{trans("pages.blacklist_user.form.fields.email")}} <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="email" id="email" placeholder="{{trans("global.enter")}} {{trans("pages.blacklist_user.form.fields.email")}}" />
        {{-- @error('email')
        <span class="invalid-feedback">{{ $message }}</span>
        @enderror --}}
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="mb-4">
      <div class="form-group">
        <label for="">{{trans("pages.blacklist_user.form.fields.ip_address")}} <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="ip_address" id="ip_address" placeholder="{{trans("global.enter")}} {{trans("pages.blacklist_user.form.fields.ip_address")}}" />
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <button type="submit" class="btn btn-primary post-btn mb-3">{{trans('global.add')}}</button>
  </div>
</div>