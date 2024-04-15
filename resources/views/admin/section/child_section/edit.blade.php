@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{trans("cruds.global.edit")}} {{trans("cruds.section_management.child_section.title_singular")}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
              <li class="breadcrumb-item">{{trans("cruds.section_management.title_singular")}}</li>
              <li class="breadcrumb-item active">{{trans("cruds.global.edit")}} {{trans("cruds.section_management.child_section.title_singular")}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{trans("cruds.global.edit")}} {{trans("cruds.section_management.child_section.title_singular")}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.child-section.update',$section->id) }}" id="edtiForm" enctype="multipart/form-data">
                @csrf
                @method("PATCH")
                @include("admin.section.child_section._form")
              </form>
            </div>
          </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('scripts')
<script src="{{ asset('admins/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script>
$(document).ready(function () {
   
    var parentId = $("select[name=parent_id]").find("option:selected").val();
    var url = '{{ route("get-sub-section", ":id") }}';
    url = url.replace(':id', parentId);
    if(parentId){
        getSubparentSections(url)

        setTimeout(function(){
          selectedVal = "{{$section->parent_id}}";
          $("select[name=sub_parent_id]").find("option[value='"+selectedVal+"']").prop("selected","selected");
        },1000);
    }

   
    $.validator.addMethod("filesize", function (value, element, param) {
      return this.optional(element) || (element.files[0].size <= param);
    }, "File size must be less than or equal to 1 MB.");
    
    $(function () {
        $('#addForm').validate({
          ignore: '.ignore, .select2-input',
          focusInvalid: false,
          rules: {
            
            'section_logo': {
              filesize: 1024000,
              required: false
            }
          },
          // Errors //
          errorPlacement: function errorPlacement(error, element) {
            var $parent = $(element).parents('.form-group');
    
            // Do not duplicate errors
            if ($parent.find('.jquery-validation-error').length) {
              return;
            }
    
            $parent.append(
              error.addClass('jquery-validation-error small form-text invalid-feedback')
            );
          },
          highlight: function (element) {
            var $el = $(element);
            var $parent = $el.parents('.form-group');
            $el.addClass('is-invalid');
          },
          unhighlight: function (element) {
            $(element).parents('.selectBoxDiv').find('.is-invalid').removeClass('is-invalid');
          }
        });
    });

    
    $('#section_logo').on('change', function () {
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
              $('#preview').hide();
              return;
            }
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
                $('#lightBox').attr('href', e.target.result);
               
            };
            reader.readAsDataURL(input.files[0]);
            $('#preview').show();
        } else {
            $('#preview').hide();
        }
    });

    $(document).on("submit","#edtiForm",function(e){
      e.preventDefault();
       var url = $(this).attr('action');
       $.ajax({
            headers :{
                'X-CSRF-TOKEN' : $("meta[name=csrf-token]").attr('content')
            },
            url:url,
            method:'post',
            data : new FormData (this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function(response){
                $('.overlay').show();
            },
            success:function(response){
                toastr.success(response.message, '{{trans("global.alert.success")}}');
            },
            error:function(jqXHR,exception){
               
                if(jqXHR.status == 422){
                    $(".errors").remove();
                    $.each(jqXHR.responseJSON.errors,function(index,value){
                        
                        if($("#"+index).hasClass("summernote")){
                            $("#"+index).siblings(".note-editor").after("<span class='text-danger validationError d-block w-100'>"+value+"</span>");
                        }else{
                            $("#"+index).parents(".form-group").append("<span class='text-danger errors'>"+value+"</span>");
                        }
                        
                    });
                }else{
                    toastr.error(jqXHR.responseJSON.message, '{{trans("global.alert.error")}}');
                }
            },
            complete:function(){
               $('.overlay').hide();
            }
        });
    });

    $("select[name=parent_id]").on("change",async function(){
        var parentId =  $(this).val();

        var url = '{{ route("get-sub-section", ":id") }}';
        url = url.replace(':id', parentId);


        if(parentId != "" ){
          await getSubparentSections(url);
        }else{
          $("select[name=sub_parent_id]").html("");
        }
        
        if($selectedVal != ""){
          $selectedVal = "{{ old('sub_parent_id', isset($section->parent_id) ? $section->parent_id : '')}} ";
          $("select[name=sub_parent_id]").find("option[value="+ $selectedVal+"]").attr("selected");
        }

    })
 
    
});
</script>

@endsection
