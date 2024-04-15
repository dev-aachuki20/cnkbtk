 <!-- card-list  -->
  <section class="card-list mb-5">
    <div class="container">
      @if($sections->count() > 0)
        @foreach ($sections as $value)
            <div class="title-box-mid mb-3">
              <h3>{{$value->name}}</h3>
          </div>

          @if($value->subSections->count() > 0)
          <div class="row">
            @foreach ($value->subSections as $subsections)
            <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="card">
                        <a href="{{route('section.page',[$subsections->level,$subsections->slug])}}" class="card-main-wrap">
                          <div class="card-icon">
                            @php 
                                          
                              if(isset($subsections->uploads) && !empty($subsections->uploads) && count($subsections->uploads) > 0){
                                  $imagePath = asset('storage/'. $subsections->uploads->first()->path );
                              } else {
                                  $imagePath = null;
                              }
                              
                          @endphp
                          @if($imagePath)
                            <img class="img-fluid" src="{{$imagePath}}" alt="" />
                          @endif
                            
                          </div>
                          <div class="card-body">
                            <h5 class="card-title" title="{{$subsections->name}}">
                            
                            {{$subsections->name}}
                            </h5>
                            <div class="card-sub-title">
                              <span class="card-text">
                                <b>{{trans("global.number_of_posts")}} :</b> {{$subsections->subSectionPosters->where("status",1)->count()}}
                              </span>
                            </div>
                            <div class="card-discretion">
                              <p>
                                {{$subsections->description}}
                              </p>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
            @endforeach
          </div>

          @endif
        @endforeach
        
        
      @endif
    </div>
  </section>
  <!-- end card-list -->