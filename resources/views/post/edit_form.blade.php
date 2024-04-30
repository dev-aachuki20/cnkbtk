            <div class="row">
                <div class="col-md-6">
                  <div class="mb-4">
                    <div class="form-group">
                      <label for="">Title <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" value="{{$poster->name_en}}" />
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-4 form-group">
                    <label for="">Parent section <span class="text-danger">*</span></label>
                    <select class="form-select" name="parent_section" id="parent_section" aria-label="Default select example">
                      <option selected value="">--Select--</option>
                      @foreach ($parentSections as $sections)
                          <option  value="{{$sections->id}}">{{$sections->name}}</option>
                      @endforeach
                    </select> 
                  </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4 form-group">
                      <label for="">Sub section  <span class="text-danger">*</span></label>
                      <select class="form-select" name="sub_section" id="sub_section"></select>
                    </div>
                </div>

                <!-- <div class="col-md-6">
                    <div class="mb-4 form-group">
                      <label for="">Child section <span class="text-danger">*</span></label>
                      <select class="form-select" name="child_section" id="child_section"></select>
                    </div>
                </div> -->

                <div class="col-md-6 ">
                  <div class="form-group mb-4">
                    <label for="file">Poster cover image <small>(Allowed type jpg | png | jpeg | JPG | JPEG | PNG)</small></label>
                    <div class="input-group file-input-group" id="cover_image"  data-controller="file-input">
                      <input class="form-control" id="poster_image" type="text" placeholder="No file selected" readonly
                        data-target="file-input.value" />
                      <input type="file" class="form-control" id="customFile" name="poster_image" data-target="file-input.input"
                        data-action="file-input#display" accept="image/png, image/jpg, image/jpeg, image/PNG, image/JPG, image/JPEG" />
                      <div class="input-group-append">
                        <label class="btn btn-secondary mb-0" for="customFile">Choose file</label>
                      </div>
                    </div>
                    <img class="img-fluid" src="" alt="Image" id="posterImage" style="display:none;max-width:100px;" >
                  </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4 form-group">
                        <label for="">Tags <span class="text-danger">*</span></label>
                        <select class="form-select select_tags" id="tags" multiple name="tags[]">
                            @forelse($tagTypes  as $tagtype)
                            <optgroup label="{{$tagtype->name_en}}">
                                @forelse($tagtype->tags  as $tags)
                                <option value="{{$tags->id}}">{{$tags->name_en}}</option>
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
                        <label>Status <span class="text-danger" >*</span></label>
                        <select class="form-control" name="status">
                            <option value="1" {{isset($post) ? $post->status == 1  ?  'selected' : '' : ''}}>Active</option>
                            <option value="0" {{isset($post) ? $post->status == 0  ?  'selected' : '' : ''}}>In-active</option>
                        </select>
                    </div>
                </div>   

                <div class="col-md-12">
                  <div class="editor-wrapper mb-4 form-group">
                    <label for="my-textarea">Description</label>
                      <textarea name="description" id="description" class="editor cus_editor"></textarea>
                    </div>
                  </div>
                </div>



                <div class="col-12 episode-main ">
                  <div class="row episode-main-inner">
                    <div class="col-12">
                      <div class="row episode-row">
                        
                      </div>
                      <div class="row add-box-wrapper">
                        <div class="col-md-12">
                          <div class="add-btn-wrap">
                            <a href="javascript:void(0)" class="btn btn-primary post-btn add-btn" id="addepisode">
                              Add Episode
                              </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary post-btn mb-3">
                    post
                  </button>
                </div>
            </div>