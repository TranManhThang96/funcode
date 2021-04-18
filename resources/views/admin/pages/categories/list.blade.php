<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col" class="font-weight-bold">#</th>
        <th scope="col" class="font-weight-bold">Name</th>
        <th scope="col" class="font-weight-bold">Slug</th>
        <th scope="col" class="font-weight-bold">Full Path</th>
        <th scope="col" class="font-weight-bold">Count</th>
        <th scope="col" class="font-weight-bold">Created At</th>
        <th scope="col" class="font-weight-bold">Updated At</th>
        <th scope="col" class="font-weight-bold">Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($categories as $category)
        <tr>
            <td scope="row">{{($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration}}</td>
            <td>
                <div>{{renderCategoryName($category['name'], $category['level'])}}</div>
            </td>
            <td>{{$category['slug']}}</td>
            <td>{{$category['full_path']}}</td>
            <td>0</td>
            <td>{{$category['created_at']}}</td>
            <td>{{$category['updated_at']}}</td>
            <td>
                <button type="button" class="btn btn-cyan btn-sm btn-edit-category"
                        data-category-id="{{$category['id']}}">Edit
                </button>
                <button type="button" class="btn btn-danger btn-sm">Delete</button>
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
        Showing {{$categories->total() > ($categories->currentPage() - 1) * $categories->perPage() ? ($categories->currentPage() - 1) * $categories->perPage() + 1 : 0}} to
        {{$categories->total() < ($categories->currentPage() - 1) * $categories->perPage() + $categories->perPage() ? $categories->total() : ($categories->currentPage() - 1) * $categories->perPage() + $categories->perPage()}}
        of
        {{$categories->total()}} entries
    </div>
    <div class="col-md-6">
        {{$categories->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>
