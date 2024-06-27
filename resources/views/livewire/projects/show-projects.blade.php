<div class="content container-fluid">
    @section('title')
        Projects
    @endsection
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Admin</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Projects</li>
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
                                <h3 class="page-title">Projects</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href="javascript:void(0);" class="btn btn-outline-primary me-2"><i
                                        class="fas fa-download"></i>
                                    Download</a>
                                <a href="{{ route('project.add') }}" class="btn btn-primary"><i
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
                                    <th>Department</th>
                                    <th>Created Date</th>
                                    <th>Updated Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $item)
                                    <tr>
                                        <td>
                                            <h2>
                                                <a>{{ $item->title }}</a>
                                            </h2>
                                        </td>
                                        <td>
                                            <h2 style="text-transform: capitalize">
                                                @if ($item->department_id)
                                                    <a>{{ $item->department->name }}</a>
                                                @else
                                                    <a>{{ $item->category_name }}</a>
                                                @endif
                                            </h2>
                                        </td>
                                        <td>{{ date('d M Y h:iA', strtotime($item->created_at)) }}</td>
                                        <td>{{ date('d M Y h:iA', strtotime($item->updated_at)) }}</td>
                                        <td>

                                            <a href="{{ route('project.edit', ['project_id' => $item->id]) }}"
                                                style="padding-left: 6px;"><i class="fa fa-edit text-success"></i></a>
                                            <a href="javascript:void(0);"
                                                wire:target='deleteProject({{ $item->id }})'
                                                wire:click.prevent='deleteProject({{ $item->id }})'
                                                wire:confirm='Are you sure you want to delete?'><i
                                                    class="fa fa-trash text-danger" style="padding-left: 6px;"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $projects->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
