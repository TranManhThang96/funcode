@extends('web.layout.default')

@section('content')
    <div class="articles-content">
        {!! $articles->content !!}
    </div>
@endsection
