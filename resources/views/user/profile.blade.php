@extends('layouts.app')
@section("content")
<!-- hero section  -->
    <section class="privacy-hero">
        <div class="container">
            <div class="hero-banner">
                <div class="prc-title">
                    <h2>{{trans("global.profile")}}</h2>
                </div>
            </div>
        </div>
    </section>

    <!-- end  -->

    <section class="breadcrumb-wrap">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans("global.home")}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans("global.profile")}}</li>
                </ol>
            </nav>
        </div>
    </section>


    <div class="profile-wrapper-cp">
        <div class="container">
            <div class="row">
                @include("user.sidebar")
                <div class="col-md-9">
                    <div class="profile-content">
                        <div class="tab-content" id="myTabContent">
                            @include("user.tabs.profile_update")
                            @include("user.tabs.change_password")
                            @include("user.tabs.basic_information")
                            @include("user.tabs.create_post")
                            @if(auth()->user()->role_id != config("constant.role.admin"))
                            @include("user.tabs.credit_history")
                            @endif
                            @include("user.tabs.post_history")
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script  src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"
    ></script>
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>      
<script>
  
$(document).ready(function(){
    $(document).ready(function () {
      const urlParams = new URLSearchParams(window.location.search);
      // Get specific query parameters by name
      const param1 = urlParams.get('tab'); // "value1"

      if (param1 == "createpost") {
        $(document).find(".prc-title").html("<h2>{{trans('global.createpost')}}</h2>");
        $(document).find(".breadcrumb-item").last().text("{{trans('global.createpost')}}");
        $(document).find(".filter-tabs").removeClass("active").end().find(".tab-pane-box").removeClass("active show");
        $(document).find("#create-tab").addClass("active").end().find("#create-post").addClass("active show");
        
      }

      if (param1 == "information") {
        $(document).find(".prc-title").html("<h2>{{trans('global.basic_information')}}</h2>");
        $(document).find(".breadcrumb-item").last().text("{{trans('global.basic_information')}}");
        $(document).find(".filter-tabs").removeClass("active").end().find(".tab-pane-box").removeClass("active show");
        $(document).find("#contact-tab").addClass("active").end().find("#contact-tab-pane").addClass("active show");
      }
      
      if (param1 == "changepassword") {
        $(document).find(".prc-title").html("<h2>{{trans('global.change_password')}}</h2>");
        $(document).find(".breadcrumb-item").last().text("{{trans('global.change_password')}}");
        $(document).find(".filter-tabs").removeClass("active").end().find(".tab-pane-box").removeClass("active show");
        $(document).find("#profile-tab").addClass("active").end().find("#profile-tab-pane").addClass("active show");
      }

      if (param1 == "credithistory") {
        $(document).find(".prc-title").html("<h2>{{trans('global.credit_history')}}</h2>");
        $(document).find(".breadcrumb-item").last().text("{{trans('global.credit_history')}}");
        $(document).find(".filter-tabs").removeClass("active").end().find(".tab-pane-box").removeClass("active show");
        $(document).find("#create-history-tab").addClass("active").end().find("#create-history").addClass("active show");
      }
    });
  
    $('#image').on('change', function () {
        var input = $(this)[0];
        if (input.files && input.files[0]) {
            var file = input.files[0];
            var reader = new FileReader();
            
            // Check the file extension
            var allowedExtensions = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];
            var fileExtension = file.name.split('.').pop().toLowerCase();
            if (allowedExtensions.indexOf(fileExtension) === -1) {
              // Invalid file extension
              toastr.error(trans("messages.invalid_file_format"),trans("global.alert.error"));
              $(this).val('');
              $('#profileImage').hide();
              return;
            }
            reader.onload = function (e) {
                $('#profileImage').attr('src', e.target.result);
                $('#lightBox').attr('href', e.target.result);
               
            };
            reader.readAsDataURL(input.files[0]);
            $('#profileImage').show();
        }
    });

    // password hide and show 

    // $(document).on('click', '.toggle-password', function() {
    //     var input = $(this).siblings('input')
    //     if (input.attr("type") == "password") {
    //         $(this).addClass("fa-eye-slash");
    //         $(this).removeClass("fa-eye");
    //         input.attr("type", "text");
    //     } else {
    //          $(this).addClass("fa-eye");
    //         $(this).removeClass("fa-eye-slash");
    //         input.attr("type", "password");
    //     }   
    // });



    $("#changePasswordForm").on("submit",function(e){
        e.preventDefault();
        formData = new FormData(this);
        url = "{{route('user.profile.change-password')}}";

        $.ajax({
            url: url,
            type:"post",
            data: new FormData(this),
            cache:false,
            processData:false,
            contentType:false,
            beforeSend:function(){
                $(".overlay").css("display:block");
            },
            success:function(response){
                $("body").find(".validError").remove();
                $("#changePasswordForm").trigger("reset");
                toastr.success(response.message, '{{trans("global.alert.success")}}');

            },
            error:function(jqXHR){
                if(jqXHR.status == 422){
                    $("body").find(".validError").remove();
                    var errors = jqXHR.responseJSON.errors;
                    $.each(errors,function(index,value){
                        $("#"+index).after('<span class="text-danger validError">'+value+'</span>');
                    });

                }else{
                    toastr.error(jqXHR.responseJSON.message,'{{trans("global.alert.error")}}');
                }
                
            },
            complete:function(){
                $(".overlay").css("display:hide");
            }
            
        })
    })

    $(".select-subject").select2({
        tags: true,
        placeholder: "Select tags",
    });

    $(".select_tags").select2({
        multiple: true,
        placeholder: "Select tags",
    });
        
    ClassicEditor.create(document.querySelector("#editor")).catch((error) => {
        console.error(error);
    });
      
    $(document).on("click",".filter-tabs",function(){
        var tabId = $(this).attr("id");
        switch (tabId) {
            case "home-tab":
            $(document).find(".prc-title").html("<h2>{{trans('global.profile')}}</h2>");
            $(document).find(".breadcrumb-item").last().text("{{trans('global.profile')}}");
            break;

            case "profile-tab":
            $(document).find(".prc-title").html("<h2>{{trans('global.change_password')}}</h2>");
            $(document).find(".breadcrumb-item").last().text("{{trans('global.change_password')}}");
            break;
            
            case "contact-tab":
            $(document).find(".prc-title").html("<h2>{{trans('global.basic_information')}}</h2>");
                $(document).find(".breadcrumb-item").last().text("{{trans('global.basic_information')}}");
            break;
            
            case "create-tab":
            $(document).find(".prc-title").html("<h2>{{trans('global.create_post')}}</h2>");
            $(document).find(".breadcrumb-item").last().text("{{trans('global.create_post')}}");
            break;
            
            case "create-history-tab":
            $(document).find(".prc-title").html("<h2>{{trans('global.credit_history')}}</h2>");
            $(document).find(".breadcrumb-item").last().text("{{trans('global.credit_history')}}");
            break;

            case "Poster-history-tab":
            $(document).find(".prc-title").html("<h2>{{trans('global.post_history')}}</h2>");
            $(document).find(".breadcrumb-item").last().text("{{trans('global.post_history')}}");
            break;

            default:
            $(document).find(".prc-title").html("<h2>{{trans('global.profile')}}</h2>");
            $(document).find(".breadcrumb-item").last().text("{{trans('global.profile')}}");
            break;
        }
    })

// Also see: https://www.quirksmode.org/dom/inputfile.html

var inputs = document.querySelectorAll('#file-input')

for (var i = 0, len = inputs.length; i < len; i++) {
  customInput(inputs[i])
}

function customInput (el) {
  const fileInput = el.querySelector('[type="file"]')
  const label = el.querySelector('[data-js-label]')
  
  fileInput.onchange =
  fileInput.onmouseout = function () {
    if (!fileInput.value) return
    
    var value = fileInput.value.replace(/^.*[\\\/]/, '')
    el.className += ' -chosen'
    label.innerText = value
  }
}


var inputs = document.querySelectorAll('#file-input2')

for (var i = 0, len = inputs.length; i < len; i++) {
  customInput(inputs[i])
}

function customInput (el) {
  const fileInput = el.querySelector('[type="file"]')
  const label = el.querySelector('[data-js-label]')
  
  fileInput.onchange =
  fileInput.onmouseout = function () {
    if (!fileInput.value) return
    
    var value = fileInput.value.replace(/^.*[\\\/]/, '')
    el.className += ' -chosen'
    label.innerText = value
  }
}

   
})

// password_regarding 

document.addEventListener("DOMContentLoaded", () => {
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#old_password');
    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye');
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const togglePassword = document.querySelector('#togglePassword2');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye');
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const togglePassword = document.querySelector('#togglePassword3');
    const password = document.querySelector('#password_confirmation');
    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye');
    });
});

    // end 
</script>
@endsection


