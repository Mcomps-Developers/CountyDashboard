<div class="content container-fluid">
    @section('title')
    Wards in {{$subCountyName}}
    @endsection
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Administration</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Wards in {{$subCountyName}}</li>
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
                                <h3 class="page-title">Wards in {{$subCountyName}}</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href="javascript:void(0);" class="btn btn-outline-primary me-2"><i
                                        class="fas fa-download"></i>
                                    Download</a>
                                <a href="{{ route('ward.add',['subCounty_id'=>$subCounty_id]) }}"
                                    class="btn btn-primary"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table
                            class="table mb-0 border-0 star-student table-hover table-center datatable table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th>Name</th>
                                    <th>Constituency</th>
                                    <th>Created Date</th>
                                    <th>Updated Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcounties as $item)
                                <tr>
                                    <td>
                                        <h2>
                                            <a>{{ $item->name }}</a>
                                        </h2>
                                    </td>
                                    <td>{{ $item->subCounty->name }}</td>
                                    <td>{{ date('d M Y h:iA', strtotime($item->created_at)) }}</td>
                                    <td>{{ date('d M Y h:iA', strtotime($item->updated_at)) }}</td>
                                    <td>
                                        <a href="{{route('ward.edit',['ward_id'=>$item->id])}}"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" wire:target='deleteWard({{ $item->id }})'
                                            wire:click.prevent='deleteWard({{ $item->id }})'
                                            wire:confirm='Are you sure you want to delete?'><i
                                                class="fa fa-trash text-danger" style="padding-left: 6px;"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
