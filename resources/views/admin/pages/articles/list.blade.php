<table class="table table-bordered">
    <thead>
    <tr class="thead--row">
        <th scope="col" class="font-weight-bold">#</th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'title' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="title">Name
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'slug' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="slug">Slug
        </th>
        <th scope="col"
            class="font-weight-bold"
            data-sort-by="image">Image
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'category_id' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="category_id">Category
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'series_id' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="series_id">Series
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'status' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="status">Status
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'type' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="type">Type
        </th>
        <th scope="col" class="font-weight-bold">Tags</th>
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
            <td>
                <img src="{{$article->image}}" alt="{{$article->title}}" onerror="this.src='http://admin.funcode.tk/assets/images/no-image.png'" style="max-width: 150px">
            </td>
            <td>{{$article->category->name ?? ''}}</td>
            <td>{{$article->series->name ?? ''}}</td>
            <td>{{$article->status_label ?? ''}}</td>
            <td>{{$article->type_label ?? ''}}</td>
            <td>
                @foreach($article->tags as $tag)
                    <span class="article-tag">{{$tag->label}}</span>
                @endforeach
            </td>
            <td>{{date('d/m/Y H:i:s', strtotime($article->created_at))}}</td>
            <td>{{date('d/m/Y H:i:s', strtotime($article->updated_at))}}</td>
            <td>
                <div class="flex d-flex">
                    <a href="{{route('admin.articles.edit', ['article' => $article->id])}}" type="button" class="btn btn-cyan btn-sm btn-edit-article mr-2">Edit</a>
                    <button type="button" class="btn btn-danger btn-sm btn-delete-article" data-article-id="{{$article->id}}">
                        Delete
                    </button>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="12" class="text-center font-weight-bold py-5">Empty data!</td>
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
