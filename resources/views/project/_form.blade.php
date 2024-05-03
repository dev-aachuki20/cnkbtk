<div class="row">
  <div class="col-md-6">
    <div class="mb-4">
      <div class="form-group">
        <label for="type">{{__('cruds.create_project.fields.type')}} <span class="text-danger">*</span></label>
        <select class="form-select select-subject" aria-label="Default select example" name="type" id="type">
          <option value="">{{__('cruds.create_project.fields.selected.type')}}</option>
          <option value="pictures">{{trans('cruds.project.project_type.pictures')}}</option>
          <option value="video">{{trans('cruds.project.project_type.video')}}</option>
          <option value="novel">{{trans('cruds.project.project_type.novel')}}</option>
          <option value="tutorial">{{trans('cruds.project.project_type.tutorial')}}</option>
        </select>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="mb-4">
      <div class="form-group">
        <label for="tags_id">{{__('cruds.create_project.fields.tags')}} <span class="text-danger">*</span></label>
        <select class="form-select select-subject" aria-label="Default select example" name="tags_id" id="tags_id">
          <option value="">{{__('cruds.create_project.fields.selected.tags')}}</option>
          @foreach($tagTypes as $tagType)
          <optgroup label="{{ $tagType->name }}">
            @foreach($tagType->tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
          </optgroup>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="mb-4">
      <div class="form-group">
        <label for="creator_id">{{__('cruds.create_project.fields.creators')}}</label>
        <select class="form-select select-subject" aria-label="Default select example" name="creator_id[]" multiple id="creator_id">
          @foreach($creators as $creator)
          <option value="{{ $creator->id }}">{{ $creator->user_name }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="mb-4">
      <div class="form-group">
        <label for="budget">{{__('cruds.create_project.fields.budget')}} <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="budget" id="budget" placeholder="{{__('cruds.create_project.fields.placeholder')}}" />
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="mb-4">
      <div class="form-group">
        <label>{{trans("pages.post.form.fields.status")}} <span class="text-danger">*</span></label>
        <select class="form-select" name="status" id="status">
          <option value="1">{{trans('global.active')}}</option>
          <option value="0">{{trans('global.in_active')}}</option>
        </select>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="editor-wrapper mb-4 form-group">
      <label for="comment">{{__('cruds.create_project.fields.description')}}</label>
      <textarea name="comment" class="editor cus_editor" id="comment"></textarea>
    </div>
  </div>

  <div class="col-md-6">
    <div class="mb-4 form-check">
      <input type="checkbox" class="form-check-input" id="copyright" name="copyright" value="copyright">
      <label class="form-check-label" for="copyright">{{__('cruds.create_project.fields.copyright')}}</label>
      <span class="form-text">{{__('cruds.create_project.fields.text')}}</span>
    </div>
  </div>

  <div class="col-md-12">
    <button type="submit" class="btn btn-primary post-btn mb-3">{{__('cruds.create_project.create')}}</button>
  </div>
</div>