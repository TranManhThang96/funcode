@extends('web.layout.default')

@section('content')
    @foreach($articles as $item)
        <div class="articles-item card mb-4">
            <a title="{{$item->title}}" href="{{route('web.articles.show', ['article' => $item->slug])}}" class="articles-item-link"></a>
            <div class="articles-item-content" style="min-height: 0">
                <h4 class="articles-item-content-title">
                    👉 {{$item->title}}</h4>
                <p class="articles-item-content-preview">
                    {{$item->excerpt}}
                </p>
            </div>
        </div>
    @endforeach
    <div class="col-12">
        {{$articles->links('vendor.pagination.bootstrap-4')}}
    </div>
@endsection
