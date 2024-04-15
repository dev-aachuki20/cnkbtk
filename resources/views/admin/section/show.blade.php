@extends('layouts.admin')
@section('content')
<div class="content-wrapper faq-wrap">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Section</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.section.index')}}">Section</a></li>
              <li class="breadcrumb-item active">View Section</li>
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
                        <h3 class="card-title">View Section</h3>
                    </div>
                    <div class="card-body" style="padding:0px;">
                        <div class="table-responsive">
                            <table class="table">
                               <tbody>
                                    <tr>
                                        <th>Title English</th>
                                        <td>{{ $section->name_en }}</td>
                                    </tr>
                                    <tr>
                                        <th>Title Chinese</th>
                                        <td>{{ $section->name_ch }}</td>
                                    </tr>

                                    <tr>
                                        <th>Description English</th>
                                        <td>{{ $section->description_en }}</td>
                                    </tr>

                                    <tr>
                                        <th>Description Chinese</th>
                                        <td>{{ $section->description_ch }}</td>
                                    </tr>

                                    <tr>
                                        <th>Creator can post ? </th>
                                        <td>
                                            @if($section->status == 1)
                                                <span class="badge badge-info mr-1">Yes</span>
                                            @else 
                                                <span class="badge badge-danger mr-1">No</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if($section->status == 1)
                                                <span class="badge badge-info mr-1">Active</span>
                                            @else 
                                                <span class="badge badge-danger mr-1">In-active</span>
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
