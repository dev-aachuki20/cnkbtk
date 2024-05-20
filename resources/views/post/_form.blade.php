            
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-4">
                    <div class="form-group">
                      <label for="">{{trans("pages.post.form.fields.title")}} <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="title" id="title" placeholder="{{trans("global.enter")}} {{trans("pages.post.form.fields.title")}}" value="{{isset($poster) ? $poster->title : ''}}" />
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-4 form-group">
                    <label for="">{{trans("pages.post.form.fields.parent_section")}} <span class="text-danger">*</span></label>
                    <select class="form-select" name="parent_section" id="parent_section" aria-label="Default select example">
                      <option selected value="">--{{trans('global.select')}}--</option>
                      @foreach ($parentSections as $sections)
                          <option  value="{{$sections->id}}" {{isset($poster) && $poster->parent_section ==  $sections->id ? "selected": ''}}>{{$sections->name}}</option>
                      @endforeach
                    </select> 
                  </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="mb-4 form-group">
                      <label for="">{{trans("pages.post.form.fields.sub_section")}}   <span class="text-danger">*</span></label>
                      <select class="form-select" name="sub_section" id="sub_section">
                        @if(isset($subSections))
                           <option selected value="">--{{trans('global.select')}}--</option>
                            @foreach ($subSections as $sections)
                                <option  value="{{$sections->id}}" {{isset($poster) && $poster->sub_section ==  $sections->id ? "selected": ''}}>{{$sections->name}}</option>
                            @endforeach
                        @endif
                      </select>
                    </div>
                </div>

                <!-- <div class="col-md-6">
                    <div class="mb-4 form-group">
                      <label for="">{{trans("pages.post.form.fields.child_section")}}  <span class="text-danger">*</span></label>
                      <select class="form-select" name="child_section" id="child_section">
                          @if(isset($childSections))
                           <option selected value="">--{{trans('global.select')}}--</option>
                            @foreach ($childSections as $sections)
                                <option  value="{{$sections->id}}" {{isset($poster) && $poster->child_section ==  $sections->id ? "selected": ''}}>{{$sections->name}}</option>
                            @endforeach
                        @endif
                      </select>
                    </div>
                </div> -->

                <div class="col-lg-6 col-12">
                  <div class="form-group mb-4">
                    <label for="file">{{trans("pages.post.form.fields.poster_cover_image")}} <small>{{trans("pages.post.form.fields.allowed_file_type")}}</small></label>
                    <div class="input-group file-input-group" id="cover_image"  data-controller="file-input">
                      <input class="form-control" id="poster_image" type="text" placeholder="{{trans('global.no_file_selected')}}" readonly
                        data-target="file-input.value" />
                      <input type="file" class="form-control" id="customFile" name="poster_image" data-target="file-input.input"
                        data-action="file-input#display" accept="image/png, image/jpg, image/jpeg, image/PNG, image/JPG, image/JPEG" />
                      <div class="input-group-append">
                        <label class="btn btn-secondary mb-0" for="customFile">{{trans('global.choose_file')}}</label>
                      </div>
                    </div>

                    @php 
                      if(isset($poster->uploads) && !empty($poster->uploads) && count($poster->uploads) > 0){
                          $imagePath = asset('storage/'. $poster->uploads->first()->path );
                          $display = "block";
                      } else {
                          $imagePath = null;
                          $display = "none";
                      }
                  @endphp

                    <img class="img-fluid" src="{{$imagePath}}" alt="Image" id="posterImage" style="display:{{$display}};max-width:100px;" >
                  </div>

                  
                </div>
                @php $tagArray = []; if(isset($poster->tags)){ $tagArray = explode(",",$poster->tags); }  @endphp
                <div class="col-md-6">
                    <div class="mb-4 form-group">
                        <label for="">{{trans("pages.post.form.fields.tags")}} <span class="text-danger">*</span></label>
                        <select class="form-select select_tags" id="tags" multiple name="tags[]">
                            @forelse($tagTypes  as $tagtype)
                            <optgroup label="{{$tagtype->name}}">
                                @forelse($tagtype->tags  as $tags)
                                @if($tags->status == 1)
                                <option value="{{$tags->id}}" {{in_array($tags->id,$tagArray) ? "selected" : ""}} >{{$tags->name}}</option>
                                @endif
                                @empty
                                @endforelse
                            </optgroup>
                            @empty

                            @endif
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4 form-group">
                        <label>{{trans("pages.post.form.fields.status")}} <span class="text-danger" >*</span></label>
                        <select class="form-control" name="status">
                            <option value="1" {{isset($poster) ? $poster->status == 1  ?  'selected' : '' : ''}}>{{trans('global.active')}}</option>
                            <option value="0" {{isset($poster) ? $poster->status == 0  ?  'selected' : '' : ''}}>{{trans('global.in_active')}}</option>
                        </select>
                    </div>
                </div>   

                <div class="col-md-12">
                  <div class="editor-wrapper mb-4 form-group">
                    <label for="my-textarea">{{trans("pages.post.form.fields.description")}} <span class="text-danger">*</span></label>
                      <textarea name="description" id="description" value="{{isset($poster) ? $poster->description : ''}}" class="editorDefault cus_editor">{{isset($poster) ? $poster->description : ''}}</textarea>
                    </div>
                  </div>
                </div>


                {{-- <div class="col-md-12">
                  <div class="form-group">
                    <label for="my-textarea">Upload files</label>
                      <div class="my-dropzone dropzone" id="dropzone"></div>
                    </div>
                  </div>
                </div> --}}



                <div class="col-12 episode-main ">
                  <div class="row episode-main-inner">
                    <div class="col-12">
                      <div class="row episode-row">
                        <input id="editorCount" type="hidden" value="{{isset($poster->episodes)  && count($poster->episodes) > 0 ? $poster->episodes->count() : 0}}">
                        @if(isset($poster->episodes) && count($poster->episodes) > 0 )
                          @foreach ($poster->episodes as $key => $episodes)
                            <div class="col-12 alert fade show episode-main-box">
                              <div class="row">
                                <div class="col-12 col-md-4">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="mb-4">
                                        <div class="form-group">
                                          <label for="">{{trans("pages.post.form.fields.episode_title")}} <span class="text-danger">*</span></label>
                                          <input type="hidden" class="episodeid" name="episodes[{{$key}}][id]" value="{{encrypt($episodes->id)}}">
                                          <input type="text" class="form-control" name="episodes[{{$key}}][title]" id="episodes_{{$key}}_title" value="{{$episodes->title}}" placeholder="{{trans("global.enter")}} {{trans("pages.post.form.fields.episode_title")}}" />
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="mb-2">
                                        <div class="form-group">
                                          <label for="">{{trans("pages.post.form.fields.episode_cost")}} <span class="text-danger">*</span></label>
                                          <input type="number" class="form-control" name="episodes[{{$key}}][cost]" id="episodes_{{$key}}_cost" value="{{$episodes->cost}}" placeholder="{{trans("global.enter")}} {{trans("pages.post.form.fields.episode_cost")}}" />
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="editor-wrapper mb-2 form-group">
                                    <label for="my-textarea">{{trans("pages.post.form.fields.episode_description")}} <span class="text-danger">*</span></label>
                                    <textarea name="episodes[{{$key}}][content]" class="episode-editor editor " value="{{$episodes->description}}"    id="episodes_{{$key}}_content">{{$episodes->description}}</textarea>
                                  </div>
                                </div>
                                <div class="col-md-12 d-flex remove-box">
                                  <a href="javascript:void(0)" data-episode-id="{{encrypt($episodes->id)}}"  class="btn removeEpisode btn-primary post-btn remove-btn" ><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"/> <path d="M18 6l-12 12" /> <path d="M6 6l12 12" /> </svg> </a>
                                </div>

                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="my-textarea">{{trans("global.upload_files")}}</label>
                                    <div class="my-dropzone dropzone episode_image" id="dropzone_{{$key}}"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        @endif
                      </div>
                      <div class="row add-box-wrapper">
                        <div class="col-md-12">
                          <div class="add-btn-wrap">
                            <a href="javascript:void(0)" class="btn btn-primary post-btn add-btn" id="addepisode"> {{trans("pages.post.form.add_episode")}} </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary post-btn mb-3">{{trans('global.post')}}</button>
                </div>
              </div>
            
      

