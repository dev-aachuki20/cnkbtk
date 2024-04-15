@extends('layouts.app')
@section("content")
<!-- hero privacy  -->
    <section class="privacy-hero">
      <div class="container">
        <div class="hero-banner">
          <div class="prc-title">
            <h2>Post <span>history</span></h2>
          </div>
        </div>
      </div>
    </section>
    <!-- end  -->

    <section class="breadcrumb-wrap">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">
              Post history
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
              @include('user.partials.usercard')
            </div>
          </div>
         
          <div class="col-12 col-md-8 col-lg-9 col-xl-9">
            <div class="categories-details">
              <div class="categories-details-head">
                <div class="categories-left-content">
                  <div class="categories-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="512" height="512"><g id="Line"><path d="M27,29.75H11A2.75,2.75,0,0,1,8.25,27v-.45a7.75,7.75,0,0,1,0-15.1V5A2.75,2.75,0,0,1,11,2.25H22.17a2.74,2.74,0,0,1,1.95.81l4.82,4.82a2.74,2.74,0,0,1,.81,2V27A2.75,2.75,0,0,1,27,29.75Zm-17.25-3V27A1.25,1.25,0,0,0,11,28.25H27A1.25,1.25,0,0,0,28.25,27V10.75H24A2.75,2.75,0,0,1,21.25,8V3.75H11A1.25,1.25,0,0,0,9.75,5v6.25H10a7.75,7.75,0,0,1,0,15.5Zm.25-14A6.25,6.25,0,1,0,16.25,19,6.25,6.25,0,0,0,10,12.75ZM22.75,3.89V8A1.25,1.25,0,0,0,24,9.25h4.11a1.39,1.39,0,0,0-.23-.31L23.06,4.12A1.39,1.39,0,0,0,22.75,3.89ZM25,22.75H20a.75.75,0,0,1,0-1.5h5a.75.75,0,0,1,0,1.5ZM8.5,21.25A.74.74,0,0,1,8,21,.75.75,0,0,1,8,20l1.28-1.28V16a.75.75,0,0,1,1.5,0v3a.75.75,0,0,1-.22.53L9,21A.74.74,0,0,1,8.5,21.25ZM25,18.75H21a.75.75,0,0,1,0-1.5h4a.75.75,0,0,1,0,1.5Zm0-4H20a.75.75,0,0,1,0-1.5h5a.75.75,0,0,1,0,1.5Zm-7-4H15a.75.75,0,0,1,0-1.5h3a.75.75,0,0,1,0,1.5Z"/></g>
                    </svg>
                  </div>
                  <h5 class="categories-details-title">Post history</h5>
                </div>
                <div class="edit-post">
                  <a href="{{route('post.create')}}" title="Create post">
                    <svg id="_x31__px" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg">
                      <path d="m9.02 21h-6.52c-1.378 0-2.5-1.121-2.5-2.5v-16c0-1.379 1.122-2.5 2.5-2.5h12c1.378 0 2.5 1.121 2.5 2.5v6.06c0 .276-.224.5-.5.5s-.5-.224-.5-.5v-6.06c0-.827-.673-1.5-1.5-1.5h-12c-.827 0-1.5.673-1.5 1.5v16c0 .827.673 1.5 1.5 1.5h6.52c.276 0 .5.224.5.5s-.224.5-.5.5z"></path>
                      <path d="m13.5 9h-10c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h10c.276 0 .5.224.5.5s-.224.5-.5.5z"></path>
                      <path d="m9.5 13h-6c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h6c.276 0 .5.224.5.5s-.224.5-.5.5z"></path>
                      <path d="m8.5 5h-5c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h5c.276 0 .5.224.5.5s-.224.5-.5.5z"></path>
                      <path d="m17.5 24c-3.584 0-6.5-2.916-6.5-6.5s2.916-6.5 6.5-6.5 6.5 2.916 6.5 6.5-2.916 6.5-6.5 6.5zm0-12c-3.033 0-5.5 2.468-5.5 5.5s2.467 5.5 5.5 5.5 5.5-2.468 5.5-5.5-2.467-5.5-5.5-5.5z"></path>
                      <path d="m17.5 21c-.276 0-.5-.224-.5-.5v-6c0-.276.224-.5.5-.5s.5.224.5.5v6c0 .276-.224.5-.5.5z"></path>
                      <path d="m20.5 18h-6c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h6c.276 0 .5.224.5.5s-.224.5-.5.5z"></path>
                    </svg>
                  </a>
                </div>
              </div>
              <div class="categories-details-listing">
                <ul>
                  <li>
                    <div class="post-cat-list">
                      <a href="#" class="post-cat-content d-flex">
                        <div class="post-cat-title">
                          <div class="post-cat-head d-flex align-item-center">
                            <div class="avatar-icon">
                              <img src="{{asset('front/asset/images/user.jpg')}}" alt="">
                            </div>
                            <div class="title-avatar">
                              <div class="avtar-title-text d-flex align-item-center">
                                <h3>Mashes bhatt</h3>
                                <span>2023-06-09</span>
                              </div>
                              <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing
                                elit.
                              </p>
                            </div>
                          </div>
  
                          <h2 class="mt-3">
                            The appearance of being forced high while drooling is awesome~ Do you like this kind of peach?
                          </h2>
                        </div>
                        <div class="post-cat-img-box">
                          <img src="{{asset('front/asset/images/card-img1.jpg')}}" alt="">
                        </div>
                      </a>
                    </div>
                  </li>
                  <li>
                    <div class="post-cat-list">
                      <a href="#" class="post-cat-content d-flex">
                        <div class="post-cat-title">
                          <div class="post-cat-head d-flex align-item-center">
                            <div class="avatar-icon">
                              <img src="{{asset('front/asset/images/user.jpg')}}" alt="">
                            </div>
                            <div class="title-avatar">
                              <div class="avtar-title-text d-flex align-item-center">
                                <h3>Mashes bhatt</h3>
                                <span>2023-06-09</span>
                              </div>
                              <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing
                                elit.
                              </p>
                            </div>
                          </div>
  
                          <h2 class="mt-3">
                            The appearance of being forced high while drooling is awesome~ Do you like this kind of peach?
                          </h2>
                        </div>
                        <div class="post-cat-img-box">
                          <img src="{{asset('front/asset/images/card-img2.jpg')}}" alt="">
                        </div>
                      </a>
                    </div>
                  </li>
                  <li>
                    <div class="post-cat-list">
                      <a href="#" class="post-cat-content d-flex">
                        <div class="post-cat-title">
                          <div class="post-cat-head d-flex align-item-center">
                            <div class="avatar-icon">
                              <img src="{{asset('front/asset/images/user.jpg')}}" alt="">
                            </div>
                            <div class="title-avatar">
                              <div class="avtar-title-text d-flex align-item-center">
                                <h3>Mashes bhatt</h3>
                                <span>2023-06-09</span>
                              </div>
                              <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing
                                elit.
                              </p>
                            </div>
                          </div>
  
                          <h2 class="mt-3">
                            The appearance of being forced high while drooling is awesome~ Do you like this kind of peach?
                          </h2>
                        </div>
                        <div class="post-cat-img-box">
                          <img src="{{asset('front/asset/images/card-img3.jpg')}}" alt="">
                        </div>
                      </a>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="center">
              <div class="pagination">
                <a href="#">«</a>
                <a href="#">1</a>
                <a href="#" class="active">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">»</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection