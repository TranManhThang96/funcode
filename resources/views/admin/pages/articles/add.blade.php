@extends('admin.layout.default')

@section('title', 'Articles - new')

@section('breadcrumb')
    {{renderBreadcrumb('Create', [['name' => 'Home', 'link' => '/'], ['name' => 'Articles', 'link' => route('admin.articles.index')]])}}
@endsection

@section('content')
    <form>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="article-name">Name</label>
                    <input type="text" class="form-control" id="article-name" placeholder="Enter article name">
                </div>

                <div class="form-group">
                    <label for="article-category">Category</label>
                    <select class="custom-select custom-select-2 mr-sm-2 select-category-parent" name="category_id">
                        <option selected value="{{\App\Enums\DBConstant::NO_PARENT}}">No Parent</option>
                        @if(isset($categories))
                            @foreach($categories as $category)
                                <option value="{{$category['id']}}">{{$category['label']}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="excerpt-content">Excerpt</label>
                    <textarea class="form-control" id="excerpt-content" rows="3"></textarea>
                </div>
            </div>

            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        oki con de
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('script')

@endsection

@section('css')

@endsection
