@extends('layouts.app')
@section("styles")
<link rel="stylesheet" href="{{ asset('admins/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section("content")
<!-- hero privacy  -->
<section class="privacy-hero">
    <div class="container">
        <div class="hero-banner">
            <div class="prc-title">
                <h2>{{trans("pages.user.blacklist_user_tab.blacklist")}} <span>{{trans("pages.user.blacklist_user_tab.user")}}</span></h2>
            </div>
        </div>
    </div>
</section>
<!-- end  -->

<section class="breadcrumb-wrap">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans("global.home")}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{trans("global.blacklist_user")}}
                </li>
            </ol>
        </nav>
    </div>
</section>


<div class="profile-wrapper-cp">
    <div class="container">
        <div class="row">

            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <div class="categories-details">
                    <div class="categories-details-head">
                        <div class="categories-left-content">
                            <div class="categories-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                                    <g id="Line">
                                        <path d="M27,29.75H11A2.75,2.75,0,0,1,8.25,27v-.45a7.75,7.75,0,0,1,0-15.1V5A2.75,2.75,0,0,1,11,2.25H22.17a2.74,2.74,0,0,1,1.95.81l4.82,4.82a2.74,2.74,0,0,1,.81,2V27A2.75,2.75,0,0,1,27,29.75Zm-17.25-3V27A1.25,1.25,0,0,0,11,28.25H27A1.25,1.25,0,0,0,28.25,27V10.75H24A2.75,2.75,0,0,1,21.25,8V3.75H11A1.25,1.25,0,0,0,9.75,5v6.25H10a7.75,7.75,0,0,1,0,15.5Zm.25-14A6.25,6.25,0,1,0,16.25,19,6.25,6.25,0,0,0,10,12.75ZM22.75,3.89V8A1.25,1.25,0,0,0,24,9.25h4.11a1.39,1.39,0,0,0-.23-.31L23.06,4.12A1.39,1.39,0,0,0,22.75,3.89ZM25,22.75H20a.75.75,0,0,1,0-1.5h5a.75.75,0,0,1,0,1.5ZM8.5,21.25A.74.74,0,0,1,8,21,.75.75,0,0,1,8,20l1.28-1.28V16a.75.75,0,0,1,1.5,0v3a.75.75,0,0,1-.22.53L9,21A.74.74,0,0,1,8.5,21.25ZM25,18.75H21a.75.75,0,0,1,0-1.5h4a.75.75,0,0,1,0,1.5Zm0-4H20a.75.75,0,0,1,0-1.5h5a.75.75,0,0,1,0,1.5Zm-7-4H15a.75.75,0,0,1,0-1.5h3a.75.75,0,0,1,0,1.5Z" />
                                    </g>
                                </svg>
                            </div>
                            <h5 class="categories-details-title"> {{trans("global.blacklist_user")}}</h5>
                        </div>
                        <div class="edit-post">
                            <a href="{{route('blacklist.user.create')}}" title="{{trans('global.add')}} {{trans('global.blacklist_user')}}">
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

                        <form id="excelForm" action="{{ route('blacklist.user.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="excel_file" id="excel_file">
                        </form>



                    </div>
                    <div class="categories-details-listing">
                        <ul>
                            @forelse($balcklistUsers as $poster)
                            <li>
                                <div class="post-cat-list">
                                    <a class="post-cat-content d-flex">
                                        <div class="post-cat-title">
                                            <div class="post-cat-head d-flex align-item-center">
                                                {{-- <div class="avatar-icon">
                              <img src="{{$userImagePath}}" alt="">
                                            </div> --}}
                                            <div class="title-avatar">
                                                <div class="avtar-title-text d-flex align-item-center">

                                                </div>
                                            </div>
                                        </div>
                                        <h2 class="mt-3">{{$poster->title}}</h2>
                                </div>
                                </a>
                    </div>

                    {{-- <div class="d-block postBtn-box">
                        <a href="{{route('post.edit',Crypt::encrypt($poster->id))}}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                        <path d="M16 5l3 3" />
                    </svg>
                    {{trans("global.edit")}}
                    </a>

                </div> --}}
                </li>
                @empty

                <div class="text-center mt-5">
                    <h4>{{trans("pages.user.blacklist_user_tab.users_not_available")}}</h4>
                </div>
                @endforelse

                </ul>
            </div>
        </div>
        <div class="center">
            <div class="pagination">
                {{ $balcklistUsers->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@section("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="{{ asset('admins/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    document.getElementById('excel_file').addEventListener('change', function() {
        document.getElementById('excelForm').submit();
    });
</script>
<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     document.getElementById('excel-file').addEventListener('change', handleFileUpload);
    // });

    // function handleFileUpload(event) {
    //     const file = event.target.files[0];
    //     const formData = new FormData();
    //     formData.append('excel_file', file);
    //     uploadFile(formData);
    // }

    // function uploadFile(formData) {
    //     fetch("{{ route('blacklist.user.import') }}", {
    //             method: "POST",
    //             body: formData,
    //             headers: {
    //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //             }
    //         })
    //         .then(response => response.json())
    //         .then(data => {
    //             console.log(data);
    //         })
    //         .catch(error => {
    //             console.error('Error:', error);
    //         });
    // }
</script>

@endsection