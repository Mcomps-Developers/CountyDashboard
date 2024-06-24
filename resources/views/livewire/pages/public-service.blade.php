<div class="content container-fluid">
    @section('title')
    County Public Service Board
    @endsection
    <div class="row">
        <div class="col-xl-12">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">County Public Service Board</h3>
                    </div>
                </div>
            </div>

            <div class="card">
                <form wire:submit.prevent="saveChanges">
                    <div class="card-body">
                        <div class="bank-inner-details">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group" wire:ignore>
                                        <label>Page Content</label>
                                        <textarea id="content" class="form-control"
                                            wire:model.live='content' columns="2" rows="4"></textarea>
                                    </div>
                                    @error('content')
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
                selector: '#content',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                setup: function(editor) {
                    editor.on('Change', function(e) {
                        tinymce.triggerSave();
                        var sd_data = $('#content').val();
                        @this.set('content', sd_data);
                    });
                }
            });
        });
</script>
@endscript
