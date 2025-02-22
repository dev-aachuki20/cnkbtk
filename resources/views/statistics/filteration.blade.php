<div class="row">
    <div class="col-12 col-sm-6 col-md-6 col-lg-4 static-inputs date-range-container">
        <div id="filterContainer-daterange">
            <label for="dateRangePicker">{{__('cruds.statistics.statistics_filteration.daterange_title')}}</label>
            <input class="form-control" type="text" id="dateRangePicker" name="dateRangePicker" />
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-6 col-lg-4 static-inputs tagtype-container" style="display: none;">
        <div id="filterContainer">
            <label for="tagtype">{{__('cruds.statistics.statistics_filteration.tag_type_title')}}</label>
            <select id="tagtype" class="form-control form-select" multiple="multiple">
                @if($tagTypes->where('status', 1)->count() > 0)
                @foreach ($tagTypes->where('status', 1) as $tagType)
                <option value="{{ $tagType->id }}">{{app()->getLocale() == 'en'  ? $tagType->name_en : $tagType->name_ch }} </option>
                @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-6 col-lg-4 static-inputs purchase-container" style="display: none;">
        <div id="filterContainer">
            <label for="tagtype-most-popular">{{__('cruds.statistics.statistics_filteration.filter')}}</label>
            <select id="tagtype-most-popular" class="form-control form-select">
                {{-- <option value="">{{__('cruds.statistics.statistics_filteration.all')}}</option> --}}
                <option value="visited">{{__('cruds.statistics.statistics_filteration.visited')}}</option>
                <option value="purchased">{{__('cruds.statistics.statistics_filteration.purchased')}}</option>
            </select>
        </div>
    </div>
</div>