@extends('layouts.admin')
@section('styles')

@endsection
@section('content')
<div class="content-wrapper faq-wrap">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Enquiry</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans("global.dashboard")}}</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.contactusEnquiry')}}">Contact Us Enquiries</a></li>
              <li class="breadcrumb-item active">View Enquiry</li>
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
                        <h3 class="card-title">View Enquiry</h3>
                    </div>
                    <div class="card-body" style="padding:0px;">
                        <div class="table-responsive">
                            <table class="table">
                               <tbody>
                                    <tr>
                                        <th>First Name</th>
                                        <td>{{ $contactus->fname }}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Name</th>
                                        <td>{{ $contactus->lname }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $contactus->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone No</th>
                                        <td>{{ $contactus->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Message</th>
                                        <td>{!! nl2br($contactus->message) !!}</td>
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

<script>
$(document).ready(function () {
    
});
</script>

@endsection