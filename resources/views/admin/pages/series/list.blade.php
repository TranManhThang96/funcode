<table class="table table-bordered">
    <thead>
    <tr class="thead--row">
        <th scope="col" class="font-weight-bold">#</th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'name' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="name">Name
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'slug' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="slug">Slug
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'count' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="count">Count
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'created_at' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="created_at">Created At
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'updated_at' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="updated_at">Updated At
        </th>
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
            <td>{{date('d/m/Y H:i:s', strtotime($item->created_at))}}</td>
            <td>{{date('d/m/Y H:i:s', strtotime($item->updated_at))}}</td>
            <td>
                <button type="button" class="btn btn-cyan btn-sm btn-edit-series" data-series-id="{{$item->id}}">Edit
                </button>
                <button type="button" class="btn btn-danger btn-sm btn-delete-series" data-series-id="{{$item->id}}">
                    Delete
                </button>
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
        Showing {{$series->total() > ($series->currentPage() - 1) * $series->perPage() ? ($series->currentPage() - 1) * $series->perPage() + 1 : 0}}
        to
        {{$series->total() < ($series->currentPage() - 1) * $series->perPage() + $series->perPage() ? $series->total() : ($series->currentPage() - 1) * $series->perPage() + $series->perPage()}}
        of
        {{$series->total()}} entries
    </div>
    <div class="col-md-6">
        {{$series->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>
