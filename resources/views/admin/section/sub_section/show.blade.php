@extends('layouts.admin')
@section('content')
<div class="content-wrapper faq-wrap">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{trans("cruds.global.view")}} {{trans("cruds.section_management.sub_section.title_singular")}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
              <li class="breadcrumb-item">{{trans("cruds.section_management.title_singular")}}</li>
              <li class="breadcrumb-item active">{{trans("cruds.global.view")}} {{trans("cruds.section_management.sub_section.title_singular")}}</li>
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
                        <h3 class="card-title">{{trans("cruds.global.view")}} {{trans("cruds.section_management.sub_section.title_singular")}}</h3>
                    </div>
                    <div class="card-body" style="padding:0px;">
                        <div class="table-responsive">
                            <table class="table">
                               <tbody>
                                    <tr>
                                        <th>{{trans("cruds.section_management.sub_section.fields.title")}} <small>({{trans("cruds.lang.english")}})</small></th>
                                        <td>{{ $section->name_en }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{trans("cruds.section_management.sub_section.fields.title")}} <small>({{trans("cruds.lang.chinese")}})</small></th>
                                        <td>{{ $section->name_ch }}</td>
                                    </tr>

                                    <tr>
                                        <th>{{trans("cruds.section_management.sub_section.fields.description")}} <small>({{trans("cruds.lang.english")}})</small></th>
                                        <td>{!! nl2br($section->description_en) !!}</td>
                                    </tr>

                                    <tr>


                                        <th>{{trans("cruds.section_management.sub_section.fields.description")}} <small>({{trans("cruds.lang.chinese")}})</small></th>
                                        <td>{!! nl2br( $section->description_ch) !!}</td>
                                    </tr>

                                    <tr>
                                        <th>{{trans("cruds.section_management.sub_section.fields.parent_section")}} <small>({{trans("cruds.lang.english")}})</small></th>
                                        <td>{{ $section->parent_category->name_en }}</td>
                                    </tr>

                                    <tr>
                                        <th>{{trans("cruds.section_management.sub_section.fields.parent_section")}} <small>({{trans("cruds.lang.chinese")}})</small></th>
                                        <td>{{ $section->parent_category->name_ch }}</td>
                                    </tr>
                                    @php 
                                        
                                        if(isset($section->uploads) && !empty($section->uploads) && count($section->uploads) > 0){
                                            $imagePath = asset('storage/'. $section->uploads->first()->path );
                                        } else {
                                            $imagePath = null;
                                        }
                                       
                                    @endphp
                                    <tr>
                                        <th>{{trans("cruds.section_management.sub_section.fields.section_logo")}}</th>
                                        <td>
                                           
                                            <img class="profile-user-img img-fluid" src="{{$imagePath}}" alt="Image" id="preview" style="{{ empty($imagePath) ? 'display:none;' : ''}}">
                                          
                                        </td>
                                    </tr>
                              
                                    <tr>
                                        <th>{{trans("cruds.section_management.sub_section.fields.creator_can_post")}}</th>
                                        <td>
                                            @if($section->creator_can_post == 1)
                                                <span class="badge badge-info mr-1">{{trans("cruds.global.yes")}}</span>
                                            @else 
                                                <span class="badge badge-danger mr-1">{{trans("cruds.global.no")}}</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>{{trans("cruds.section_management.sub_section.fields.user_can_post")}}</th>
                                        <td>
                                            @if($section->user_can_post == 1)
                                                <span class="badge badge-info mr-1">{{trans("cruds.global.yes")}}</span>
                                            @else 
                                                <span class="badge badge-danger mr-1">{{trans("cruds.global.no")}}</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>{{trans("cruds.section_management.sub_section.fields.show_in_header")}} </th>
                                        <td>
                                            @if($section->show_in_header == 1)
                                                <span class="badge badge-info mr-1">Y{{trans("cruds.global.yes")}}</span>
                                            @else 
                                                <span class="badge badge-danger mr-1">{{trans("cruds.global.no")}}</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>{{trans("cruds.section_management.sub_section.fields.show_in_footer")}}</th>
                                        <td>
                                            @if($section->show_in_footer == 1)
                                                <span class="badge badge-info mr-1">{{trans("cruds.global.yes")}}</span>
                                            @else 
                                                <span class="badge badge-danger mr-1">{{trans("cruds.global.no")}}</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>{{trans("cruds.global.status")}}</th>
                                        <td>
                                            @if($section->status == 1)
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
