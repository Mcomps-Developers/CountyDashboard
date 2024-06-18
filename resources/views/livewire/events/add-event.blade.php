<div class="content container-fluid">
    @section('title')
        Add to {{ $categoryName }}
    @endsection
    <div class="row">
        <div class="col-xl-12">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Add to {{ $categoryName }}</h3>
                    </div>
                </div>
            </div>

            <div class="card">
                <form wire:submit.prevent="addSpeech">
                    <div class="card-body">
                        <div class="bank-inner-details">

                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Title<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model.live='title'>
                                        @error('title')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <div class="change-photo-btn">
                                            <div>
                                                @if ($coverPhoto)
                                                    <p>Change Cover Photo</p>
                                                @else
                                                    <p>Upload Cover Photo</p>
                                                @endif
                                                <small>Will automatically be resized to 1200x800 pixels.</small>
                                                <br>
                                                <p wire:loading wire:target='coverPhoto'>Uploading...</p>
                                            </div>
                                            <input type="file" class="upload" wire:model.live='coverPhoto'>
                                        </div>
                                        @error('coverPhoto')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                @if ($coverPhoto)
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <div class="change-photo-btn">
                                                <div>
                                                    @if ($coverPhoto)
                                                        <img src="{{ $coverPhoto->temporaryUrl() }}" width="200"
                                                            height="150" alt="">
                                                    @else
                                                        <p>No cover photo has been uploaded</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group" wire:ignore>
                                        <label>Description</label>
                                        <textarea id="description" class="form-control" wire:model.live='description' columns="2" rows="4"></textarea>
                                    </div>
                                    @error('description')
                                        <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="pt-0 blog-categories-btn">
                        <div class="bank-details-btn ">
                            <button type="submit" class="btn bank-cancel-btn me-2">Save</button>
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
