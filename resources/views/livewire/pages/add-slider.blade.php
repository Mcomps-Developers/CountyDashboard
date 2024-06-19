<div class="content container-fluid">
    @section('title')
        Add Home Slider
    @endsection
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Add Slider</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Add Slider</li>
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
                                <h5 class="form-title"><span>Slider Information</span></h5>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" wire:model.live='title'>
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control select" wire:model.live='status'>
                                        <option>Select Class</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    @error('status')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label>Paragraph Text (Optional)</label>
                                    <textarea name="" id="" cols="15" rows="3" class="form-control"
                                        wire:model.live='paragraph_text'></textarea>
                                    @error('paragraph_text')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Button Text (Optional)</label>
                                    <input type="text" class="form-control" wire:model.live='button_text'>
                                    @error('button_text')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Button URL (Optional)*</label>
                                    <input type="url" class="form-control" wire:model.live='button_url'>
                                    @error('button_url')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control" wire:model.live='start_date'>
                                    @error('start_date')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" class="form-control" wire:model.live='end_date'>
                                    @error('end_date')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <div class="change-photo-btn">
                                        <div>
                                            @if ($image)
                                                <p>Change Slider Photo</p>
                                            @else
                                                <p>Upload Slider Photo</p>
                                            @endif
                                            <small>Will automatically be resized to 1200x800 pixels.</small>
                                            <br>
                                            <p wire:loading wire:target='image'>Uploading...</p>
                                        </div>
                                        <input type="file" class="upload" wire:model.live='image'>
                                    </div>
                                    @error('image')
                                        <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            @if ($image)
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <div class="change-photo-btn">
                                            <div>
                                                @if ($image)
                                                    <img src="{{ $image->temporaryUrl() }}" width="90"
                                                        height="60" alt="">
                                                @else
                                                    <p>No slider photo has been uploaded</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
