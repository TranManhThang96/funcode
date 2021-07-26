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
    @forelse ($articles as $article)
        <tr>
            <td scope="row">{{($articles->currentPage() - 1) * $articles->perPage() + $loop->iteration}}</td>
            <td>{{$article->title}}</td>
            <td>{{$article->slug}}</td>
            <td>0</td>
            <td>{{date('d/m/Y H:i:s', strtotime($article->created_at))}}</td>
            <td>{{date('d/m/Y H:i:s', strtotime($article->updated_at))}}</td>
            <td>
                <button type="button" class="btn btn-cyan btn-sm btn-edit-article" data-article-id="{{$article->id}}">Edit
                </button>
                <button type="button" class="btn btn-danger btn-sm btn-delete-article" data-article-id="{{$article->id}}">
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
        Showing {{$articles->total() > ($articles->currentPage() - 1) * $articles->perPage() ? ($articles->currentPage() - 1) * $articles->perPage() + 1 : 0}}
        to
        {{$articles->total() < ($articles->currentPage() - 1) * $articles->perPage() + $articles->perPage() ? $articles->total() : ($articles->currentPage() - 1) * $articles->perPage() + $articles->perPage()}}
        of
        {{$articles->total()}} entries
    </div>
    <div class="col-md-6">
        {{$articles->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>
