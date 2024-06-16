<div class="content container-fluid">
    @section('title')
        {{ $category->name }}
    @endsection
    <div class="row">
        <div class="col-md-9">
            <ul class="mb-4 list-links">
                <li class="active"><a href="javascript:void(0);">Active Blog</a></li>
                <li><a href="javascript:void(0);">Pending Blog</a></li>
            </ul>
        </div>
        <div class="col-md-3 text-md-end">
            <a href="{{ route('blog.add') }}" class="mb-3 btn btn-primary btn-blog"><i class="feather-plus-circle me-1"></i> Add
                {{ $category->name }}</a>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6 col-xl-4 col-sm-12 d-flex">
            <div class="blog grid-blog flex-fill">
                <div class="blog-image">
                    <a href="blog-details.html"><img class="img-fluid" src="{{ asset('assets/img/category/blog-6.jpg') }}"
                            alt="Post Image"></a>
                    <div class="blog-views">
                        <i class="feather-eye me-1"></i> 225
                    </div>
                </div>
                <div class="blog-content">
                    <ul class="entry-meta meta-item">
                        <li>
                            <div class="post-author">
                                <a href="profile.html">
                                    <img src="{{asset('assets/img/profiles/avatar-01.jpg')}}" alt="Post Author">
                                    <span>
                                        <span class="post-title">Vincent</span>
                                        <span class="post-date"><i class="far fa-clock"></i> 4 Dec 2022</span>
                                    </span>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <h3 class="blog-title"><a href="blog-details.html">Learning is an objective, Lorem Ipsum is not </a>
                    </h3>
                    <p>Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                </div>
                <div class="row">
                    <div class="edit-options">
                        <div class="edit-delete-btn">
                            <a href="edit-blog.html" class="text-success"><i class="feather-edit-3 me-1"></i> Edit</a>
                            <a href="#" class="text-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal"><i class="feather-trash-2 me-1"></i> Delete</a>
                        </div>
                        <div class="text-end inactive-style">
                            <a href="javascript:void(0);" class="text-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteNotConfirmModal"><i class="feather-eye-off me-1"></i>
                                Inactive</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6 col-xl-4 col-sm-12 d-flex">
            <div class="blog grid-blog flex-fill">
                <div class="blog-image">
                    <a href="blog-details.html"><img class="img-fluid" src="{{ asset('assets/img/category/blog-2.jpg') }}"
                            alt="Post Image"></a>
                    <div class="blog-views">
                        <i class="feather-eye me-1"></i> 132
                    </div>
                </div>
                <div class="blog-content">
                    <ul class="entry-meta meta-item">
                        <li>
                            <div class="post-author">
                                <a href="profile.html">
                                    <img src="{{ asset('assets/img/profiles/avatar-02.jpg') }}" alt="Post Author">
                                    <span>
                                        <span class="post-title">Lois A</span>
                                        <span class="post-date"><i class="far fa-clock"></i> 4 Dec 2022</span>
                                    </span>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <h3 class="blog-title"><a href="blog-details.html">Discussion Increase student learning</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                </div>
                <div class="row">
                    <div class="edit-options">
                        <div class="edit-delete-btn">
                            <a href="edit-blog.html" class="text-success"><i class="feather-edit-3 me-1"></i> Edit</a>
                            <a href="edit-blog.html" class="text-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal"><i class="feather-trash-2 me-1"></i></i> Delete</a>
                        </div>
                        <div class="text-end inactive-style">
                            <a href="javascript:void(0);" class="text-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteNotConfirmModal"><i class="feather-eye-off me-1"></i>
                                Inactive</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6 col-xl-4 col-sm-12 d-flex">
            <div class="blog grid-blog flex-fill">
                <div class="blog-image">
                    <a href="blog-details.html"><img class="img-fluid" src="{{ asset('assets/img/category/blog-3.jpg') }}"
                            alt="Post Image"></a>
                    <div class="blog-views">
                        <i class="feather-eye me-1"></i> 344
                    </div>
                </div>
                <div class="blog-content">
                    <ul class="entry-meta meta-item">
                        <li>
                            <div class="post-author">
                                <a href="profile.html">
                                    <img src="{{ asset('assets/img/profiles/avatar-03.jpg') }}" alt="Post Author">
                                    <span>
                                        <span class="post-title">Levell Scott</span>
                                        <span class="post-date"><i class="far fa-clock"></i> 4 Dec 2022</span>
                                    </span>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <h3 class="blog-title"><a href="blog-details.html">Music reduces stress,Lorem Ipsum is not </a>
                    </h3>
                    <p>Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                </div>
                <div class="row">
                    <div class="edit-options">
                        <div class="edit-delete-btn">
                            <a href="edit-blog.html" class="text-success"><i class="feather-edit-3 me-1"></i>
                                Edit</a>
                            <a href="edit-blog.html" class="text-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal"><i class="feather-trash-2 me-1"></i></i> Delete</a>
                        </div>
                        <div class="text-end inactive-style">
                            <a href="javascript:void(0);" class="text-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteNotConfirmModal"><i class="feather-eye-off me-1"></i>
                                Inactive</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row ">
        <div class="col-md-12">
            <div class="pagination-tab d-flex justify-content-center">
                <ul class="mb-0 pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1"><i
                                class="mr-2 feather-chevron-left"></i>Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active">
                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next<i class="ml-2 feather-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="modal fade contentmodal" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="pb-0 modal-header border-bottom-0 justify-content-end">
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <div class="text-center delete-wrap">
                        <div class="del-icon"><i class="feather-x-circle"></i></div>
                        <h2>Sure you want to delete</h2>
                        <div class="submit-section">
                            <a href="blog.html" class="btn btn-success me-2">Yes</a>
                            <a href="#" class="btn btn-danger" data-bs-dismiss="modal">No</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
