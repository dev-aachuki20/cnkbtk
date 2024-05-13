@extends('layouts.app')
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
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
                    <button data-id="{{ route('admin.statistics.members-registration',['range'=>'week'] ) }}" data-route="{{ route('admin.statistics.members-registration') }}" class="nav-link filter-tabs aclink active" id="registered-members" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                      {{trans("cruds.registered_members.title")}}
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button data-id="{{ route('admin.statistics.number-posters',['range'=>'week'] ) }}" data-route="{{ route('admin.statistics.number-posters') }}" class="nav-link filter-tabs aclink" id="number-posters" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                      {{trans("cruds.number_of_posts.title")}}
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button data-id="{{ route('admin.statistics.popular-posters',['range'=>'week'] ) }}" data-route="{{ route('admin.statistics.popular-posters') }}" class="nav-link filter-tabs aclink" id="popular-posters" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                      {{trans("cruds.most_popular_poster.title")}}
                    </button>
                  </li>

                  <li class="nav-item" role="presentation">
                    <button data-id="{{ route('admin.statistics.visiting-users',['range'=>'week'] ) }}" data-route="{{ route('admin.statistics.visiting-users') }}" class="nav-link filter-tabs aclink" id="visit-users" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                      {{trans("cruds.visiting_users.title")}}
                    </button>
                  </li>

                  <li class="nav-item" role="presentation">
                    <button data-id="{{ route('admin.statistics.mobile-access',['range'=>'week'] ) }}" data-route="{{ route('admin.statistics.mobile-access') }}" class="nav-link filter-tabs aclink" id="mobile-access" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
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
        <div class="mb-4">
          <div class="profile-content">
            <div class="tab-content" id="myTabContent">
            </div>
          </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
  $(document).ready(function() {
    $('#tagtype').select2({
      placeholder: "{{__('global.search')}}",
      allowClear: true
    });

    $('.filter-tabs').click(function() {
      $('.aclink').removeClass('active');
      $(this).addClass('active');
      $('#tagtype').val(null).trigger('change.select2');
      var activeMenu = $(this).attr('id');
      toggleTagTypeDropdown(activeMenu);
      var url = $(this).data('id');
      loadData(url);
    });

    $(".filter-tabs:first").trigger('click');

    function loadData(url) {
      $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
          $(".profile-content").html(response.html);
          // daterange picker
          $('#dateRangePicker').daterangepicker({
            maxDate: new Date(),
            // autoUpdateInput: false,
            startDate: moment().subtract(6, 'days'),
            endDate: moment(),
            ranges: {
              '{{ __("cruds.statistics.statistics_filteration.day") }}': [moment(), moment()],
              '{{ __("cruds.statistics.statistics_filteration.week") }}': [moment().subtract(6, 'days'), moment()],
              '{{ __("cruds.statistics.statistics_filteration.month") }}': [moment().startOf('month'), moment().endOf('month')]
            },
            locale: {
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
              firstDay: 0,
              customRangeLabel: '{{ __("cruds.statistics.statistics_filteration.custom_range") }}'
            }
          });

          $('#dateRangePicker').on('apply.daterangepicker', function(ev, picker) {
            handleFilterChange(picker.startDate, picker.endDate, picker.chosenLabel);
          });
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    }

    $(document).on('change', '#tagtype', function() {
      var tagTypes = $(this).val();
      // label = picker.chosenLabel;
      label = "week";
      if (tagTypes) {
        var activeRoute = $('.filter-tabs.active').data('route');
        var url = activeRoute + '/' + label;
        $.ajax({
          url: url,
          type: 'GET',
          data: {
            range: label,
            tag_type: tagTypes,
          },
          success: function(response) {
            $(".profile-content").html(response.html);
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      }
    });

    function toggleTagTypeDropdown(activeMenu) {
      if (activeMenu === 'number-posters') {
        $('.tagtype-container').css('display', 'block');
        $('.purchase-container').css('display', 'none');
      } else if (activeMenu === 'popular-posters') {
        $('.tagtype-container').css('display', 'block');
        $('.purchase-container').css('display', 'block');
      } else {
        $('.tagtype-container').css('display', 'none');
        $('.purchase-container').css('display', 'none');
      }
    }

    // daterange picker
    // Function to handle the filter change
    function handleFilterChange(start, end, label) {
      label = label.toLowerCase();
      var startDate = start.format('YYYY-MM-DD');
      var endDate = end.format('YYYY-MM-DD');
      if (label === 'month' || label === 'week' || label === 'day') {
        var activeRoute = $('.filter-tabs.active').data('route');
        var url = activeRoute + '/' + label;
        $.ajax({
          url: url,
          type: 'GET',
          data: {
            range: label,
          },
          success: function(response) {
            $(".profile-content").html(response.html);
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      } else {
        var startDate = start.format('YYYY-MM-DD');
        var endDate = end.format('YYYY-MM-DD');
        var activeUrl = $('.filter-tabs.active').data('id');
        var url = activeRoute + '/' + label;
        $.ajax({
          url: activeUrl,
          type: 'GET',
          data: {
            start_date: startDate,
            end_date: endDate,
            range: label,
          },
          success: function(response) {
            $(".profile-content").html(response.html);
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      }
      // console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    }

  });
</script>
@endsection