<div class="content container-fluid">
    @section('title')
        Edit Project
    @endsection
    <div class="row">
        <div class="col-xl-12">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Edit Project</h3>
                    </div>
                </div>
            </div>

            <div class="card">
                <form wire:submit.prevent="saveChanges">
                    <div class="card-body">
                        <div class="bank-inner-details">

                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Project Title<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model.live='title'>
                                        @error('title')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                @if (empty($category_name))
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Project Department <span class="text-danger">Optional</span></label>
                                            <select name="" id="" class="form-control"
                                                wire:model='department'>
                                                <option>--</option>
                                                @foreach ($departments as $item)
                                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('department')
                                                <p class="text text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                @if (empty($department))
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Project Category, where not for department <span
                                                    class="text-danger">Optional</span></label>
                                            <input type="text" class="form-control" wire:model.live='category_name'>
                                            @error('category_name')
                                                <p class="text text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <div class="change-photo-btn">
                                            <div>
                                                @if ($cover_image)
                                                    <p>Change Cover photo</p>
                                                @else
                                                    <p>Upload Cover photo</p>
                                                @endif
                                                <small></small>
                                                <p wire:loading wire:target='cover_image'>Uploading cover project cover
                                                    photo...</p>
                                            </div>
                                            <input type="file" class="upload" wire:model.live='cover_image'>
                                        </div>
                                        @error('cover_image')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                @if ($cover_image)
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <div class="change-photo-btn">
                                                <div>
                                                    @if ($cover_image)
                                                        <img src="{{ $cover_image->temporaryUrl() }}" width="200"
                                                            height="150" alt="">
                                                    @else
                                                        <p>No Image has been uploaded</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group" wire:ignore>
                                        <label>Project Description</label>
                                        <textarea id="description" class="form-control" wire:model.live='description' columns="2" rows="4"></textarea>
                                    </div>
                                    @error('description')
                                        <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Project Location</span></label>
                                        <input type="text" class="form-control" wire:model.live='location'>
                                        @error('location')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Project Date</span></label>
                                        <input type="date" class="form-control" wire:model.live='project_date'>
                                        @error('project_date')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="pt-0 blog-categories-btn">
                        <div class="bank-details-btn ">
                            <button type="submit" class="btn bank-cancel-btn me-2">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $(function() {
            tinymce.init({
                selector: '#description',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                setup: function(editor) {
                    editor.on('Change', function(e) {
                        tinymce.triggerSave();
                        var sd_data = $('#description').val();
                        @this.set('description', sd_data);
                    });
                }
            });
        });
    </script>
@endscript
