<div class="row">
    <div class="col-4">
        <div id="filterContainer-daterange">
            <label for="dateRangePicker">{{__('cruds.statistics.statistics_filteration.daterange_title')}}</label>
            <input class="form-control" type="text" id="dateRangePicker" name="dateRangePicker" />
        </div>
    </div>
    <div class="col-4">
        <div id="filterContainer">
            <label for="filter">{{__('cruds.statistics.statistics_filteration.title')}}</label>
            <select id="filter" class="form-control">
                <option value="day">{{__('cruds.statistics.statistics_filteration.day')}}</option>
                <option value="week" selected>{{__('cruds.statistics.statistics_filteration.week')}}</option>
                <option value="month">{{__('cruds.statistics.statistics_filteration.month')}}</option>
            </select>
        </div>
    </div>
</div>