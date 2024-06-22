<div class="content container-fluid">
    @section('title')
    Edit Department
    @endsection
    <div class="row">
        <div class="col-xl-12">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Edit Department</h3>
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
                                        <label>Department Title<span class="text-danger">*</span></label>
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
                                                @if ($cover_image)
                                                <p>Change cover image (optional)</p>
                                                @else
                                                <p>Upload cover image (optional)</p>
                                                @endif
                                                @error('cover_image')
                                                <p class="text text-danger"></p>
                                                <small>{{ $message }}</small>
                                                @enderror

                                                <p wire:loading wire:target='cover_image'>Uploading...</p>
                                            </div>
                                            <input type="file" class="upload" wire:model.live='cover_image'>
                                        </div>

                                    </div>
                                </div>
                                @if ($cover_image)
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <div class="change-photo-btn">
                                            <div>
                                                @if ($cover_image)
                                                <img src="{{ $cover_image->temporaryUrl() }}" width="200" height="150"
                                                    alt="">
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
                                        <label>Department content</label>
                                        <textarea id="description" class="form-control" wire:model.live='description'
                                            columns="2" rows="4"></textarea>
                                    </div>
                                    @error('description')
                                    <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <h2>CECM Profile</h2>
                    <div class="card-body">
                        <div class="bank-inner-details">
                            <div class="row">
                                <div class="col-lg-12 col-md-3">
                                    <div class="form-group">
                                        <label>Full Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model.live='cecm_name'>
                                        @error('cecm_name')
                                        <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-3">
                                    <div class="form-group">
                                        <label>Date of Birth<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" wire:model.live='cecm_date_of_birth'>
                                        @error('cecm_date_of_birth')
                                        <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-3">
                                    <div class="form-group">
                                        <label>Office Phone Number<span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" wire:model.live='cecm_department_phone'>
                                        @error('cecm_department_phone')
                                        <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-3">
                                    <div class="form-group">
                                        <label>Office Email<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control"
                                            wire:model.live='cecm_department_email'>
                                        @error('cecm_department_email')
                                        <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <div class="change-photo-btn">
                                            <div>
                                                @if ($cecm_photo)
                                                <p>Change profile (optional)</p>
                                                @else
                                                <p>Upload profile (optional)</p>
                                                @endif
                                                @error('cecm_photo')
                                                <p class="text text-danger"></p>
                                                <small>{{ $message }}</small>
                                                @enderror

                                                <p wire:loading wire:target='cecm_photo'>Uploading...</p>
                                            </div>
                                            <input type="file" class="upload" wire:model.live='cecm_photo'>
                                        </div>

                                    </div>
                                </div>
                                @if ($cecm_photo)
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <div class="change-photo-btn">
                                            <div>
                                                @if ($cecm_photo)
                                                <img src="{{ $cecm_photo->temporaryUrl() }}" width="200" height="150"
                                                    alt="">
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
                                        <label>CECM Biography</label>
                                        <textarea id="about_cecm" class="form-control" wire:model.live='about_cecm'
                                            columns="2" rows="4"></textarea>
                                    </div>
                                    @error('about_cecm')
                                    <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h2>Chief Office Profile</h2>
                    <div class="card-body">
                        <div class="bank-inner-details">
                            <div class="row">
                                <div class="col-lg-12 col-md-3">
                                    <div class="form-group">
                                        <label>Full Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model.live='chief_office_name'>
                                        @error('chief_office_name')
                                        <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-3">
                                    <div class="form-group">
                                        <label>Date of Birth<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control"
                                            wire:model.live='chief_office_date_of_birth'>
                                        @error('chief_office_date_of_birth')
                                        <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-3">
                                    <div class="form-group">
                                        <label>Office Phone Number<span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control"
                                            wire:model.live='chief_office_department_phone'>
                                        @error('chief_office_department_phone')
                                        <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-3">
                                    <div class="form-group">
                                        <label>Office Email<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control"
                                            wire:model.live='chief_office_department_email'>
                                        @error('chief_office_department_email')
                                        <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <div class="change-photo-btn">
                                            <div>
                                                @if ($chief_officer_photo)
                                                <p>Change profile (optional)</p>
                                                @else
                                                <p>Upload profile (optional)</p>
                                                @endif
                                                @error('chief_officer_photo')
                                                <p class="text text-danger"></p>
                                                <small>{{ $message }}</small>
                                                @enderror

                                                <p wire:loading wire:target='chief_officer_photo'>Uploading...</p>
                                            </div>
                                            <input type="file" class="upload" wire:model.live='chief_officer_photo'>
                                        </div>

                                    </div>
                                </div>
                                @if ($chief_officer_photo)
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <div class="change-photo-btn">
                                            <div>
                                                @if ($chief_officer_photo)
                                                <img src="{{ $chief_officer_photo->temporaryUrl() }}" width="200"
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
                                        <label>Chief Officer Biography</label>
                                        <textarea id="about_chief_officer" class="form-control"
                                            wire:model.live='about_chief_officer' columns="2" rows="4"></textarea>
                                    </div>
                                    @error('about_chief_officer')
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
            tinymce.init({
                selector: '#about_chief_officer',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                setup: function(editor) {
                    editor.on('Change', function(e) {
                        tinymce.triggerSave();
                        var sd_data = $('#about_chief_officer').val();
                        @this.set('about_chief_officer', sd_data);
                    });
                }
            });
            tinymce.init({
                selector: '#about_cecm',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                setup: function(editor) {
                    editor.on('Change', function(e) {
                        tinymce.triggerSave();
                        var sd_data = $('#about_cecm').val();
                        @this.set('about_cecm', sd_data);
                    });
                }
            });
        });
</script>
@endscript
