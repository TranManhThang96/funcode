<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col" class="font-weight-bold">#</th>
        <th scope="col" class="font-weight-bold">Name</th>
        <th scope="col" class="font-weight-bold">Slug</th>
        <th scope="col" class="font-weight-bold">Count</th>
        <th scope="col" class="font-weight-bold">Created At</th>
        <th scope="col" class="font-weight-bold">Updated At</th>
        <th scope="col" class="font-weight-bold">Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($series as $item)
        <tr>
            <td scope="row">{{($series->currentPage() - 1) * $series->perPage() + $loop->iteration}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->slug}}</td>
            <td>0</td>
            <td>{{$item->created_at}}</td>
            <td>{{$item->updated_at}}</td>
            <td>
                <button type="button" class="btn btn-cyan btn-sm btn-edit-series"
                        data-series-id="{{$item->id}}">Edit
                </button>
                <button type="button" class="btn btn-danger btn-sm btn-delete-series">Delete</button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="text-center font-weight-bold py-5">Empty data!</td>
        </tr>
    @endforelse
    </tbody>
</table>
<div class="row mx-0 mt-2">
    <div class="col-md-6">
        Showing {{$series->total() > ($series->currentPage() - 1) * $series->perPage() ? ($series->currentPage() - 1) * $series->perPage() + 1 : 0}} to
        {{$series->total() < ($series->currentPage() - 1) * $series->perPage() + $series->perPage() ? $series->total() : ($series->currentPage() - 1) * $series->perPage() + $series->perPage()}}
        of
        {{$series->total()}} entries
    </div>
    <div class="col-md-6">
        {{$series->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>
