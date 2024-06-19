<div class="content container-fluid">
    @section('title')
        Home Sliders
    @endsection
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Home Sliders</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Home Sliders</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">

                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Manage Home Sliders</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                    Download</a>
                                <a href="{{ route('slider.add') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table
                            class="table mb-0 border-0 star-student table-hover table-center datatable table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th>Title</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $item)
                                    <tr>
                                        <td>
                                            <h2>
                                                <a>{{ $item->heading }}</a>
                                            </h2>
                                        </td>
                                        <td>{{ date('M d, Y', strtotime($item->start_date)) }}</td>
                                        <td>{{ date('M d, Y', strtotime($item->end_date)) }}</td>
                                        <td>
                                            @if ($item->status === 'active')
                                                <a href="javascript:void(0);" class="btn btn-success btn-sm"
                                                    style="text-transform: capitalize">
                                                    {{ $item->status }}
                                                </a>
                                            @else
                                                <a href="javascript:void(0);" class="btn btn-danger btn-sm"
                                                    style="text-transform: capitalize">
                                                    {{ $item->status }}
                                                </a>
                                            @endif

                                        </td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="javascript:;" class="btn btn-sm bg-success-light me-2">
                                                    <i class="feather-eye"></i>
                                                </a>
                                                <a href="{{ route('slider.edit', ['reference' => $item->reference]) }}"
                                                    class="btn btn-sm bg-danger-light">
                                                    <i class="feather-edit"></i>
                                                </a>
                                                <a href="javascript:void(0);"
                                                    wire:target='deleteSlider({{ $item->id }})'
                                                    wire:confirm='Are you sure you want to delete?'
                                                    wire:click.prevent='deleteSlider({{ $item->id }})'
                                                    class="btn btn-sm bg-danger-light">
                                                    <i class="feather-delete"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $sliders->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
