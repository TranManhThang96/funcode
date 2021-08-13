<table class="table table-bordered">
    <thead>
    <tr class="thead--row">
        <th scope="col" class="font-weight-bold">#</th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'title' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="title">{{__('admin_label.pages.articles.table.title')}}
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'slug' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="slug">{{__('admin_label.pages.articles.table.slug')}}
        </th>
        <th scope="col"
            class="font-weight-bold"
            data-sort-by="image">{{__('admin_label.pages.articles.table.image')}}
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'category_id' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="category_id">{{__('admin_label.pages.articles.table.category')}}
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'series_id' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="series_id">{{__('admin_label.pages.articles.table.series')}}
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'status' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="status">{{__('admin_label.pages.articles.table.status')}}
        </th>
        <th scope="col"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'type' ? 'sorting--'.request()->get('order_by') : ''}}"
            data-sort-by="type">{{__('admin_label.pages.articles.table.type')}}
        </th>
        <th scope="col" class="font-weight-bold">{{__('admin_label.pages.articles.table.tag')}}</th>
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
    @forelse ($articles as $article)
        <tr>
            <td scope="row">{{($articles->currentPage() - 1) * $articles->perPage() + $loop->iteration}}</td>
            <td>{{$article->title}}</td>
            <td>{{$article->slug}}</td>
            <td>
                <img src="{{$article->image}}" alt="{{$article->title}}"
                     onerror="this.src='http://admin.funcode.tk/assets/images/no-image.png'" style="max-width: 150px">
            </td>
            <td>{{$article->category->name ?? ''}}</td>
            <td>{{$article->series->name ?? ''}}</td>
            <td>{{$article->status_label ?? ''}}</td>
            <td>{{$article->type_label ?? ''}}</td>
            <td>
                @foreach($article->tags as $tag)
                    <span class="article-tag {{request()->tag_id == $tag['id'] ? 'article-tag-searched' : ''}}">{{$tag->label}}</span>
                @endforeach
            </td>
            <td>{{date('d/m/Y H:i:s', strtotime($article->created_at))}}</td>
            <td>{{date('d/m/Y H:i:s', strtotime($article->updated_at))}}</td>
            <td>
                <div class="flex d-flex">
                    <a href="{{route('admin.articles.edit', ['article' => $article->id])}}" type="button"
                       class="btn btn-cyan btn-sm btn-edit-article mr-2">
                        {{__('admin_label.common.table.edit')}}
                    </a>
                    <button type="button" class="btn btn-danger btn-sm btn-delete-article"
                            data-article-id="{{$article->id}}">
                        {{__('admin_label.common.table.delete')}}
                    </button>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="12"
                class="text-center font-weight-bold py-5">{{__('admin_label.common.table.empty_data')}}</td>
        </tr>
    @endforelse
    </tbody>
</table>
<div class="row mx-0 mt-2">
    <div class="col-md-6">
        {{__('admin_label.common.entries.showing')}} {{$articles->total() > ($articles->currentPage() - 1) * $articles->perPage() ? ($articles->currentPage() - 1) * $articles->perPage() + 1 : 0}} {{__('admin_label.common.entries.to')}}
        {{$articles->total() < ($articles->currentPage() - 1) * $articles->perPage() + $articles->perPage() ? $articles->total() : ($articles->currentPage() - 1) * $articles->perPage() + $articles->perPage()}}
        {{__('admin_label.common.entries.of')}}
        {{$articles->total()}} {{__('admin_label.common.entries.entries')}}
    </div>
    <div class="col-md-6">
        {{$articles->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>
