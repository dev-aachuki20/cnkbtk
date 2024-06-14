<div class="row">

  <div class="col-md-4">
    <div class="mb-4">
      <div class="form-group">
        <label for="title">{{__('cruds.create_project.fields.title')}} <span class="text-danger">*</span></label>
        <input type="text" value="{{ isset($project) ? $project->title :''}}" class="form-control" name="title" id="title" placeholder="{{__('cruds.create_project.fields.title_placeholder')}}" />
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="mb-4">
      <div class="form-group">
        <label for="type">{{__('cruds.create_project.fields.type')}} <span class="text-danger">*</span></label>
        <select class="form-select select-subject" aria-label="Default select example" name="type" id="type">
          <option value="">{{__('cruds.create_project.fields.selected.type')}}</option>
          <option value="pictures" {{ isset($project) &&  $project->type == 'Pictures' ? 'selected' : '' }}>{{trans ('cruds.project.project_type.pictures')}}</option>
          <option value="video" {{ isset($project) &&  $project->type == 'Video' ? 'selected' : '' }}>{{trans('cruds.project.project_type.video')}}</option>
          <option value="novel" {{ isset($project) &&  $project->type == 'Novel' ? 'selected' : '' }}>{{trans('cruds.project.project_type.novel')}}</option>
          <option value="tutorial" {{isset($project) &&  $project->type == 'Tutorial' ? 'selected' : '' }}>{{trans('cruds.project.project_type.tutorial')}}</option>
        </select>
      </div>
    </div>
  </div>

  {{-- <div class="col-md-4">
    <div class="mb-4">
      <div class="form-group">
        <label for="tags_id">{{__('cruds.create_project.fields.tags')}} <span class="text-danger">*</span></label>
        <select class="form-select select-subject" aria-label="Default select example" name="tags_id" id="tags_id">
          <option value="">{{__('cruds.create_project.fields.selected.tags')}}</option>
          @foreach($tagTypes as $tagType)
          <optgroup label="{{ $tagType->name }}">
            @foreach($tagType->tags as $tag)
            <option value="{{ $tag->id }}" {{ isset($project) && $project->tags_id == $tag->id ? 'selected' : '' }}>{{ $tag->name }}</option>
            @endforeach
          </optgroup>
          @endforeach
        </select>
      </div>
    </div>
  </div> --}}

  @php $tagArray = []; if(isset($project->tags)){ $tagArray = explode(",",$project->tags); }  @endphp
  <div class="col-md-4">
    <div class="mb-4">
      <div class="form-group multipal_select_group">
        <label for="tags_id">{{__('cruds.create_project.fields.tags')}} <span class="text-danger">*</span></label>
        <select class="form-select select-subject" aria-label="Default select example" name="tags[]" id="tags_id" multiple>
          <option value="">{{__('cruds.create_project.fields.selected.tags')}}</option>
          @foreach($tagTypes as $tagType)
          <optgroup label="{{ $tagType->name }}">
            @foreach($tagType->tags as $tag)
            @if($tag->status == 1)
            <option value="{{ $tag->id }}" {{in_array($tag->id,$tagArray) ? "selected" : ""}}>{{ $tag->name }}</option>
            @endif
            @endforeach
          </optgroup>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="mb-4">
      <div class="form-group multipal_select_group">
        <label for="creator_id">{{__('cruds.create_project.fields.creators')}} <span class="text-danger info-tag"><i class="fa fa-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{__('messages.creator_message')}}"></i></span></label>
        <select class="form-select select-subject" aria-label="Default select example" name="creator_id[]" multiple id="creator_id">
          @foreach($creators as $creator)
          <option value="{{ $creator->id }}" {{ isset($project) && in_array($creator->id, $project->creators->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $creator->user_name }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="mb-4">
      <div class="form-group">
        <label for="budget">{{__('cruds.create_project.fields.budget')}} <span class="text-danger">*</span></label>
        <input type="number" value="{{ isset($project) ? $project->budget :''}}" class="form-control" name="budget" id="budget" placeholder="{{__('cruds.create_project.fields.placeholder')}}" />
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="mb-4">
      <div class="form-group">
        <label>{{trans("pages.post.form.fields.status")}} <span class="text-danger">*</span></label>
        <select class="form-select" name="status" id="status">
          <option value="1" {{ isset($project) &&  $project->status == 1 ? 'selected' : '' }}>{{trans('global.active')}}</option>
          <option value="0" {{ isset($project) &&  $project->status == 0 ? 'selected' : '' }}>{{trans('global.in_active')}}</option>
        </select>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="editor-wrapper mb-4 form-group">
      <label for="comment">{{__('cruds.create_project.fields.description')}} <span class="text-danger">*</span></label>
      <textarea name="comment" class="editor cus_editor" id="comment">{{isset($project) ? $project->comment : ''}}</textarea>
    </div>
  </div>

  <div class="col-md-12">
    <div class="mb-4 form-check">
      <input type="checkbox" value="{{isset($project) &&  $project->copyright}}" class="form-check-input" id="copyright" name="copyright" {{ isset($project) &&  $project->copyright ? 'checked' : '' }}>
      <label class="form-check-label" for="copyright">{{__('cruds.create_project.fields.copyright')}}</label>
      <span class="form-text">{{__('cruds.create_project.fields.text')}}</span>
    </div>
  </div>

  <div class="col-md-12">
    <button type="submit" class="btn btn-primary post-btn mb-3">{{__('cruds.global.save')}}</button>
  </div>
</div>