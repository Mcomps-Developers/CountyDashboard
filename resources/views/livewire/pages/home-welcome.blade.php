<div class="content container-fluid">
    @section('title')
        Welcome Message
    @endsection
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Home Page</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Welcome Message</li>
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
                                <h5 class="form-title student-info">Manage Message <span><a href="javascript:;"><i
                                                class="feather-more-vertical"></i></a></span></h5>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group local-forms">
                                    <label>Title <span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" wire:model.live='title'>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="form-group local-forms">
                                    <label>Full Name <span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" wire:model.live='name'>
                                    @error('name')
                                        <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="form-group local-forms">
                                    <label>Designation <span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" wire:model.live='designation'>
                                    @error('designation')
                                        <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group local-forms">
                                    <label>Quoted Message </label>
                                    <textarea class="form-control" placeholder="Will appear in quote" wire:model.live='quoted_text'></textarea>
                                    @error('quoted_text')
                                        <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group local-forms" wire:ignore>
                                    <label>Message </label>
                                    <textarea id="message" class="form-control" wire:model.live='message'></textarea>
                                </div>
                                @error('message')
                                    <p class="text text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group students-up-files">
                                    <label>Upload Photo (600 X 800)</label>
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
                            @if ($this->photo)
                                <div class="col-12 col-sm-4">
                                    <img src="{{ $photo->temporaryUrl() }}" width="150" height="200">
                                </div>
                            @else
                                <div class="col-12 col-sm-4">
                                    <img src="{{ asset('assets/img/governors') }}/{{ $currentPhoto }}" width="150"
                                        height="200">
                                </div>
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
                selector: '#message',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                setup: function(editor) {
                    editor.on('Change', function(e) {
                        tinymce.triggerSave();
                        var sd_data = $('#message').val();
                        @this.set('message', sd_data);
                    });
                }
            });
        });
    </script>
@endscript
