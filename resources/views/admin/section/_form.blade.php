<div class="card-body">

    <div class="row">

        <div class="form-group {{ $errors->has('name_en') ? 'has-error' : '' }} col-md-6">
            <label>Title <span style="font-size:12px;">&nbsp;(English)</span> <span class="required">*</span></label>
            <input type="text" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/(\..*)\./g, '$1');"   name="name_en" value="{{ old('name_en', isset($section->name_en) ? $section->name_en : '') }}" class="form-control"  placeholder="Enter Title English *">
            @if ($errors->has('name_en'))
                <span class="text-danger">{{ $errors->first('name_en') }}</span>
            @endif
        </div> 

        <div class="form-group {{ $errors->has('name_ch') ? 'has-error' : '' }} col-md-6">
            <label>Title Chinese <span class="required">*</span></label>
            <input type="text"    name="name_ch" value="{{ old('name_ch', isset($section->name_ch) ? $section->name_ch : '') }}" class="form-control"  placeholder="Enter Title Chinese *">
            @if ($errors->has('name_ch'))
                <span class="text-danger">{{ $errors->first('name_ch') }}</span>
            @endif
        </div> 


        <div class="form-group {{ $errors->has('description_en') ? 'has-error' : '' }} col-md-6">
            <label>Description English <span class="required">*</span></label>
            <textarea class="form-control"  name="description_en" placeholder="Enter Description English * " id="description_en" >{{old('description_en', isset($section->description_en) ? $section->description_en : '')}}</textarea>
            @if ($errors->has('description_en'))
                <span class="text-danger">{{ $errors->first('description_en') }}</span>
            @endif
        </div> 



        <div class="form-group {{ $errors->has('description_ch') ? 'has-error' : '' }} col-md-6">
            <label>Description Chinese <span class="required">*</span></label>
            <textarea class="form-control"  name="description_ch" placeholder="Enter Description English * " id="description_ch" >{{old('description_ch', isset($section->description_ch) ? $section->description_ch : '')}}</textarea>
            @if ($errors->has('description_ch'))
                <span class="text-danger">{{ $errors->first('description_ch') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('creator_can_post') ? 'has-error' : '' }} col-md-6">
            <label>Creator can post <span class="text-danger" >*</span></label>
            <select class="form-control" name="creator_can_post">
                <option value="{{config("constant.creatorCanPost.yes")}}" {{isset($section) ? $section->creator_can_post == config("constant.creatorCanPost.yes")  ?  'selected' : '' : ''}}>Yes</option>
                <option value="{{config("constant.creatorCanPost.no")}}" {{isset($section) ? $section->creator_can_post == config("constant.creatorCanPost.no")  ?  'selected' : '' : ''}}>No</option>
            </select>
            @if ($errors->has('creator_can_post'))
                <span class="text-danger">{{ $errors->first('creator_can_post') }}</span>
            @endif
        </div>  


        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} col-md-6">
            <label>Status <span class="text-danger" >*</span></label>
            <select class="form-control" name="status">
                <option value="1" {{isset($section) ? $section->status == 1  ?  'selected' : '' : ''}}>Active</option>
                <option value="0" {{isset($section) ? $section->status == 0  ?  'selected' : '' : ''}}>In-active</option>
            </select>
            @if ($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
            @endif
        </div>     
    </div>

</div>

<div class="card-footer">

    <button type="submit" class="btn btn-primary">{{isset($section) ? 'Update' : 'Save'}}</button>

</div>