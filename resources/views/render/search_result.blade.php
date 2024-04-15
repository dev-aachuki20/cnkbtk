    <ul class="searchbox-listing-wrap {{$results->count() > 3 ? 'search-scroll' :''}}" id="serachResult" >
        @forelse ($results as $result)
            @php 
                $posterImage = asset('front/asset/images/no_image.png');
                if(isset($result->uploads) && !empty($result->uploads) && count($result->uploads) > 0){
                    $posterImage = asset('storage/'.$result->uploads->first()->path );
                } 
                
            @endphp
            <li>
                <a href="{{route('post.details',$result->slug)}}" class="searchbox-link">
                    <div class="avtar-icon">
                        <img class="img-fluid" src="{{$posterImage}}" alt="">
                    </div>
                    <div class="avtar-content">
                        <h5>{{$result->title}}</h5>
                        <span>{{$result->userDetails->user_name}}</span>
                    </div>
                </a>
            </li>
        @empty
            <li><a href="javascript:void(0)"><span>{{trans("global.data_not_available")}}</span></a></li>
        @endforelse
    </ul>
    
    
    
    


   