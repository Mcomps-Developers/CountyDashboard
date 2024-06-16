<div class="content container-fluid">
    @section('title')
        Add Category
    @endsection
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Add Category</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Add Category</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-12">
                                <h5 class="form-title"><span>Add New Category</span></h5>
                            </div>
                            <form wire:submit.prevent='addCategory'>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="text" class="form-control" placeholder="Category Name"
                                            wire:model.live='name'>
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Category Description</label>
                                        <input type="text" class="form-control" placeholder="Category Description"
                                            wire:model.live='description'>
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12" wire:offline>
                                    <p class="text-danger">You are offline</p>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary" wire:offline.attr="disabled" wire:click.prevent='addCategory'>
                                        <span wire:loading>Processing...</span>
                                        <span wire:loading.remove>Submit</span>
                                    </button>
                                </div>

                                <style>
                                    .btn:disabled {
                                        opacity: 0.6;
                                        cursor: not-allowed;
                                    }
                                </style>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
