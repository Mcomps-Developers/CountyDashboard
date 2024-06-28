<div class="content container-fluid">
    @section('title')
        Edit
    @endsection
    <div class="row">
        <div class="col-xl-12">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Edit</h3>
                    </div>
                </div>
            </div>
            <div class="card">
                <form wire:submit.prevent="saveChanges">
                    <div class="card-body">
                        <div class="bank-inner-details">

                            <div class="row">
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label>Document Title<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model.live='title'>
                                        @error('title')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label>Document Type<span class="text-danger">*</span></label>
                                        <select name="" id="" class="form-control"
                                            wire:model.live='type'>
                                            <option>--</option>
                                            <option value="budget">Budget</option>
                                            <option value="tender">Tender</option>
                                            <option value="vacancy">Vacancy</option>
                                            <option value="other">Other</option>
                                        </select>
                                        @error('type')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label>Folder<span class="text-danger">*</span></label>
                                        <select name="" id="" class="form-control" wire:model.live='folder'>
                                            <option>--</option>
                                            @foreach ($folders as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach

                                        </select>
                                        @error('folder')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <div class="change-photo-btn">
                                            <div>
                                                @if ($newDocument)
                                                    <p>Change File</p>
                                                    <p>{{ $newDocument->getClientOriginalName() }}</p>
                                                @else
                                                    <p>Upload File</p>
                                                @endif
                                                <small></small>
                                                <p wire:loading wire:target='newDocument'>Uploading File...</p>
                                            </div>
                                            <input type="file" class="upload" wire:model.live='newDocument'>
                                        </div>
                                        @error('newDocument')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
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
