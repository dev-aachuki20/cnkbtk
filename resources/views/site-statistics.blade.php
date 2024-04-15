@extends('layouts.app')
@section('content')
@php 
    $siteSettingData = getSiteSetting();
@endphp
 <!-- hero privacy  -->
  <section class="privacy-hero">
    <div class="container">
      <div class="hero-banner">
        <div class="prc-title">
          <h2>Basic <span>profile</span></h2>
        </div>
      </div>
    </div>
  </section>
  <!-- end  -->

  <section class="breadcrumb-wrap">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</a></li>
          <li class="breadcrumb-item active">
            Site statistics
          </li>
          <li class="breadcrumb-item active" aria-current="page">
          Registered Members
          </li>
        </ol>
      </nav>
    </div>
  </section>

  <div class="profile-wrapper-cp">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-4 col-lg-3 col-xl-3">
          <div class="following-list">
            <div class="popular-tag profile-wrap">
              <div class="inner-popular">
                <div class="title">
                  <h4>Site statistics</h4>
                </div>
                <div class="tag-listing">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    
                    <li class="nav-item" role="presentation">
                      <button data-id="{{ route('admin.statistics.members-registration',['range'=>'week'] ) }}" class="nav-link filter-tab-first" id="registered-members" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                          Registered Members
                      </button>
                  </li>
                  <li class="nav-item" role="presentation">
                      <button data-id="{{ route('admin.statistics.number-posters',['range'=>'day'] ) }}" class="nav-link filter-tabs" id="number-posters" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                      Number Of Posts
                      </button>
                  </li>
                  <li class="nav-item" role="presentation">
                      <button data-id="{{ route('admin.statistics.popular-posters',['range'=>'day'] ) }}" class="nav-link filter-tabs" id="popular-posters" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                      Most Popular Posters
                      </button>
                    </li>
                  
                    <li class="nav-item" role="presentation">
                      <button data-id="{{ route('admin.statistics.visiting-users',['range'=>'day'] ) }}" class="nav-link filter-tabs" id="visit-users" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                      Visiting Users
                      </button>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                      <button data-id="{{ route('admin.statistics.mobile-access',['range'=>'day'] ) }}" class="nav-link filter-tabs" id="mobile-access" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                          Mobile Access
                      </button>
                    </li>
                    
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-8 col-lg-9 col-xl-9">
          <div class="profile-content">
            <div class="tab-content" id="myTabContent">
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection
  @section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
      $(document).ready(function() {
                $('.filter-tab-first').click(function() {
                    var url = $(this).data('id');
                    loadData(url);
                });
                $("#registered-members").trigger('click');
                $('.filter-tab-first').hover(function() {
                    $(this).addClass('active');
                }, function() {
                    $(this).removeClass('active');
                });
            });

        function loadData(url) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        $(".profile-content").html(response.html);
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        
                    }
                });
           }

        $(document).ready(function() {
            $('#number-posters').click(function() {
              var url = $(this).data('id');
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                      $(".profile-content").html(response.html);
                        console.log( response);
                    },
                    error: function(xhr, status, error) {
                      
                        console.error(error);
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#visit-users').click(function() {
              var url = $(this).data('id');
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                      $(".profile-content").html(response.html);
                        console.log( response);
                    },
                    error: function(xhr, status, error) {
                      
                        console.error(error);
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#popular-posters').click(function() {
              var url = $(this).data('id');
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                      $(".profile-content").html(response.html);
                        console.log( response);
                    },
                    error: function(xhr, status, error) {
                      
                        console.error(error);
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#mobile-access').click(function() {
              var url = $(this).data('id');
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                      $(".profile-content").html(response.html);
                        console.log( response);
                    },
                    error: function(xhr, status, error) {
                      
                        console.error(error);
                    }
                });
            });
        });

</script>
@endsection