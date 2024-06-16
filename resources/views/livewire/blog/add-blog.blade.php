<div class="content container-fluid">
    @section('title')
        Add Speech
    @endsection
    <div class="row">
        <div class="col-xl-12">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Add Speech</h3>
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
                                                @if ($photo)
                                                    <p>Change Image</p>
                                                @else
                                                    <p>Upload Image</p>
                                                @endif
                                                <small>Will automatically be resized to 295x300 pixels.</small>
                                                <p wire:loading wire:target='photo'>Uploading...</p>
                                            </div>
                                            <input type="file" class="upload" wire:model.live='photo'>
                                        </div>
                                        @error('photo')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                @if ($photo)
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <div class="change-photo-btn">
                                                <div>
                                                    @if ($photo)
                                                        <img src="{{ $photo->temporaryUrl() }}" width="95"
                                                            height="100" alt="">
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
                                        <label>Speech Content</label>
                                        <textarea id="speech_content" class="form-control" wire:model.live='speech_content' columns="2" rows="4"></textarea>
                                    </div>
                                    @error('speech_content')
                                        <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Tags</span></label>
                                        <input type="text" class="form-control"
                                            placeholder="Seperated by comma eg. speech, news, publication"
                                            wire:model.live='tags'>
                                        @error('tags')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Actual Date</span></label>
                                        <input type="date" class="form-control" wire:model.live='publishing_date'>
                                        @error('publishing_date')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="pt-0 blog-categories-btn">
                        <div class="bank-details-btn ">
                            <button type="submit" class="btn bank-cancel-btn me-2">Add Speech</button>
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
                selector: '#speech_content',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                setup: function(editor) {
                    editor.on('Change', function(e) {
                        tinymce.triggerSave();
                        var sd_data = $('#speech_content').val();
                        @this.set('speech_content', sd_data);
                    });
                }
            });
        });
    </script>
@endscript
