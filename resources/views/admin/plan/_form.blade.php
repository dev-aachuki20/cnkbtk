<div class="card-body">

    <div class="row">

        <div class="form-group {{ $errors->has('title_en') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.plan.fields.title")}}  ({{trans("cruds.lang.english")}})<span class="required">*</span></label>
            <input type="text"    name="title_en" value="{{ old('title_en', isset($plan->title_en) ? $plan->title_en : '') }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{trans("cruds.plan.fields.title")}}">
            @if ($errors->has('title_en'))
                <span class="text-danger">{{ $errors->first('title_en') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('title_ch') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.plan.fields.title")}}  ({{trans("cruds.lang.chinese")}})<span class="required">*</span></label>
            <input type="text"  name="title_ch" value="{{ old('title_ch', isset($plan->title_ch) ? $plan->title_ch : '') }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{trans("cruds.plan.fields.title")}}">
            @if ($errors->has('title_ch'))
                <span class="text-danger">{{ $errors->first('title_ch') }}</span>
            @endif
        </div>



        <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.plan.fields.amount")}} <span class="required">*</span></label>
            <input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"   name="amount" value="{{ old('amount', isset($plan->amount) ? $plan->amount : '') }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{trans("cruds.plan.fields.amount")}}">
            @if ($errors->has('amount'))
                <span class="text-danger">{{ $errors->first('amount') }}</span>
            @endif
        </div> 


        <div class="form-group {{ $errors->has('points') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.plan.fields.points")}} <span class="required">*</span></label>
            <input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"   name="points" value="{{ old('points', isset($plan->points) ? $plan->points : '') }}" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{trans("cruds.plan.fields.points")}}">
            @if ($errors->has('points'))
                <span class="text-danger">{{ $errors->first('points') }}</span>
            @endif
        </div> 

        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} col-md-6">
            <label>{{trans("cruds.global.status")}}  <span class="text-danger" >*</span></label>
            <select class="form-control" name="status">
                <option value="1" {{isset($section) ? $section->status == 1  ?  'selected' : '' : ''}}>{{trans("cruds.global.active")}}</option>
                <option value="0" {{isset($section) ? $section->status == 0  ?  'selected' : '' : ''}}>{{trans("cruds.global.in_active")}}</option>
            </select>
            @if($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
            @endif
        </div>  


    </div>

</div>

<div class="card-footer">

    <button type="submit" class="btn btn-primary">{{isset($section) ? trans("cruds.global.update") : trans("cruds.global.save")}}</button>

</div>