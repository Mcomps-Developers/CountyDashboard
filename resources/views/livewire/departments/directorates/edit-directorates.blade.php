<div class="content container-fluid">
    @section('title')
    Edit Directorate
    @endsection
    <div class="row">
        <div class="col-xl-12">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Edit Directorate</h3>
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
                                        <label>Directorate Title<span class="text-danger">*</span></label>
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
                                                @if ($director_photo)
                                                <p>Director photo</p>
                                                @else
                                                <p>Upload Director photo</p>
                                                @endif
                                                @error('director_photo')
                                                <p class="text text-danger"></p>
                                                <small>{{ $message }}</small>
                                                @enderror

                                                <p wire:loading wire:target='director_photo'>Uploading...</p>
                                            </div>
                                            <input type="file" class="upload" wire:model.live='director_photo'>
                                        </div>

                                    </div>
                                </div>
                                @if ($director_photo)
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <div class="change-photo-btn">
                                            <div>
                                                @if ($director_photo)
                                                <img src="{{ $director_photo->temporaryUrl() }}" width="200"
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
                                <div class="col-lg-3 col-md-12">
                                    <div class="form-group">
                                        <label>Director Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model.live='director_name'>
                                        @error('director_name')
                                        <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label>Director Date of Birth<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control"
                                            wire:model.live='director_date_of_birth'>
                                        @error('director_date_of_birth')
                                        <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label>Office Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model.live='office_phone'>
                                        @error('office_phone')
                                        <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label>Office Email<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" wire:model.live='office_email'>
                                        @error('office_email')
                                        <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group" wire:ignore>
                                        <label>Describe Directorate</label>
                                        <textarea id="about" class="form-control" wire:model.live='about' columns="2"
                                            rows="4"></textarea>
                                    </div>
                                    @error('about')
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
                selector: '#about',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                setup: function(editor) {
                    editor.on('Change', function(e) {
                        tinymce.triggerSave();
                        var sd_data = $('#about').val();
                        @this.set('about', sd_data);
                    });
                }
            });
        });
</script>
@endscript
