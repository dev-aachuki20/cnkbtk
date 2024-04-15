@extends('layouts.admin')
@section('content')
<div class="content-wrapper faq-wrap">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{trans("cruds.global.view")}} {{trans("cruds.tag_management.tag_type.title_singular")}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
              <li class="breadcrumb-item">{{trans("cruds.tag_management.title_singular")}}</li>
              <li class="breadcrumb-item active">{{trans("cruds.global.view")}} {{trans("cruds.tag_management.tag_type.title_singular")}}</li>
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
                        <h3 class="card-title">{{trans("cruds.global.view")}} {{trans("cruds.tag_management.tag_type.title_singular")}}</h3>
                    </div>
                    <div class="card-body" style="padding:0px;">
                        <div class="table-responsive">
                            <table class="table">
                               <tbody>
                                    <tr>
                                        <th>{{trans("cruds.tag_management.tag.fields.title")}} <small>({{trans("cruds.lang.english")}})</small></th>
                                        <td>{{ $tag->name_en }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{trans("cruds.tag_management.tag.fields.title")}} <small>({{trans("cruds.lang.chinese")}})</small></th>
                                        <td>{{ $tag->name_ch }}</td>
                                    </tr>

                                    <tr>
                                        <th>{{trans("cruds.tag_management.tag.fields.tag_type")}} <small>({{trans("cruds.lang.english")}})</small></th>
                                        <td>{{ $tag->type->name_en}}</td>
                                    </tr>

                                    <tr>
                                        <th>{{trans("cruds.tag_management.tag.fields.tag_type")}} <small>({{trans("cruds.lang.chinese")}})</small></th>
                                        <td>{{ $tag->type->name_ch }}</td>
                                    </tr>
                                   
                              
                                    <tr>
                                        <th>{{trans("cruds.global.status")}}</th>
                                        <td>
                                            @if($tag->status == 1)
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
