<div class="content container-fluid">
    @section('title')
        New Chief Officer
    @endsection
    <div class="row">
        <div class="col-xl-12">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">New Chief Officer</h3>
                    </div>
                </div>
            </div>
            <div class="card">
                <form wire:submit.prevent="saveChanges">
                    <div class="card-body">
                        <div class="bank-inner-details">

                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>Chief Officer Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model.live='name'>
                                        @error('name')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>Designation/Department<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model.live='designation'
                                            placeholder="E.g Transport & Fleet Management">
                                        @error('designation')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <div class="change-photo-btn">
                                            <div>
                                                @if ($photo)
                                                    <p>CO photo</p>
                                                @else
                                                    <p>Upload CO photo</p>
                                                @endif
                                                @error('photo')
                                                    <p class="text text-danger"></p>
                                                    <small>{{ $message }}</small>
                                                @enderror

                                                <p wire:loading wire:target='photo'>Uploading...</p>
                                            </div>
                                            <input type="file" class="upload" wire:model.live='photo'>
                                        </div>

                                    </div>
                                </div>
                                @if ($photo)
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <div class="change-photo-btn">
                                                <div>
                                                    @if ($photo)
                                                        <img src="{{ $photo->temporaryUrl() }}" width="200"
                                                            height="150" alt="">
                                                    @else
                                                        <p>No Image has been uploaded</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group" wire:ignore>
                                        <label>Chief Officer Profile</label>
                                        <textarea id="profile" class="form-control" wire:model.live='profile' columns="2" rows="4"></textarea>
                                    </div>
                                    @error('profile')
                                        <p class="text text-danger">{{ $message }}</p>
                                    @enderror
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
                selector: '#profile',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                setup: function(editor) {
                    editor.on('Change', function(e) {
                        tinymce.triggerSave();
                        var sd_data = $('#profile').val();
                        @this.set('profile', sd_data);
                    });
                }
            });
        });
    </script>
@endscript
