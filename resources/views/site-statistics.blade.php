@extends('layouts.app')
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('content')
@php
$siteSettingData = getSiteSetting();
@endphp
<!-- hero privacy  -->
<section class="privacy-hero">
  <div class="container">
    <div class="hero-banner">
      <div class="prc-title">
        <h2>{{trans("pages.site_statistics.basic")}} <span>{{trans("pages.site_statistics.profile")}}</span></h2>
      </div>
    </div>
  </div>
</section>
<!-- end  -->

<section class="breadcrumb-wrap">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">{{trans("global.home")}}</a></li>
        <li class="breadcrumb-item active">
          {{trans("pages.site_statistics.site")}}
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          {{trans("cruds.registered_members.title")}}
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
                <h4>{{trans("cruds.statistics.title")}}</h4>
              </div>
              <div class="tag-listing">
                <ul class="nav nav-tabs" id="myTab" role="tablist">

                  <li class="nav-item" role="presentation">
                    <button data-id="{{ route('admin.statistics.members-registration',['range'=>'week'] ) }}" data-route="{{ route('admin.statistics.members-registration') }}" class="nav-link filter-tabs active" id="registered-members" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                      {{trans("cruds.registered_members.title")}}
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button data-id="{{ route('admin.statistics.number-posters',['range'=>'week'] ) }}" data-route="{{ route('admin.statistics.number-posters') }}" class="nav-link filter-tabs" id="number-posters" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                      {{trans("cruds.number_of_posts.title")}}
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button data-id="{{ route('admin.statistics.popular-posters',['range'=>'week'] ) }}" data-route="{{ route('admin.statistics.popular-posters') }}" class="nav-link filter-tabs" id="popular-posters" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                      {{trans("cruds.most_popular_poster.title")}}
                    </button>
                  </li>

                  <li class="nav-item" role="presentation">
                    <button data-id="{{ route('admin.statistics.visiting-users',['range'=>'week'] ) }}" data-route="{{ route('admin.statistics.visiting-users') }}" class="nav-link filter-tabs" id="visit-users" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                      {{trans("cruds.visiting_users.title")}}
                    </button>
                  </li>

                  <li class="nav-item" role="presentation">
                    <button data-id="{{ route('admin.statistics.mobile-access',['range'=>'week'] ) }}" data-route="{{ route('admin.statistics.mobile-access') }}" class="nav-link filter-tabs" id="mobile-access" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                      {{trans("cruds.mobile_access.title")}}
                    </button>
                  </li>

                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-8 col-lg-9 col-xl-9">
        @include('statistics.filteration')
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#filter').val('week');

      $('.filter-tabs').click(function() {
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
        $('#filter').val('week');
        $('#filter').change();
      });

      $('#dateRangePicker').daterangepicker({
        maxDate: new Date(),
        locale: {
          format: 'DD/MM/YYYY',
          cancelLabel: '{{ __("cruds.global.cancel") }}',
          applyLabel: '{{ __("cruds.global.apply") }}',
          daysOfWeek: [
            '{{ __("global.days_of_week.sunday") }}',
            '{{ __("global.days_of_week.monday") }}',
            '{{ __("global.days_of_week.tuesday") }}',
            '{{ __("global.days_of_week.wednesday") }}',
            '{{ __("global.days_of_week.thursday") }}',
            '{{ __("global.days_of_week.friday") }}',
            '{{ __("global.days_of_week.saturday") }}'
          ],
          monthNames: [
            '{{ __("global.month_names.january") }}',
            '{{ __("global.month_names.february") }}',
            '{{ __("global.month_names.march") }}',
            '{{ __("global.month_names.april") }}',
            '{{ __("global.month_names.may") }}',
            '{{ __("global.month_names.june") }}',
            '{{ __("global.month_names.july") }}',
            '{{ __("global.month_names.august") }}',
            '{{ __("global.month_names.september") }}',
            '{{ __("global.month_names.october") }}',
            '{{ __("global.month_names.november") }}',
            '{{ __("global.month_names.december") }}'
          ],
          firstDay: 0
        }
      });

      function loadData(url) {
        $.ajax({
          url: url,
          type: 'GET',
          success: function(response) {
            $(".profile-content").html(response.html);
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      }

      $('.filter-tabs').click(function() {
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
        var url = $(this).data('id');
        loadData(url);
      });
      
      $(".filter-tabs:first").trigger('click');

      $('#dateRangePicker').on('apply.daterangepicker', function(ev, picker) {
        var startDate = picker.startDate.format('YYYY-MM-DD');
        var endDate = picker.endDate.format('YYYY-MM-DD');
        var range = $('#filter').val();
        var activeUrl = $('.filter-tabs.active').data('id');
        $.ajax({
          url: activeUrl,
          type: 'GET',
          data: {
            start_date: startDate,
            end_date: endDate,
            range: range,
          },
          success: function(response) {
            $(".profile-content").html(response.html);
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      });

      $(document).on('change', '#filter', function() {
        var filter = this.value;
        // var startDate = $('#dateRangePicker').data('daterangepicker').startDate.format('YYYY-MM-DD');
        // var endDate = $('#dateRangePicker').data('daterangepicker').endDate.format('YYYY-MM-DD');
        var activeRoute = $('.filter-tabs.active').data('route');

        // Determine the route based on the active tab
        var url = activeRoute + '/' + filter;

        $.ajax({
          url: url,
          type: 'GET',
          data: {
            range: filter,
          },
          success: function(response) {
            $(".profile-content").html(response.html);
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      });
    });
  </script>
  @endsection