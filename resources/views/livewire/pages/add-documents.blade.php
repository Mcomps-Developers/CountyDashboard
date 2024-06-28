<div class="content container-fluid">
    @section('title')
        Upload Document
    @endsection
    <div class="row">
        <div class="col-xl-12">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Upload Document</h3>
                    </div>
                </div>
            </div>

            <div class="card">
                <form wire:submit.prevent="saveChanges">
                    <div class="card-body">
                        <div class="bank-inner-details">

                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>Document Title<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model.live='title'>
                                        @error('title')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>Type <span class="text-danger">*</span></label>
                                        <select name="" id="" class="form-control" wire:model='type'>
                                            <option>--</option>
                                            <option value="tender"> Tender</option>
                                            <option value="budget"> Budget</option>
                                            <option value="vacancy"> Vacancy</option>
                                            <option value="other">Other</option>
                                        </select>
                                        @error('type')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                @if (empty($category_name))
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Department <span class="text-danger">Optional</span></label>
                                            <select name="" id="" class="form-control"
                                                wire:model='department'>
                                                <option>--</option>
                                                @foreach ($departments as $item)
                                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('department')
                                                <p class="text text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                @if (empty($department))
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Category, where not for department <span
                                                    class="text-danger">Optional</span></label>
                                            <input type="text" class="form-control" wire:model.live='category_name'>
                                            @error('category_name')
                                                <p class="text text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <div class="change-photo-btn">
                                            <div>
                                                @if ($document)
                                                    <p>Change Document</p>
                                                    <p>{{ $document->getClientOriginalName() }}</p>
                                                @else
                                                    <p>Upload Document</p>
                                                @endif
                                                <small></small>
                                                <p wire:loading wire:target='document'>Uploading Document...</p>
                                            </div>
                                            <input type="file" class="upload" wire:model.live='document'>
                                        </div>
                                        @error('document')
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
