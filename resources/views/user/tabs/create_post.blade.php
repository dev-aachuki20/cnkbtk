<div class="tab-pane tab-pane-box fade" id="create-post" role="tabpanel" aria-labelledby="create-post" tabindex="0">
  <div class="cp-title">
    <h2>Create post</h2>
  </div>
  <section class="edit-post-wrapper">
    <div class="container--box">
      <div class="card-box-wrap">
        <div class="edit-inner-box">
          <form action="" method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-4">
                  <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name=""  placeholder="Enter title" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-4">
                  <label for="">Subject</label>
                  <select class="form-select select-subject" aria-label="Default select example">
                    <option selected>Select subject</option>
                    <option>Production</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-4">
                  <label for="">Tags</label>
                  <select class="form-select select_tags" multiple="multiple">
                    <optgroup label="shoe">
                      <option>High heel</option>
                      <option value="sports shoes"> sports shoes </option>
                      <option value="leather shoes"> leather shoes </option>
                      <option value="cloth shoes"> cloth shoes </option>
                      <option value="sandals">sandals</option>
                      <option value="canvas shoes"> canvas shoes </option>
                      <option value="dancing shoes"> dancing shoes </option>
                      <option value="">no shoes</option>
                    </optgroup>
                    <optgroup label="sock">
                      <option>white silk</option>
                      <option value="white silk"> white silk </option>
                      <option value="black silk"> black silk </option>
                      <option value="white cotton socks"> white cotton socks </option>
                      <option value="black cotton socks"> black cotton socks </option>
                      <option value="colorful cotton socks"> colorful cotton socks </option>
                      <option value="Tabi socks"> Tabi socks </option>
                      <option value="pile of socks"> pile of socks </option>
                    </optgroup>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="file">Upload icon</label>
                  
                  <div class='file-input' id="file-input2">
                                                        <input type='file'>
                                                        <span class='label' data-js-label>No file selected</span>
                                                        <span class='button'>Choose file</span>
                                                    </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-4">
                  <div class="form-group">
                    <label for="">Point</label>
                    <input type="number" class="form-control" name=""  placeholder="Enter point" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-4">
                  <div class="form-group">
                    <label for="my-textarea">Message</label>
                    <textarea id="my-textarea" class="form-control" name="" rows="3" placeholder="Enter your message"></textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="editor-wrapper mb-4">
                  <label for="my-textarea">Description</label>
                  <div id="editor"></div>
                </div>
              </div>
              <div class="col-md-12">
                <button type="button" class="btn btn-primary post-btn"> post </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>