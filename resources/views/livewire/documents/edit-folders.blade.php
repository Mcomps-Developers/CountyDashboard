<div class="content container-fluid">
    @section('title')
        Edit File Folder
    @endsection
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Edit File Folder</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Edit File Folder</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent='saveChanges'>
                        <div class="row">
                            <div class="col-12">
                                <h5 class="form-title"><span>Edit File Folder</span></h5>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label>Folder Name</label>
                                    <input type="text" class="form-control" placeholder="Folder Name"
                                        wire:model.live='name'>
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12" wire:offline>
                                <p class="text-danger">You are offline</p>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary" wire:offline.attr="disabled"
                                    wire:click.prevent='saveChanges'>
                                    <span wire:loading>Processing...</span>
                                    <span wire:loading.remove>Save Changes</span>
                                </button>
                            </div>
                            <style>
                                .btn:disabled {
                                    opacity: 0.6;
                                    cursor: not-allowed;
                                }
                            </style>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
