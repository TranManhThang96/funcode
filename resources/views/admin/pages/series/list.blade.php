<table class="table table-bordered">
    <thead>
    <tr class="thead--row">
        <th scope="col" class="font-weight-bold">#</th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'name' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="name">{{__('admin_label.pages.series.table.label')}}
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'slug' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="slug">{{__('admin_label.pages.series.table.slug')}}
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'count' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="count">{{__('admin_label.pages.series.table.articles_count')}}
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'created_at' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="created_at">{{__('admin_label.common.table.created_at')}}
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'updated_at' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="updated_at">{{__('admin_label.common.table.updated_at')}}
        </th>
        <th scope="col" class="font-weight-bold">{{__('admin_label.common.table.action')}}</th>
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
                <button type="button" class="btn btn-cyan btn-sm btn-edit-series" data-series-id="{{$item->id}}">
                    {{__('admin_label.common.table.edit')}}
                </button>
                <button type="button" class="btn btn-danger btn-sm btn-delete-series" data-series-id="{{$item->id}}">
                    {{__('admin_label.common.table.delete')}}
                </button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="text-center font-weight-bold py-5">{{__('admin_label.common.table.empty_data')}}</td>
        </tr>
    @endforelse
    </tbody>
</table>
<div class="row mx-0 mt-2">
    <div class="col-md-6">
        {{__('admin_label.common.entries.showing')}} {{$series->total() > ($series->currentPage() - 1) * $series->perPage() ? ($series->currentPage() - 1) * $series->perPage() + 1 : 0}} {{__('admin_label.common.entries.to')}}
        {{$series->total() < ($series->currentPage() - 1) * $series->perPage() + $series->perPage() ? $series->total() : ($series->currentPage() - 1) * $series->perPage() + $series->perPage()}}
        {{__('admin_label.common.entries.of')}}
        {{$series->total()}} {{__('admin_label.common.entries.entries')}}
    </div>
    <div class="col-md-6">
        {{$series->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>
