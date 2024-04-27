@extends('layouts.app')
@section('content')
<section class="privacy-hero">
  <div class="container">
    <div class="hero-banner">
      <div class="prc-title">
        <h2>{{trans("global.add")}} {{trans("pages.user.blacklist_user_tab.blacklist")}} <span>{{trans("pages.user.blacklist_user_tab.user")}}</span></h2>
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
        <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans("global.home")}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">
          {{trans("global.add")}} {{trans("pages.user.blacklist_user_tab.blacklist_users")}}
        </li>
      </ol>
    </nav>
  </div>
</section>
<!-- End breadcrumb  -->

<section class="edit-post-wrapper py-5">
  <div class="container">
    <div class="card">
      <div class="card-header"> {{trans("global.add")}} {{trans("pages.user.blacklist_user_tab.user")}}</div>
      <div class="card-body">
        <div class="edit-inner-box">
          <form method="POST" data-url="{{ route('blacklist.user.store') }}" id="addBlacklistForm">
            @include("blacklist-user._form")
          </form>
        </div>
      </div>
    </div>
  </div>

</section>
@endsection

@section("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="{{ asset('admins/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
  $(document).ready(function() {
    $(document).on("submit", "#addBlacklistForm", function(e) {
      e.preventDefault();
      var url = $(this).data('url');
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
          $("#addBlacklistForm").trigger("reset");
          Swal.fire({
            title: 'Success',
            text: response.message,
            icon: 'success',
            confirmButtonText: 'Okay!'
          }).then((result) => {
            location.reload();
          })
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
            location.reload();
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