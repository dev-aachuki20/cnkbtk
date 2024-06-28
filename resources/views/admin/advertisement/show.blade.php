@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('admins/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection
@section('content')
<div class="content-wrapper faq-wrap">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{trans("cruds.global.view")}} {{trans("cruds.advertisement.title_singular")}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.advertisement.index')}}">{{trans("cruds.advertisement.title")}}</a></li>
              <li class="breadcrumb-item active">{{trans("cruds.global.view")}} {{trans("cruds.advertisement.title_singular")}}</li>
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
          <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{trans("cruds.global.view")}} {{trans("cruds.advertisement.title_singular")}}</h3>
                    </div>
                    <div class="card-body" style="padding:0px;">
                        <div class="table-responsive">
                            <table class="table">
                               <tbody>

                                     @php 
                                        
                                            if(isset($advertisement->image_en) && !empty($advertisement->image_en)){
                                                $imagePath = asset('storage/'. $advertisement->image_en );
                                            } else {
                                                $imagePath = null;
                                            }
                                        @endphp
                                    <tr>
                                        <th>{{trans("cruds.advertisement.fields.image")}} <small>({{trans("cruds.lang.english")}})</small></th>
                                        <td>
                                        <a href="{{ !empty($imagePath) ? $imagePath : ''}}" data-toggle="lightbox" id="lightBox"> 
                                            <img class="profile-user-img img-fluid" src="{{$imagePath}}" alt="Image" id="preview" style="{{ empty($imagePath) ? 'display:none;' : ''}}"></a>
                                        </td>
                                    </tr>

                                    @php 
                                        
                                            if(isset($advertisement->image_ch) && !empty($advertisement->image_ch)){
                                                $imagePath = asset('storage/'. $advertisement->image_ch );
                                            } else {
                                                $imagePath = null;
                                            }
                                        @endphp

                                    <tr>
                                        <th>{{trans("cruds.advertisement.fields.image")}} <small>({{trans("cruds.lang.chinese")}})</small></th>
                                        <td>
                                        <a href="{{ !empty($imagePath) ? $imagePath : ''}}" data-toggle="lightbox" id="lightBox"> 
                                            <img class="profile-user-img img-fluid" src="{{$imagePath}}" alt="Image" id="preview" style="{{ empty($imagePath) ? 'display:none;' : ''}}"></a>
                                        </td>
                                    </tr>
                                    <!-- ucwords(str_replace("_"," ",$advertisement->advertisement_type)) -->
                                    <tr>
                                        <th>{{trans("cruds.advertisement.fields.advertisement_type")}}</th>
                                        <td>@foreach(config("constant.advertisementType") as $key => $value) 
                                                {!! $key ==  $advertisement->advertisement_type  ? $value[app()->getLocale()] : ''   !!}
                                            @endforeach
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>{{trans("cruds.advertisement.fields.url")}}</th>
                                        <td>{{$advertisement->url ?? trans("cruds.global.na") }}</td>
                                    </tr>

                                    <tr>
                                        <th>{{trans("cruds.global.status")}}</th>
                                        <td>
                                            @if($advertisement->status == 1)
                                                <span class="badge badge-info mr-1">{{trans("cruds.global.active")}}</span>
                                            @else 
                                                <span class="badge badge-danger mr-1">{{trans("cruds.global.in_active")}}</span>
                                            @endif
                                        </td>
                                    </tr>
         
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
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
<script src="{{ asset('admins/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<script>
$(document).ready(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            alwaysShowClose: true
        });
    });
});
</script>

@endsection