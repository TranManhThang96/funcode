<table class="table table-bordered">
    <thead>
    <tr class="thead--row">
        <th scope="col" class="font-weight-bold">#</th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'label' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="label">{{__('admin_label.pages.tags.table.label')}}
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'slug' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="slug">{{__('admin_label.pages.tags.table.slug')}}
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'articles_count' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="articles_count">{{__('admin_label.pages.tags.table.articles_count')}}
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'created_at' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="created_at">{{__('admin_label.common.table.created_at')}}
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'updated_at' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="updated_at">{{__('admin_label.common.table.updated_at')}}
        </th>
        <th scope="col" class="font-weight-bold">{{__('admin_label.common.table.action')}}</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($tags as $item)
        <tr>
            <td scope="row">{{($tags->currentPage() - 1) * $tags->perPage() + $loop->iteration}}</td>
            <td>{{$item->label}}</td>
            <td>{{$item->slug}}</td>
            <td>{{$item->articles_count}}</td>
            <td>{{date('d/m/Y H:i:s', strtotime($item->created_at))}}</td>
            <td>{{date('d/m/Y H:i:s', strtotime($item->updated_at))}}</td>
            <td>
                <button type="button" class="btn btn-cyan btn-sm btn-edit-tag" data-tag-id="{{$item->id}}">
                    {{__('admin_label.common.table.edit')}}
                </button>
                <button type="button" class="btn btn-danger btn-sm btn-delete-tag" data-tag-id="{{$item->id}}">
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
        {{__('admin_label.common.entries.showing')}} {{$tags->total() > ($tags->currentPage() - 1) * $tags->perPage() ? ($tags->currentPage() - 1) * $tags->perPage() + 1 : 0}} {{__('admin_label.common.entries.to')}}
        {{$tags->total() < ($tags->currentPage() - 1) * $tags->perPage() + $tags->perPage() ? $tags->total() : ($tags->currentPage() - 1) * $tags->perPage() + $tags->perPage()}}
        {{__('admin_label.common.entries.of')}}
        {{$tags->total()}} {{__('admin_label.common.entries.entries')}}
    </div>
    <div class="col-md-6">
        {{$tags->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>
