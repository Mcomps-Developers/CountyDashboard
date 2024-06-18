<div class="content container-fluid">
    @section('title')
        Home Stats
    @endsection
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Home Stats</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Home Stats</li>
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
                                <h5 class="form-title"><span>Home stats</span></h5>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Population</label>
                                    <input type="number" class="form-control" wire:model.live='population'>
                                    @error('population')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Land Coverage (Square Km)</label>
                                    <input type="text" class="form-control" wire:model.live='land_coverage'>
                                    @error('land_coverage')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
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
