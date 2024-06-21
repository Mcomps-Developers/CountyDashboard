<div class="content container-fluid">
    @section('title')
    The Governor
    @endsection
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Pages</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">The Governor</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card comman-shadow">
                <div class="card-body">
                    <form wire:submit.prevent='saveChanges'>
                        <div class="row">
                            <div class="col-12">
                                <h5 class="form-title student-info">Manage The Governor Page <span><a
                                            href="javascript:;"><i class="feather-more-vertical"></i></a></span></h5>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group local-forms">
                                    <label>Name <span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" wire:model.live='name'>
                                    @error('name')
                                    <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="form-group local-forms">
                                    <label>Date of Birth <span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" wire:model.live='date_of_birth'>
                                    @error('date_of_birth')
                                    <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="form-group local-forms">
                                    <label>Main Agenda(s)/Manifesto <span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" wire:model.live='main_manifesto'>
                                    @error('main_manifesto')
                                    <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group local-forms">
                                    <label>Welcome Message </label>
                                    <textarea class="form-control" placeholder="Will appear in quote"
                                        wire:model.live='welcome_message'></textarea>
                                    @error('welcome_message')
                                    <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group local-forms" wire:ignore>
                                    <label>About </label>
                                    <textarea id="about"
                                        placeholder="Write about the the governor's agenda, manifesto, education background, profesional..."
                                        class="form-control" wire:model.live='about'></textarea>
                                </div>
                                @error('about')
                                <p class="text text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="form-group local-forms">
                                    <label>Facebook Page <span class="login-danger">*</span></label>
                                    <input class="form-control" type="url" wire:model.live='facebook'>
                                    @error('facebook')
                                    <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="form-group local-forms">
                                    <label>Twitter (X) Page <span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" wire:model.live='twitter'>
                                    @error('twitter')
                                    <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="form-group local-forms">
                                    <label>Instagram Page <span class="login-danger">*</span></label>
                                    <input class="form-control" type="url" wire:model.live='instagram'>
                                    @error('instagram')
                                    <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="form-group local-forms">
                                    <label>LinkedIn Page <span class="login-danger">*</span></label>
                                    <input class="form-control" type="url" wire:model.live='linkedin'>
                                    @error('linkedin')
                                    <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group students-up-files">
                                    <label>Upload Photo</label>
                                    <div class="uplod">
                                        <label class="mb-0 file-upload image-upbtn">
                                            Upload Current Photo <input type="file" wire:model.live='photo'>
                                        </label>
                                    </div>
                                    @error('photo')
                                    <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group local-forms">
                                    <label>Office Phone Number</span></label>
                                    <input class="form-control" type="tel" wire:model.live='office_phone'>
                                    @error('office_phone')
                                    <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group local-forms">
                                    <label>Office Email Address</span></label>
                                    <input class="form-control" type="email" wire:model.live='office_email'>
                                    @error('office_email')
                                    <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            @if ($this->photo)
                            <div class="col-12 col-sm-4">
                                <img src="{{ $photo->temporaryUrl() }}" width="150" height="200">
                            </div>
                            @else
                            @if ($theGovernor)
                            <div class="col-12 col-sm-4">
                                <img src="{{ asset('assets/img/about/governor') }}/{{ $photo }}" width="150"
                                    height="200">
                            </div>
                            @endif
                            @endif
                            <div class="col-12">
                                <div class="student-submit">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
