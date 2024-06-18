<div class="content container-fluid">
    @section('title')
        {{ $category->name }} Events
    @endsection
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Events</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">{{ $category->name }} Events</li>
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
                                <h3 class="page-title">Events</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                    Download</a>
                                <a href="{{ route('event.add', ['slug' => $category->name]) }}"
                                    class="btn btn-primary"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table
                            class="table mb-0 border-0 star-student table-hover table-center datatable table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Location</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $item)
                                    <tr>
                                        <td style="text-transform: uppercase">{{ $item->reference }}</td>
                                        <td>
                                            <h2>
                                                <a>{{ $item->title }}</a>
                                            </h2>
                                        </td>
                                        <td>{{ $item->location }}</td>
                                        <td>{{ date('d M Y h:iA', strtotime($item->start_date_and_time)) }}</td>
                                        <td>{{ date('d M Y h:iA', strtotime($item->end_date_and_time)) }}</td>
                                        <td>
                                            <a href="{{ route('event.edit', ['reference' => $item->reference]) }}">
                                                <i class="fa fa-edit text-primary"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $events->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
