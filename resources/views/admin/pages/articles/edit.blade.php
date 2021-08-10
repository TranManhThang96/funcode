@extends('admin.layout.default')

@section('title', __('admin_label.pages.articles.edit_articles.title'))

@section('breadcrumb')
    {{renderBreadcrumb(__('admin_label.pages.articles.edit_articles.edit_breadcrumb'), [['name' => __('admin_label.pages.home.title'), 'link' => '/'], ['name' => __('admin_label.pages.articles.title'), 'link' => route('admin.articles.index')]])}}
@endsection

@section('content')
    <form id="articles-frm" method="POST" action="{{route('admin.articles.update', ['article' => $article->id])}}">
        @method('PUT')
        @csrf
        <input type="hidden" name="id" value="{{$article->id}}"/>
        <div class="row">
            <div class="col-9 bg-white py-2">
                <div class="card">
                    <div class="card-body">
                        @include('admin.pages.articles.components.toolbar_editor')
                        <div id="editor" style="height: 900px;" name="content"
                             class="{{$errors->has('content') ? 'invalid-border' : ''}}">
                            {!! old('content') ?? $article->content !!}
                        </div>
                        <x-custom-error field="content"/>
                        <textarea id="editor" name="content" rows="30" style="display: none"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-3 bg-white py-2">
                <div class="form-group">
                    <label for="article-name">{{__('admin_label.pages.articles.table.title')}}</label>
                    <input name="title" type="text" value="{{old('title') ?? $article->title}}"
                           class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}"
                           id="article-title" placeholder="Enter article title">
                    <x-custom-error field="title"/>
                </div>

                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="article-category">{{__('admin_label.pages.articles.table.category')}}</label>
                        <i class="mdi mdi-plus-circle" id="btn-add-category"></i>
                    </div>
                    <div id="articles-categories-options">
                        <select class="custom-select custom-select-2 mr-sm-2 select-category-option" name="category_id">
                            <option selected
                                    value="{{\App\Enums\DBConstant::NO_CATEGORY}}">{{__('admin_label.pages.articles.table.no_category')}}</option>
                            @if(isset($categories))
                                @foreach($categories as $category)
                                    <option
                                        value="{{$category['id']}}" {{(old('category_id') ?? $article->category_id) == $category['id'] ? 'selected' : ''}}>{{$category['label']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <x-custom-error field="category_id"/>
                </div>

                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="article-series">{{__('admin_label.pages.articles.table.series')}}</label>
                        <i class="mdi mdi-plus-circle" id="btn-add-series"></i>
                    </div>
                    <div id="articles-series-options">
                        <select class="custom-select custom-select-2 mr-sm-2 select-series-option" name="series_id">
                            <option selected value=""></option>
                            @if(isset($series))
                                @foreach($series as $seriesItem)
                                    <option
                                        value="{{$seriesItem['id']}}" {{(old('series_id') ?? $article->series_id) == $seriesItem['id'] ? 'selected' : ''}}>
                                        {{$seriesItem['name']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <x-custom-error field="series_id"/>
                </div>

                <div class="form-group">
                    <label for="article-tags">{{__('admin_label.pages.articles.table.tag')}}</label>
                    <select id="article-tags-multiple" class="custom-select custom-select-2 mr-sm-2 select-tags"
                            name="tags[]"
                            multiple="multiple">
                        @if(isset($tags))
                            @foreach($tags as $tag)
                                <option
                                    value="{{$tag['id']}}" {{in_array($tag['id'], old('tags') ?? $article->tags->pluck('id')->toArray()) ? 'selected' : ''}}>{{$tag['label']}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="excerpt-content">{{__('admin_label.pages.articles.table.status')}}</label></br/>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio"
                               {{(old('status') ?? $article->status) == \App\Enums\DBConstant::ARTICLE_DRAFT ? 'checked' : ''}} name="status"
                               id="status-draft"
                               value="{{\App\Enums\DBConstant::ARTICLE_DRAFT}}">
                        <label class="form-check-label"
                               for="status-draft">{{\App\Enums\Constant::ARTICLE_DRAFT_LABEL}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio"
                               {{(old('status') ?? $article->status) == \App\Enums\DBConstant::ARTICLE_PUBLISH ? 'checked' : ''}} name="status"
                               id="status-publish"
                               value="{{\App\Enums\DBConstant::ARTICLE_PUBLISH}}">
                        <label class="form-check-label"
                               for="status-publish">{{\App\Enums\Constant::ARTICLE_PUBLISH_LABEL}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio"
                               {{(old('status') ?? $article->status) == \App\Enums\DBConstant::ARTICLE_DELETED ? 'checked' : ''}} name="status"
                               id="status-deleted"
                               value="{{\App\Enums\DBConstant::ARTICLE_DELETED}}">
                        <label class="form-check-label"
                               for="status-deleted">{{\App\Enums\Constant::ARTICLE_DELETED_LABEL}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio"
                               {{(old('status') ?? $article->status) == \App\Enums\DBConstant::ARTICLE_PENDING ? 'checked' : ''}} name="status"
                               id="status-pending"
                               value="{{\App\Enums\DBConstant::ARTICLE_PENDING}}">
                        <label class="form-check-label"
                               for="status-pending">{{\App\Enums\Constant::ARTICLE_PENDING_LABEL}}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="excerpt-content">{{__('admin_label.pages.articles.table.type')}}</label></br/>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio"
                               {{(old('type') ?? $article->type) == \App\Enums\DBConstant::LEARN ? 'checked' : ''}} checked
                               name="type" id="type-learn"
                               value="{{\App\Enums\DBConstant::LEARN}}">
                        <label class="form-check-label" for="type-learn">{{\App\Enums\Constant::LEARN_LABEL}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio"
                               {{(old('type') ?? $article->type) == \App\Enums\DBConstant::ARTICLE ? 'checked' : ''}} name="type"
                               id="type-article"
                               value="{{\App\Enums\DBConstant::ARTICLE}}">
                        <label class="form-check-label"
                               for="type-article">{{\App\Enums\Constant::ARTICLE_LABEL}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio"
                               {{(old('type') ?? $article->type) == \App\Enums\DBConstant::TIP ? 'checked' : ''}} name="type"
                               id="type-tip"
                               value="{{\App\Enums\DBConstant::TIP}}">
                        <label class="form-check-label" for="type-tip">{{\App\Enums\Constant::TIP_LABEL}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio"
                               {{(old('type') ?? $article->type) == \App\Enums\DBConstant::COPY ? 'checked' : ''}} name="type"
                               id="type-copy"
                               value="{{\App\Enums\DBConstant::COPY}}">
                        <label class="form-check-label" for="type-copy">{{\App\Enums\Constant::COPY_LABEL}}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="excerpt-content">{{__('admin_label.pages.articles.table.excerpt')}}</label>
                    <textarea name="excerpt" class="form-control {{$errors->has('excerpt') ? 'is-invalid' : ''}}"
                              id="excerpt-content" rows="3">{{old('excerpt') ?? $article->excerpt}}</textarea>
                    <x-custom-error field="excerpt"/>
                </div>

                <div class="form-group">
                    <label for="excerpt-content">{{__('admin_label.pages.articles.table.image')}}</label>
                    <div id="articles-image">
                        <input name="image" id="image-input" value="{{old('image') ?? $article->image}}" type="hidden"/>
                        <img id="image-preview"
                             src="{{(old('image') ?? $article->image) ?? asset('assets/images/no-image.png')}}"
                             alt="no-image"/>
                        <div id="articles-image-remove"
                             class="remove-button-corner d-flex justify-content-center align-items-center">
                        </div>
                    </div>
                    <x-custom-error field="image"/>
                </div>

                <div class="form-group" id="link-references">
                    <label>{{__('admin_label.pages.articles.table.link_references')}}</label>
                    <div id="link-references-group" class="my-2">
                        @if ($article->link_references && is_array($article->link_references))
                            @foreach($article->link_references as $link)
                                <div class="row references-item mb-2">
                                    <div class="col-9">
                                        <input type="text" value="{{$link}}" name="link_references[]" class="form-control" data-toggle="tooltip" title="{{$link}}" readonly>
                                    </div>
                                    <div class="col-3 d-flex justify-content-between align-items-center actions">
                                        <i class="mdi mdi-link btn-references-access" data-link="{{$link}}"></i>
                                        <i class="mdi mdi-tooltip-edit btn-references-edit" data-link="{{$link}}"></i>
                                        <i class="mdi mdi-delete btn-references-delete" data-link="{{$link}}"></i>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <textarea type="text" class="form-control" id="link-references-input" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" id="btn-submit"
                            class="btn btn-success">{{__('admin_label.common.button.submit')}}</button>
                </div>
            </div>
    </form>
    <div class="modal fade" id="modal-add-category" tabindex="-1" aria-labelledby="modal-add-category"
         aria-hidden="true">
        @include('admin.pages.categories.add')
    </div>
    <div class="modal fade" id="modal-add-series" tabindex="-1" aria-labelledby="modal-add-series"
         aria-hidden="true">
        @include('admin.pages.series.add')
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/highlight.min.js"
            integrity="sha512-z+/WWfyD5tccCukM4VvONpEtLmbAm5LDu7eKiyMQJ9m7OfPEDL7gENyDRL3Yfe8XAuGsS2fS4xSMnl6d30kqGQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/libs/quill/dist/quill.min.js')}}"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script type="text/javascript" src="{{asset('js/articles/add.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/articles/references.js')}}"></script>
    <script type="text/javascript">
        hljs.configure({   // optionally configure hljs
            languages: ['javascript', 'ruby', 'python', 'php']
        });
        $(document).on('click', 'input.ql-image', function (e) {
            e.preventDefault();
            var route_prefix = '/filemanager';
            window.open(route_prefix + '?type=' + 'image' || 'file', 'FileManager', 'width=1200,height=800');
            window.SetUrl = function (items) {
                var file_path = items.map(function (item) {
                    return item.url;
                }).join(',');
                console.log('file_path', file_path);
                quill.insertEmbed(10, 'image', `${file_path}`);
                // $('#editor .ql-editor').append(`<p ><img src="${file_path}"></p>`)
            };
        })
    </script>
@endsection

@section('css')
    <link type="text/css" href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}" rel="stylesheet"/>
    <link type="text/css" href="{{asset('assets/libs/quill/dist/quill.snow.css')}}" rel="stylesheet"/>
    <link type="text/css" href="{{asset('css/articles/add.css')}}" rel="stylesheet"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/styles/monokai-sublime.min.css"
          integrity="sha512-ade8vHOXH67Cm9z/U2vBpckPD1Enhdxl3N05ChXyFx5xikfqggrK4RrEele+VWY/iaZyfk7Bhk6CyZvlh7+5JQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endsection
