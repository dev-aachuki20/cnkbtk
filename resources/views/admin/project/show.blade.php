@extends('layouts.admin')
@section('content')
<div class="content-wrapper faq-wrap">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{trans("cruds.global.view")}} {{trans('cruds.create_project.project_details')}}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
            <li class="breadcrumb-item active">{{trans("cruds.global.view")}} {{trans('cruds.create_project.project_details')}}</li>
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
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{trans("cruds.global.view")}} {{trans('cruds.create_project.project_details')}}</h3>
            </div>
            @if(isset($project))
            <div class="card-body" style="padding:0px;">
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <th>{{trans("cruds.create_project.fields.user_name")}}</th>
                      <td>{{ ucfirst($project->user->user_name)  ?? ''}}</td>
                    </tr>

                    <tr>
                      <th>{{trans("cruds.create_project.fields.user_ip")}}</th>
                      <td>{{ $project->user_ip ?? ''}}</td>
                    </tr>

                    <tr>
                      <th>{{trans("cruds.create_project.fields.type")}}</th>
                      <td>{{ $project->type  ?? ''}}</td>
                    </tr>

                    <tr>
                      <th>{{trans("cruds.create_project.fields.tags")}}</th>
                      <td>
                        @if(app()->getLocale() == 'en')
                        {{ $project->tags->name_en ?? '' }}
                        @else
                        {{ $project->tags->name_ch ?? '' }}
                        @endif
                      </td>
                    </tr>

                    <tr>
                      <th>{{trans("cruds.create_project.fields.budget")}}</th>
                      <td>{{ $project->budget  ?? ''}} CN¥</td>
                    </tr>

                    <tr>
                      <th>{{trans("cruds.create_project.fields.creators")}}</th>
                      <td> @foreach ($project->creators as $creator)
                        {{ $creator->user_name }}
                        @endforeach
                      </td>
                    </tr>

                    <tr>
                      <th>{{trans("cruds.create_project.fields.description")}}</th>
                      <td>{!! $project->comment ?? '' !!}</td>
                    </tr>

                    <tr>
                      <th>{{trans("cruds.global.status")}}</th>
                      <td>
                        @if($project->status == 1)
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
            @endif
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