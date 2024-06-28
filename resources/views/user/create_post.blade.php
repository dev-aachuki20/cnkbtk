@extends('layouts.app')
@section("content")
<!-- hero privacy  -->
  <section class="privacy-hero">
    <div class="container">
      <div class="hero-banner">
        <div class="prc-title">
          <h2>Create <span>post</span></h2>
        </div>
      </div>
    </div>
  </section>
  <!-- end  -->

  <!-- Breadcrumb -->
  <section class="breadcrumb-wrap">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            Create post
          </li>
        </ol>
      </nav>
    </div>
  </section>
  <!-- End breadcrumb  -->

  <section class="edit-post-wrapper py-5">
    <div class="container">
      <div class="card">
        <div class="card-header">Create post</div>
        <div class="card-body">
          <div class="edit-inner-box">
            <form action="#" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-4">
                    <div class="form-group">
                      <label for="">Title</label>
                      <input type="text" class="form-control" name="" id="" placeholder="Enter title" />
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
                    <label for="">Category</label>
                    <select class="form-select select-subject" aria-label="Default select example">
                      <option selected>Select category</option>
                        <option value="Resource library">Resource library</option>
                        <option value="Original atlas">Original atlas</option>
                        <option value="Original video">Original video</option>
                        <option value="Original novel">Original novel</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-4">
                    <label for="">Sub category</label>
                    <select class="form-select select-subject" aria-label="Default select example">
                      <option selected>Select sub category</option>
                      <option value="Resource library">Resource library</option>
                        <option value="Original atlas">Original atlas</option>
                        <option value="Original video">Original video</option>
                        <option value="Original novel">Original novel</option>
                    </select>
                  </div>
                </div>

                <!-- <div class="col-md-6">
                  <div class="mb-4">
                    <label for="">Child category</label>
                    <select class="form-select select-subject" aria-label="Default select example">
                      <option selected>Select child category</option>
                      <option value="Resource library">Resource library</option>
                        <option value="Original atlas">Original atlas</option>
                        <option value="Original video">Original video</option>
                        <option value="Original novel">Original novel</option>
                    </select>
                  </div>
                </div> -->

                <div class="col-md-6">
                  <div class="mb-4">
                    <label for="">Tags</label>
                    <select class="form-select select_tags" multiple="multiple">
                      <optgroup label="shoe">
                        <option>High heel</option>
                        <option value="sports shoes">
                          sports shoes
                        </option>
                        <option value="leather shoes">
                          leather shoes
                        </option>
                        <option value="cloth shoes">
                          cloth shoes
                        </option>
                        <option value="sandals">sandals</option>
                        <option value="canvas shoes">
                          canvas shoes
                        </option>
                        <option value="dancing shoes">
                          dancing shoes
                        </option>
                        <option value="">no shoes</option>
                      </optgroup>
                      <optgroup label="sock">
                        <option>white silk</option>
                        <option value="white silk">
                          white silk
                        </option>
                        <option value="black silk">
                          black silk
                        </option>
                        <option value="white cotton socks">
                          white cotton socks
                        </option>
                        <option value="black cotton socks">
                          black cotton socks
                        </option>
                        <option value="colorful cotton socks">
                          colorful cotton socks
                        </option>
                        <option value="Tabi socks">
                          Tabi socks
                        </option>
                        <option value="pile of socks">
                          pile of socks
                        </option>
                      </optgroup>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group mb-4">
                    <label for="file">Upload poster image</label>
                    <div class="input-group file-input-group" data-controller="file-input">
                      <input class="form-control" type="text" placeholder="No file selected" readonly
                        data-target="file-input.value" />
                      <input type="file" class="form-control" id="customFile" data-target="file-input.input"
                        data-action="file-input#display" accept="image/png, image/jpg, image/jpeg, image/PNG, image/JPG, image/JPEG" />
                      <div class="input-group-append">
                        <label class="btn btn-secondary mb-0" for="customFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- <div class="col-md-6">
                  <div class="mb-4">
                    <div class="form-group">
                      <label for="">Point</label>
                      <input type="number" class="form-control" name="" id="" placeholder="Enter point" />
                    </div>
                  </div>
                </div> -->

                <div class="col-md-6">
                  <div class="mb-4">
                    <label for="">Post type</label>
                    <select class="form-select post-select-box" aria-label="Default select example">
                      <option selected>Select type</option>
                      <option value="Single">Single</option>
                      <option value="Single">Series</option>
                    </select>
                  </div>
                </div>

                <!-- <div class="col-12 col-md-12">
                  <div class="mb-4">
                    <div class="form-group">
                      <label for="my-textarea">Message</label>
                      <textarea id="my-textarea" class="form-control" name="" rows="5"
                        placeholder="Enter your message"></textarea>
                    </div>
                  </div>
                </div> -->

                <!-- <div class="col-md-12">
                  <div class="hide-btn">
                    <a href=""class="btn btn-primary post-btn" data-bs-toggle="modal" data-bs-target="#pointmodal">hide</a>
                  </div>
                </div> -->

                <div class="col-md-12">
                  <div class="editor-wrapper mb-4">
                    <label for="my-textarea">Description</label>
                      <textarea name="content0" class="editor cus_editor"></textarea>
                    </div>
                  </div>
                </div>

                <div class="col-12 episode-main ">
                  <div class="row episode-main-inner">
                    <div class="col-12">
                      <div class="row episode-row">
                        <!-- <div class="col-12 alert fade show episode-main-box">
                          <div class="row">
                            <div class="col-12 col-md-4">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="mb-4">
                                    <div class="form-group">
                                      <label for="">Episode title</label>
                                      <input type="text" class="form-control" name="" id="" placeholder="Enter title" />
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="mb-4">
                                    <div class="form-group">
                                      <label for="">Episode cost</label>
                                      <input type="number" class="form-control" name="" id="" placeholder="Enter cost" />
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-8">
                              <div class="editor-wrapper mb-4">
                                <label for="my-textarea">Description</label>
                                <textarea name="episode_content_0" class="editor  episode-editor" id="episode-1 "></textarea>
                              </div>
                            </div>
                            
                            <div class="col-md-12 d-flex remove-box">
                              <a href="#" class="btn btn-primary post-btn remove-btn"  data-bs-dismiss="alert" aria-label="Close">
                                  
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                  </svg>
                              </a>
                          </div>
                          </div>
                        </div> -->
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
                  <button type="button" class="btn btn-primary post-btn mb-3">
                    post
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

@section("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
<script>
    class FileInputController extends Stimulus.Controller {
      static get targets() {
        return ["value", "input"];
      }

      display(evt) {
        const fileName = evt.target.value.split("\\").pop();

        if (this.valueTarget.nodeName == "INPUT") {
          this.valueTarget.placeholder = fileName;
        } else {
          this.valueTarget.innerHTML = fileName;
        }
      }
    }

    const application = Stimulus.Application.start();
    application.register("file-input", FileInputController);
  </script>
  <script>
    $(".js-example-tags").select2({
      tags: true,
      placeholder: "Select tags",
    });

    $(".select_tags").select2({
      multiple: true,
      placeholder: "Select tags",
    });

    var allEditors = document.querySelectorAll('.editor');
    for (var i = 0; i < allEditors.length; ++i) {
      ClassicEditor.create(allEditors[i]);
    }


    // back-top

    var btn = $("#topup");

    $(window).scroll(function () {
      if ($(window).scrollTop() > 300) {
        btn.addClass("show");
      } else {
        btn.removeClass("show");
      }
    });

    btn.on("click", function (e) {
      e.preventDefault();
      $("html, body").animate({ scrollTop: 0 }, "300");
    });

    $(".select-subject").select2({
      tags: true,
      placeholder: "Select tags",
    });

    $(".post-select-box").select2({
      minimumResultsForSearch: -1,
      tags: true,
      placeholder: "Select tags",
    });
    // data append 

  $(document).ready(function() {
    $("#addepisode").click(function() {
        var editorCount = ($(document).find(".episode-editor").length  + 1);

        let svg = ' <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"/> <path d="M18 6l-12 12" /> <path d="M6 6l12 12" /> </svg>';

        $(".episode-row").append('<div class="col-12 alert fade show episode-main-box"> <div class="row"> <div class="col-12 col-md-4"> <div class="row"> <div class="col-md-12"> <div class="mb-4"> <div class="form-group"> <label for="">Episode title</label> <input type="text" class="form-control" name="" id="" placeholder="Enter title" /> </div> </div> </div> <div class="col-md-12"> <div class="mb-2"> <div class="form-group"> <label for="">Episode cost</label> <input type="number" class="form-control" name="" id="" placeholder="Enter cost" /> </div> </div> </div> </div> </div> <div class="col-md-8"> <div class="editor-wrapper mb-2"> <label for="my-textarea">Description</label> <textarea name="episode_content_'+editorCount+'" class="episode-editor editor'+editorCount+' " id="editor-'+editorCount+'"></textarea> </div> </div> <div class="col-md-12 d-flex remove-box"> <a href="#" class="btn btn-primary post-btn remove-btn" data-bs-dismiss="alert" aria-label="Close">'+svg+' </a> </div> </div> </div>');
       
        var newEditor = document.querySelector('#editor-'+editorCount);
        ClassicEditor.create(newEditor);
    });
  });

 

  </script>

@endsection