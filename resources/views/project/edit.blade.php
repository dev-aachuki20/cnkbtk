@extends('layouts.app')
@section('content')
<section class="privacy-hero">
    <div class="container">
        <div class="hero-banner">
            <div class="prc-title">
                <h2>{{trans("cruds.global.edit")}} <span>{{__('cruds.create_project.project')}}</span></h2>
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
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('cruds.create_project.home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{trans("cruds.global.edit")}} {{__('cruds.create_project.project')}}
                </li>
            </ol>
        </nav>
    </div>
</section>
<!-- End breadcrumb  -->

<section class="edit-post-wrapper py-5">
    <div class="container">
        <div class="card">
            <div class="card-header">{{trans("cruds.global.edit")}} {{__('cruds.create_project.project')}}</div>
            <div class="card-body">
                <div class="edit-inner-box">
                    <form id="projectEditForm" action="{{ route('user.project.update',$project->id) }}" method="POST" data-action="{{__('cruds.global.update')}}">
                        @csrf
                        @method("PATCH")
                        @include("project._form")
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@section("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        $(".select-subject").select2({
            placeholder: "{{__('global.select')}}",
            allowClear: true
        });

        ClassicEditor
      .create(document.querySelector('.editor'), {
        toolbar: {
          items: [
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            'bulletedList',
            'numberedList',
            'blockQuote',
            'undo',
            'redo'
          ]
        },
      })
      .catch(error => {
        console.error(error);
      });

        // Update project and send notification.
        $(document).on("submit", "#projectEditForm", function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var formdata = new FormData(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content')
                },
                url: url,
                method: 'POST',
                data: formdata,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(response) {
                    showLoader();
                },
                success: function(response) {
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.href = response.reloadUrl;
                    }, 1500);

                },
                error: function(jqXHR, exception) {
                    if (jqXHR.status == 422) {
                        $(".errors").remove();
                        $.each(jqXHR.responseJSON.errors, function(index, value) {
                            if (index.indexOf(".") != -1) {
                                index = index.replace(/([.])+/g, '_');
                                index.replace(".", '_');
                            }
                            console.log(index);
                            $("#" + index).parents(".form-group").append("<span class='text-danger errors'>" + value + "</span>");

                        });
                    } else {
                        toastr.error(jqXHR.responseJSON.message, '{{trans("global.alert.error")}}');
                        setTimeout(function() {
                            location.reload();
                        }, 4000);

                    }
                },
                complete: function() {
                    hideLoader();
                }
            });
        });

    });
</script>
@endsection