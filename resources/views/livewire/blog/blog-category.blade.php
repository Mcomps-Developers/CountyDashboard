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
            <a href="{{ route('blog.add', ['slug' => $category->slug]) }}" class="mb-3 btn btn-primary btn-blog"><i
                    class="feather-plus-circle me-1"></i> Add
                New</a>
        </div>
    </div>
    <div class="row">
        @foreach ($content as $item)
            <div class="col-md-6 col-xl-4 col-sm-12 d-flex">
                <div class="blog grid-blog flex-fill">
                    <div class="blog-image">
                        <a href="javascript:void(0);"><img class="img-fluid"
                                src="{{ asset('assets/img/blogs') }}/{{ $item->image }}" alt="Post Image"></a>
                        <div class="blog-views">
                            <i class="feather-eye me-1"></i> {{ $item->views }}
                        </div>
                    </div>
                    <div class="blog-content">
                        <ul class="entry-meta meta-item">
                            <li>
                                <div class="post-author">
                                    <a href="javascript:void(0);">
                                        <img src="{{ $item->author->profile_photo_url }}">
                                        <span>
                                            <span class="post-title"
                                                style="text-transform: capitalize">{{ $item->author->first_name }}
                                                {{ $item->author->last_name }}</span>
                                            <span class="post-date"><i class="far fa-clock"></i>
                                                {{ date('d M Y', strtotime($item->created_at)) }}</span>
                                        </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <h3 class="blog-title"><a href="javascript:void(0);">{{ $item->title }}
                            </a>
                        </h3>
                    </div>
                    <div class="row">
                        <div class="edit-options">
                            <div class="edit-delete-btn">
                                <a href="{{ route('blog.edit', ['reference' => $item->reference]) }}"
                                    class="text-success"><i class="feather-edit-3 me-1"></i>
                                    Edit</a>
                                <a href="javascript:void(0);" class="text-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal-{{ $item->id }}"><i
                                        class="feather-trash-2 me-1"></i> Delete</a>
                            </div>
                            <div class="modal fade contentmodal" id="deleteModal-{{ $item->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content doctor-profile">
                                        <div class="pb-0 modal-header border-bottom-0 justify-content-end">
                                            <button type="button" class="close-btn" data-bs-dismiss="modal"
                                                aria-label="Close"><i class="feather-x-circle"></i></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center delete-wrap">
                                                <div class="del-icon"><i class="feather-x-circle"></i></div>
                                                <h2>Sure you want to delete</h2>
                                                <div class="submit-section">
                                                    <a href="javascript:void(0);"
                                                        wire:click.prevent='deleteBlog({{ $item->id }})'
                                                        class="btn btn-success me-2">Yes</a>
                                                    <a href="#" class="btn btn-danger"
                                                        data-bs-dismiss="modal">No</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end edit-delete-btn">
                                @if ($item->status === 'published')
                                    <a href="javascript:void(0);" class="text-success"
                                        style="text-transform: capitalize"><i class="feather-eye me-1"></i>
                                        {{ $item->status }}</a>
                                @else
                                    <a href="javascript:void(0);" class="btext-danger"
                                        style="text-transform: capitalize"><i class="feather-eye-off me-1"></i>
                                        {{ $item->status }}</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


    </div>

    <div class="row ">
        <div class="col-md-12">
            <div class="pagination-tab d-flex justify-content-center">
                <ul class="mb-0 pagination">
                    {{ $content->links('pagination::bootstrap-5') }}
                </ul>
            </div>
        </div>
    </div>




</div>
