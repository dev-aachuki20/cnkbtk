<!-- hero-section -->
  <section class="hero-section">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="left-hero">
            <div class="row">
              <div class="your-class">
                <!-- post-item  -->
                @forelse($posters as $poster)
                <div class="post-item">
                  <div class="post-card">
                    <div class="post-head-box">
                    <a href="{{route('post.details', ['slug' => $poster->slug])}}">
                      <div class="post-img">
                        @php 
                          $posterImage = asset('front/asset/images/no_image.png');
                          if(isset($poster->uploads) && !empty($poster->uploads) && count($poster->uploads) > 0){
                              $posterImage = asset('storage/'.$poster->uploads->first()->path );
                          } 
                        @endphp
                        <img src="{{$posterImage}}" alt="" />
                        <div class="post-img-title">
                          <div class="post-author">
                            <span>{{isset($poster->userDetails->user_name)  ? $poster->userDetails->user_name : "N/A"}}</span>
                          </div>
                          <div class="post-title">
                            <h3 title="Production team column">{{isset($poster->parentSection->name)  ? $poster->parentSection->name : "N/A"}}</h3>
                          </div>
                        </div>
                      </div>
                    </a>
                    </div>
                  </div>
                </div>
                <!-- end  -->
                @empty
                @endforelse
              </div>
            </div>
            
          </div>
        </div>
        <div class="col-md-4">
          <div class="left-hero">
            <div class="banner-img">
              @php
                $heroImage = $advertisements->where("advertisement_type",'home_banner_image')->first();
                $bannerImage = asset('front/asset/images/no_image.png');
                if(!empty($heroImage->image) && Storage::disk('public')->exists($heroImage->image)){                    
                    $bannerImage = asset('storage/'.$heroImage->image);
                }   
              @endphp 
              <picture>
                <a href="{{!empty($heroImage->url) ? $heroImage->url : 'javascript:void(0)'}}">
                  <img src="{{$bannerImage}}" class="img-fluid" alt="" />
                </a>
              </picture>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end  -->