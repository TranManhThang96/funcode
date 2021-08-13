<table class="table table-bordered">
    <thead>
    <tr class="thead--row">
        <th scope="col" class="font-weight-bold">#</th>
        <th scope="col" class="font-weight-bold">{{__('admin_label.pages.categories.table.name')}}</th>
        <th scope="col" class="font-weight-bold">{{__('admin_label.pages.categories.table.slug')}}</th>
        <th scope="col" class="font-weight-bold">{{__('admin_label.pages.categories.table.full_path')}}</th>
        <th scope="col" data-sort-by="articles_count"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'articles_count' ? 'sorting--'.request()->get('order_by') : ''}}">
            {{__('admin_label.pages.categories.table.articles_count')}}
        </th>
        <th scope="col" data-sort-by="created_at"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'created_at' ? 'sorting--'.request()->get('order_by') : ''}}">
            {{__('admin_label.common.table.created_at')}}
        </th>
        <th scope="col" data-sort-by="updated_at"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'updated_at' ? 'sorting--'.request()->get('order_by') : ''}}">
            {{__('admin_label.common.table.updated_at')}}
        </th>
        <th scope="col" class="font-weight-bold">{{__('admin_label.common.table.action')}}</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($categories as $category)
        <tr>
            <td scope="row">{{($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration}}</td>
            <td>
                <div>{{renderCategoryName($category['name'], $category['level'] ?? null)}}</div>
            </td>
            <td>{{$category['slug']}}</td>
            <td>{{$category['full_path'] ?? 'N/A'}}</td>
            <td>
                <a href="{{route('admin.articles.index', ['category_id' => $category['id']])}}">{{$category['articles_count']}}</a>
            </td>
            <td>{{$category['created_at']}}</td>
            <td>{{$category['updated_at']}}</td>
            <td>
                <button type="button" class="btn btn-cyan btn-sm btn-edit-category"
                        data-category-id="{{$category['id']}}">{{__('admin_label.common.table.edit')}}
                </button>
                <button type="button" class="btn btn-danger btn-sm btn-delete-category"
                        data-category-id="{{$category['id']}}">{{__('admin_label.common.table.delete')}}</button>
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
        {{__('admin_label.common.entries.showing')}} {{$categories->total() > ($categories->currentPage() - 1) * $categories->perPage() ? ($categories->currentPage() - 1) * $categories->perPage() + 1 : 0}} {{__('admin_label.common.entries.to')}}
        {{$categories->total() < ($categories->currentPage() - 1) * $categories->perPage() + $categories->perPage() ? $categories->total() : ($categories->currentPage() - 1) * $categories->perPage() + $categories->perPage()}}
        {{__('admin_label.common.entries.of')}}
        {{$categories->total()}} {{__('admin_label.common.entries.entries')}}
    </div>
    <div class="col-md-6">
        {{$categories->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>
