@extends('layouts.app')

@section("content")
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

  <section class="privacy-hero">
    <div class="container">
      <div class="hero-banner">
        <div class="prc-title">
          <h2>{{__('cruds.create_project.create')}} <span>{{__('cruds.create_project.project')}}</span></h2>
        </div>
      </div>
    </div>
  </section>

  <section class="breadcrumb-wrap">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('cruds.create_project.home')}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            {{__('cruds.create_project.title')}}
          </li>
        </ol>
      </nav>
    </div>
  </section>


  <section class="edit-post-wrapper py-5">
    <div class="container">
      <div class="card">
        <div class="card-header">{{__('cruds.create_project.title')}}</div>
        <div class="card-body">
          <div class="edit-inner-box">
            <form id="projectForm"  action="{{ route('user.project.store') }}" method="post">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-4">
                    <label for="type">{{__('cruds.create_project.fields.type')}}</label>
                    <select class="form-select select-subject" aria-label="Default select example" name="type">
                      <option selected>{{__('cruds.create_project.fields.selected.type')}}</option>
                      <option value="pictures">Pictures</option>
                      <option value="video">Video</option>
                      <option value="novel">Novel</option>
                      <option value="tutorial">Tutorial</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-4">
                    <label for="tags">{{__('cruds.create_project.fields.tags')}}</label>
                    <select class="form-select select-subject" aria-label="Default select example" name="tags">
                      <option selected>{{__('cruds.create_project.fields.selected.tags')}}</option>
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

                <div class="col-md-6">
                <div class="mb-4">
                    <label for="creator_id">{{__('cruds.create_project.fields.creators')}}</label>
                    <select class="form-select select-subject" aria-label="Default select example" name="creator_id">
                    <option selected>{{__('cruds.create_project.fields.selected.creator')}}</option>
                    @foreach($creators as $creator)
                        <option value="{{ $creator->id }}">{{ $creator->user_name }}</option>
                    @endforeach
                    </select>
                </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-4">
                    <div class="form-group">
                      <label for="budget">{{__('cruds.create_project.fields.budget')}}</label>
                      <input type="text" class="form-control" name="budget" id="budget" placeholder="{{__('cruds.create_project.fields.placeholder')}}" />
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="editor-wrapper mb-4">
                    <label for="comment">{{__('cruds.create_project.fields.description')}}</label>
                    <textarea name="comment" class="editor cus_editor"></textarea>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="copyrightCheckbox" name="copyright" value="copyright">
                    <label class="form-check-label" for="copyrightCheckbox">{{__('cruds.create_project.fields.copyright')}}</label>
                    <span class="form-text">{{__('cruds.create_project.fields.text')}}</span>
                  </div>
                </div>

                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary post-btn mb-3">{{__('cruds.create_project.post')}}</button>
                </div>
              </div>
              <div id="successMessage" class="alert alert-success " style="display: none;"></div>
              <div id="errorMessage" class="alert alert-danger" style="display: none;"></div>
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
  $(document).ready(function() {
    $(".select-subject").select2({
      placeholder: "Select an option",
      allowClear: true
    });

    ClassicEditor
      .create(document.querySelector('.editor'))
      .catch(error => {
        console.error(error);
      });

    $('#projectForm').submit(function(e) {
      e.preventDefault();
      var formData = $(this).serialize();

      $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      data: formData,
      success: function(response) {
        if (response.success) {
          $('#successMessage').text(response.message).show();
          $('#errorMessage').hide();
        } else {
          $('#errorMessage').text(response.message).show();
          $('#successMessage').hide();
        }
        setTimeout(function() {
                location.reload();
            }, 1000);
      },
      error: function(xhr, status, error) {
        $('#errorMessage').text('An error occurred while processing your request. Please try again later.').show();
        $('#successMessage').hide();
        console.error(error);
      }
    });
    });
});
</script>
@endsection
