<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
  <script>
      var dropzoneInstances = [];
      var ckeditorToolbar = {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    'blockquote',
                    'undo',
                    'redo'
                ],
                shouldNotGroupWhenFull: true
            };
      var removedPlugins = ['Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed']; 
      Dropzone.autoDiscover = false;
      
      @if(isset($poster))
          var preload = [];
          @if(isset($poster->episodes) && $poster->episodes->count() > 0)
            @foreach($poster->episodes as $episodekey  => $episodes)
                preload[{{$episodekey}}] = new Array();
                @if(isset($episodes->uploads) && $episodes->uploads->count() > 0) 
                    @foreach($episodes->uploads as $imageKey => $images)
                        @if($images->path && Storage::disk('public')->exists($images->path))
                         @php
                            $mediaImage = '';
                            $filePath = $images->path;
                            $fileNameArray = explode('/', $filePath);
                            $fileName = end($fileNameArray);
                            $extension = explode(".",$fileName)[1];
                            $origFileName = Str::random(10);
                            $fileSize = \File::size(public_path('storage/'.$filePath));
                            $mediaImage = asset('storage/'.$filePath);
                            
                          @endphp
                          preload[{{$episodekey}}].push(<?= json_encode(array('upload_id'=> $images->id,'src'=> $mediaImage,'original_file_name' => $origFileName,'documentType' => $extension, 'fileName' => $fileName, 'size' => $fileSize)) ?>);
                        @endif
                        
                    @endforeach
                @endif
            @endforeach
          @endif
          console.log(preload);
          var allEditors = document.querySelectorAll(".editor");
          for(i=0; i < allEditors.length; i++){
            ClassicEditor.create(allEditors[i],{
              toolbar:ckeditorToolbar
            });
          }
          
          $(document).find(".my-dropzone").each(async function(index){ 
            var newDropzone = $(this).attr("id");    
            console.log("index",index);
            await createDropzone(newDropzone,preload[index]);
          });
      @endif

      async function createDropzone(id,preloaded){
        return new Promise (resolve =>  {
          Dropzone.autoDiscover = false;
          var newDropzone = new Dropzone("#"+id, {
                url: "{% url 'dropzone/images' %}",
                addRemoveLinks: true,
                uploadMultiple:true,
                minFiles: 1,
                autoProcessQueue : false,
                maxFiles: 5,
                acceptedFiles: '.png,.gif,.jpeg,.jpg,.svg',
                dictDefaultMessage: "Put  files here",
                dictRemoveFile: '<i class="fa fa-times mt-2" ><i>',

                // add by me
                // init: function() {
                //   var dz = this; // Store Dropzone instance reference

                //   // Event listener for the removedfile event
                //   this.on("removedfile", function(file) {
                //     // Remove the file from Dropzone's internal storage
                //     dz.removeFile(file);
                //     // Send an AJAX request to delete the image from the server
                //     $.ajax({
                //       type: 'POST',
                //       url: "{{route('post.remove-episode')}}",
                //       data: { 
                //         image: file.name 
                //       },
                //       success: function(data) {
                //         console.log("Image deleted:", data);
                //       },
                //       error: function(xhr, status, error) {
                //         console.error("Error deleting image:", xhr.responseText);
                //       }
                //     });
                //   });
                // }

                // $(".my-dropzone").each(function(index) {
                //   var id = $(this).attr("id");
                //   createDropzone(id);
                // });
                // end add by me
            }); 
            newDropzone.on('addedfile', function(file) {
              $(file.previewElement).addClass('dz-complete');
            })
            dropzoneInstances[id] = newDropzone;
            if(newDropzone){
                 $.each(preloaded,function(key,value) {
                    var mockFile = { name: value.original_file_name, size:value.size, path:value.src, upload_id: value.upload_id, type:value.documentType , accepted: true, title : value.title};
                    newDropzone.emit("addedfile", mockFile);
                    newDropzone.emit("thumbnail", mockFile, value.src);     
                    newDropzone.emit("complete", mockFile);
                });
                return resolve(true);
                
            }
        })
            
      }

      {{-- async function insterExistingfiles(){

        $.each(preloaded, function(key,value) {
            var mockFile = { name: value.original_file_name, size:value.size, path:value.src, upload_id: value.upload_id, type:value.documentType , accepted: true, title : value.title};
            
            dropzone.emit("addedfile", mockFile);
            dropzone.emit("thumbnail", mockFile, value.src);        
            dropzone.emit("complete", mockFile);
        });
      } --}}
      

      $(document).ready(async function(){
          // Initialize default Editor 
          ClassicEditor.create(document.querySelector(".editorDefault"),{
              toolbar:ckeditorToolbar
             
            }); 
            //File input related js
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

          $("#parent_section").on("change",function(){
              var parentSection = $(this).val();
              if(parentSection == ''){
                $("#sub_section").html("");
                // $("#child_section").html("");
                return;
              }
              var url = '{{ route("get-sub-section", ":id") }}';
              url = url.replace(':id', parentSection);
              $.ajax({
                    url:url,
                    method:'get',
                    dataType:'json',
                    beforeSend:function(response){
                        showLoader()
                    },
                    success:function(response){ 
                      $("#sub_section").html(response.message);
                    },
                    error:function(response){
                      $("#sub_section").html("");
                      $("#child_section").html("");
                      toastr.error(response.responseJSON.message,'{{trans("global.alert.error")}}');
                      
                    },
                    complete:function(){
                        hideLoader();
                    }
              });
            

          });


         


          $(document).on("click",".remove-btn",async function(e){
            e.preventDefault();
            $(this).parents(".episode-main-box").remove();
          });

          $(".select_tags").select2({
            placeholder: "{{trans('global.select')}} {{trans('pages.post.form.fields.tags')}}",
            multiple:true
          });

        
          $(".post-select-box").select2({
            minimumResultsForSearch: -1,
            tags: true,
            placeholder: "Select tags",
          });
          // data append 

          // Validating image type
          $('#profileImage').on('change', function () {
              var input = $(this)[0];
              if (input.files && input.files[0]) {
                  var file = input.files[0];
                  var reader = new FileReader();
                  
                  // Check the file extension
                  var allowedExtensions = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];
                  var fileExtension = file.name.split('.').pop().toLowerCase();
                  if (allowedExtensions.indexOf(fileExtension) === -1) {
                    // Invalid file extension
                    toastr.error('{{trans("messages.invalid_file_format")}}','{{trans("global.alert.error")}}');
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

          $('#customFile').on('change', function () {
              var input = $(this)[0];
              if (input.files && input.files[0]) {
                  var file = input.files[0];
                  var reader = new FileReader();
                  
                  // Check the file extension
                  var allowedExtensions = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];
                  var fileExtension = file.name.split('.').pop().toLowerCase();
                  if (allowedExtensions.indexOf(fileExtension) === -1) {
                    // Invalid file extension
                   toastr.error('{{trans("messages.invalid_file_format")}}','{{trans("global.alert.error")}}');
                    $(this).val('');
                    $('#posterImage').hide();
                    return;
                  }
                  reader.onload = function (e) {
                      $('#posterImage').attr('src', e.target.result); 
                  };
                  reader.readAsDataURL(input.files[0]);
                  $('#posterImage').show();
              } else {
                  $('#posterImage').hide();
              }
          });

          $(document).on("submit","#addForm",function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            var formdata = new FormData (this);
            var tags = $('#tags').val();
            formdata.append('tags',tags);
            var episodeLength  = $(document).find(".episode-main-box").length;
            //var episodeFiles = new Array();
            var allFiles = new Array();
            if(episodeLength > 0){
              
              $(document).find(".episode-main-box").each(function(index,value){
                var instanceKey =  $(this).find(".my-dropzone").attr("id");
                var array_key = instanceKey.split("_")[1];
                if(instanceKey in dropzoneInstances){
                  currentInstance = dropzoneInstances[instanceKey];
                  var fileVals =  currentInstance.getAcceptedFiles();
                  fileVals.forEach(function(file,key) {
                    formdata.append('episodes['+array_key+'][images]['+key+']', file);
                  });
                }
              });
            }  


            
            $.ajax({
                headers :{
                    'X-CSRF-TOKEN' : $("meta[name=csrf-token]").attr('content')
                },
                url:url,
                method:'POST',
                data : formdata,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(response){
                    showLoader();
                },
                success:function(response){
                      $("#addForm").trigger("reset");
                      Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'Okay!'
                      }).then((result) => {
                        location.reload();  
                      })
                },
                error:function(jqXHR,exception){
                    if(jqXHR.status == 422){
                        $(".errors").remove();
                        $.each(jqXHR.responseJSON.errors,function(index,value){
                            if(index.indexOf(".") != -1){
                                index = index.replace(/([.])+/g, '_');index.replace(".", '_');
                            }
                            console.log(index);
                            $("#"+index).parents(".form-group").append("<span class='text-danger errors'>"+value+"</span>");
                            
                        });
                    }else{
                        toastr.error(jqXHR.responseJSON.message, '{{trans("global.alert.error")}}');
                        location.reload();
                    }
                },
                complete:function(){
                  hideLoader();
                }
            });
          });
          

          $(document).on("submit","#editForm",function(e){
              e.preventDefault();
              var url = $(this).attr('action');
              var formdata = new FormData (this);
              var tags = $('#tags').val();
              formdata.append('tags',tags);
              var episodeLength  = $(document).find(".episode-main-box").length;
              console.log(dropzoneInstances,episodeLength);
              if(episodeLength > 0){
                $(document).find(".episode-main-box").each(function(index,value){
                  var instanceKey =  $(this).find(".my-dropzone").attr("id");
                  var array_key = instanceKey.split("_")[1];
                  if(instanceKey in dropzoneInstances){
                    currentInstance = dropzoneInstances[instanceKey];
                    var fileVals =  currentInstance.getAcceptedFiles();
                    fileVals.forEach(function(file,key) {
                      formdata.append('episodes['+array_key+'][images]['+key+']', file);
                    });
                    console.log(fileVals);
                  }
                });
              }  
              $.ajax({
                  headers :{
                      'X-CSRF-TOKEN' : $("meta[name=csrf-token]").attr('content')
                  },
                  url:url,
                  method:'post',
                  data : formdata,
                  contentType: false,
                  cache: false,
                  processData: false,
                  beforeSend:function(response){
                      $('.overlay').show();
                  },
                  success:function(response){
                      $('.overlay').hide();
                        $("#addForm").trigger("reset");
                        Swal.fire({
                          title: 'Success',
                          text: response.message,
                          icon: 'success',
                          confirmButtonText: 'Okay!'
                        }).then((result) => {
                          location.reload();  
                        })
                  },
                  error:function(jqXHR,exception){
                      $('.overlay').hide();
                      if(jqXHR.status == 422){
                          $(".errors").remove();
                          $.each(jqXHR.responseJSON.errors,function(index,value){
                            if(index.indexOf(".") != -1){
                                index = index.replace(/([.])+/g, '_');index.replace(".", '_');
                            }

                            console.log(index);
                            $("#"+index).parents(".form-group").append("<span class='text-danger errors'>"+value+"</span>");
                            
                        });
                      }else{
                          toastr.error(jqXHR.responseJSON.message, trans("global.alert.error"));
                      }
                  }
              });
          });

          $("#addepisode").click(function() {
              var editorCount = parseInt($(document).find("#editorCount").val());
              console.log(editorCount);
              let svg = ' <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x"   width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"/> <path d="M18 6l-12 12" /> <path d="M6 6l12 12" /> </svg>';

              $(".episode-row").append('<div class="col-12 alert fade show episode-main-box newEpisodes"><div class="row"><div class="col-12 col-md-4"><div class="row"><div class="col-md-12"><div class="mb-4"><div class="form-group"><label for="">{{trans("pages.post.form.fields.episode_title")}}<span class="text-danger">*</span></label><input type="hidden" name="episodes['+editorCount+'][id]" value="" class="episode_id"> <input type="text" class="form-control episode_title" name="episodes['+editorCount+'][title]" id="episodes_'+editorCount+'_title" placeholder="{{trans('global.enter')}} {{trans('pages.post.form.fields.episode_title')}}" value=""></div></div></div><div class="col-md-12"><div class="mb-2"><div class="form-group"><label for="">{{trans("pages.post.form.fields.episode_cost")}}<span class="text-danger">*</span></label><input type="number" class="form-control episode_cost" name="episodes['+editorCount+'][cost]" id="episodes_'+editorCount+'_cost" placeholder="{{trans('global.enter')}} {{trans('pages.post.form.fields.episode_cost')}}"></div></div></div></div></div><div class="col-md-8"><div class="editor-wrapper mb-2 form-group"><label for="my-textarea">{{trans("pages.post.form.fields.episode_description")}}<span class="text-danger">*</span></label><textarea name="episodes['+editorCount+'][content]" class="episode-editor episode_content editor'+editorCount+'" id="episodes_'+editorCount+'_content"></textarea></div></div><div class="col-md-12 d-flex remove-box"><a href="#" class="btn btn-primary post-btn remove-btn" data-bs-dismiss="alert" aria-label="Close">'+svg+'</a></div><div class="col-md-12"><div class="form-group"><label for="my-textarea">{{trans("global.upload_pictures")}}</label><div class="my-dropzone dropzone episode_image" id="dropzone_'+editorCount+'" data-id="'+editorCount+'"></div></div></div></div></div>');

              var newEditor = document.querySelector('#episodes_'+editorCount+'_content');              
              ClassicEditor.create(newEditor,{
              toolbar:ckeditorToolbar
             
            });
              var newDropzone = document.querySelector('#dropzone_'+editorCount);
              Dropzone.autoDiscover = false;
              var dropzone = new Dropzone(newDropzone, {
                url: "{% url 'dropzone/images' %}",
                addRemoveLinks: true,
                uploadMultiple:true,
                minFiles: 1,
                autoProcessQueue : false,
                maxFiles: 5,
                acceptedFiles: '.png,.gif,.jpeg,.jpg,.svg',
                dictDefaultMessage: "Put  files here",
                dictRemoveFile: '<i class="fa fa-times mt-2" ><i>',
              }); 
              dropzone.on('addedfile', function(file) {
                $(file.previewElement).addClass('dz-complete');
              })
              dropzoneInstances['dropzone_'+editorCount] = dropzone;
              $("#editorCount").val(++editorCount);

          });
      });
  </script>

       

