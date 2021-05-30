@extends('admin.layout.default')

@section('title', 'Articles - new')

@section('breadcrumb')
    {{renderBreadcrumb('Create', [['name' => 'Home', 'link' => '/'], ['name' => 'Articles', 'link' => route('admin.articles.index')]])}}
@endsection

@section('content')
    <form id="articles-frm">
        <div class="row">
            <div class="col-3 bg-white py-2">
                <div class="form-group">
                    <label for="article-name">Name</label>
                    <input type="text" class="form-control" id="article-name" placeholder="Enter article name">
                </div>

                <div class="form-group">
                    <label for="article-category">Category</label>
                    <select class="custom-select custom-select-2 mr-sm-2 select-category-parent" name="category_id">
                        <option selected value="{{\App\Enums\DBConstant::NO_CATEGORY}}">No Category</option>
                        @if(isset($categories))
                            @foreach($categories as $category)
                                <option value="{{$category['id']}}">{{$category['label']}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="article-category">Tag</label>
                    <select class="custom-select custom-select-2 mr-sm-2 select-category-parent" name="tags"
                            multiple="multiple">
                        <option selected value="{{\App\Enums\DBConstant::NO_CATEGORY}}">No Category</option>
                        @if(isset($categories))
                            @foreach($categories as $category)
                                <option value="{{$category['id']}}">{{$category['label']}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="excerpt-content">Status</label></br/>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status-publish"
                               value="{{\App\Enums\DBConstant::ARTICLE_PUBLISH}}">
                        <label class="form-check-label"
                               for="status-publish">{{\App\Enums\Constant::ARTICLE_PUBLISH_LABEL}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status-draft"
                               value="{{\App\Enums\DBConstant::ARTICLE_DRAFT}}">
                        <label class="form-check-label"
                               for="status-draft">{{\App\Enums\Constant::ARTICLE_DRAFT_LABEL}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status-deleted"
                               value="{{\App\Enums\DBConstant::ARTICLE_DELETED}}">
                        <label class="form-check-label"
                               for="status-deleted">{{\App\Enums\Constant::ARTICLE_DELETED_LABEL}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status-pending"
                               value="{{\App\Enums\DBConstant::ARTICLE_PENDING}}">
                        <label class="form-check-label"
                               for="status-pending">{{\App\Enums\Constant::ARTICLE_PENDING_LABEL}}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="excerpt-content">Type</label></br/>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="type-article"
                               value="{{\App\Enums\DBConstant::ARTICLE}}">
                        <label class="form-check-label"
                               for="type-article">{{\App\Enums\Constant::ARTICLE_LABEL}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="type-learn"
                               value="{{\App\Enums\DBConstant::LEARN}}">
                        <label class="form-check-label" for="type-learn">{{\App\Enums\Constant::LEARN_LABEL}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="type-tip"
                               value="{{\App\Enums\DBConstant::TIP}}">
                        <label class="form-check-label" for="type-tip">{{\App\Enums\Constant::TIP_LABEL}}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="excerpt-content">Excerpt</label>
                    <textarea class="form-control" id="excerpt-content" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="excerpt-content">Image</label>
                    <div id="articles-image">
                        <input name="image" id="image-input" value="" type="hidden" />
                        <img id="image-preview" src="{{asset('assets/images/no-image.png')}}" alt="no-image"/>
                        <div id="articles-image-remove" class="m-icon d-flex justify-content-center align-items-center">
                            <i class="mdi mdi-close-circle"></i>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-9 bg-white py-2">
                <div class="card">
                    <div class="card-body">
                        <textarea id="editor" name="content" rows="30"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script type="text/javascript" src="{{asset('js/articles/add.js')}}"></script>
@endsection

@section('css')
    <link href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/articles/add.css')}}" rel="stylesheet"/>
@endsection
