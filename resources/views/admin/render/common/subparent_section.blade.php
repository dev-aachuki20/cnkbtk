        <option value="">--{{trans('global.select')}}--</option>
        @foreach($datas as $data)
            <option value="{{$data->id}}">{{$data->name}}</option>
        @endforeach