@extends('layouts.app')
@section('content')
@php 
    $siteSettingData = getSiteSetting();
@endphp
 <!-- hero privacy  -->
  <section class="privacy-hero">
    <div class="container">
      <div class="hero-banner">
        <div class="prc-title">
          <h2>Basic <span>profile</span></h2>
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
          <li class="breadcrumb-item active">
            Site statistics
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            Basic profile
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
            <div class="popular-tag profile-wrap">
              <div class="inner-popular">
                <div class="title">
                  <h4>Site statistics</h4>
                </div>
                <div class="tag-listing">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link filter-tabs active" id="home-tab" data-bs-toggle="tab"
                        data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                        aria-selected="true" data-filter=".profile">
                        Basic profile
                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link filter-tabs" id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane"
                        aria-selected="false" data-filter=".change-password">
                        Category statistics
                      </button>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-8 col-lg-9 col-xl-9">
          <div class="profile-content">
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane tab-pane-box fade show active" id="home-tab-pane" role="tabpanel"
                aria-labelledby="home-tab" tabindex="0">
                <div class="cp-title">
                  <h2>Basic profile</h2>
                </div>
                <section class="credit-history-wrapper">
                  <div class="container--box">
                    <div class="card">
                      <div class="card-header">
                        <div class="credit-title">
                          <h3>Member statistics</h3>
                        </div>
                      </div>
                      <div class="card-body">
                        <table class="table statistics_table">
                          <tbody>
                            <tr>
                              <th width="50">Registered member</th>
                              <td width="100">505</td>
                            </tr>
                            <tr>
                              <th width="50">New member</th>
                              <td width="100">0</td>
                            </tr>
                              <tr>
                                <th width="50">Posting member</th>
                                <td width="100">22</td>
                              </tr>
                            <tr>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </section>
                <section class="credit-history-wrapper mt-4">
                  <div class="container--box">
                    <div class="card">
                      <div class="card-header">
                        <div class="credit-title">
                          <h3>Site statistics</h3>
                        </div>
                      </div>
                      <div class="card-body">
                        <table class="table">
                          <tbody>
                            <tr>
                              <th>Number of sections</th>
                              <td width="100">14</td>
                              <th>Average number of new posts per day</th>
                              <td width="100">1</td>
                            </tr>
                            <tr>
                              <th>Most popular sections</th>
                              <td width="100">0</td>
                              <th>Number of posts</th>
                              <td width="100">167</td>
                            </tr>
                            <tr>
                              <th>Average number of registered members per day</th>
                              <td width="100">1</td>
                              <th>The number of new posts in the last 24 hours</th>
                              <td width="100">0</td>
                            </tr>
                            <tr>
                              <th>The number of new members in the last 24 hours</th>
                              <td width="100">0</td>
                              <th></th>
                              <td width="100"></td>
                            </tr>
                          </tbody>
                        </table>
                        
                      </div>
                    </div>
                  </div>
                </section>
              </div>

              <div class="tab-pane tab-pane-box fade" id="profile-tab-pane" role="tabpanel"
                aria-labelledby="profile-tab" tabindex="0">
                <div class="cp-title">
                  <h2>Category statistics</h2>
                </div>
                <section class="credit-history-wrapper">
                  <div class="container--box">
                    <div class="card">
                      <div class="card-header">
                        <div class="credit-title">
                          <h3>Category list</h3>
                        </div>
                      </div>
                      <div class="card-body">
                        <table class="table category-table-list category_statistics_table">
                          <thead>
                            <tr>
                              <th>S.no</th>
                              <th>Section name</th>
                              <th>Number of posts</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td><a href="post-category.html">April bd member area</a></td>
                              <td>166</td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td><a href="post-category.html">Shengjing film and television original</a></td>
                              <td>166</td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td><a href="post-category.html">Jay original (VIP)</a></td>
                              <td>0</td>
                            </tr>
                            <tr>
                              <td>4</td>
                              <td><a href="post-category.html">Bate original</a></td>
                              <td>0</td>
                            </tr>
                            <tr>
                              <td>5</td>
                              <td><a href="post-category.html">Tianming xuanyue column</a></td>
                              <td>167</td>
                            </tr>
                            <tr>
                              <td>6</td>
                              <td><a href="post-category.html">Original video</a></td>
                              <td>0</td>
                            </tr>
                            <tr>
                              <td>7</td>
                              <td><a href="post-category.html">Original atlas</a></td>
                              <td>167</td>
                            </tr>
                            <tr>
                              <td>8</td>
                              <td><a href="post-category.html">Original novel</a></td>
                              <td>0</td>
                            </tr>
                            <tr>
                              <td>9</td>
                              <td><a href="post-category.html">Tutorial</a></td>
                              <td>167</td>
                            </tr>
                            <tr>
                              <td>10</td>
                              <td><a href="post-category.html">User communication</a></td>
                              <td>0</td>
                            </tr>
                          </tbody>
                        </table>
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
                </section>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection
