<div class="row">
    <div class="col-12 col-md-6 static-inputs date-range-container">
        <div id="filterContainer-daterange">
            <label for="dateRangePicker">{{__('cruds.statistics.statistics_filteration.daterange_title')}}</label>
            <input class="form-control" type="text" id="dateRangePicker" name="dateRangePicker" />
        </div>
    </div>

    <div class="col-12 col-md-6 static-inputs tagtype-container" style="display: none;">
        <div id="filterContainer">
            <label for="tagtype">{{__('cruds.statistics.statistics_filteration.tag_type_title')}}</label>
            <select id="tagtype" class="form-control form-select" multiple="multiple">
                @if($tagTypes->count() > 0)
                @foreach ($tagTypes as $tagType)
                <option value="{{ $tagType->id }}">{{app()->getLocale() == 'en'  ? $tagType->name_en : $tagType->name_ch }} </option>
                @endforeach
                @endif
            </select>
        </div>
    </div>
</div>
