@extends('admin.layout.default')

@section('title', 'Articles - new')

@section('breadcrumb')
    {{renderBreadcrumb('Create', [['name' => 'Home', 'link' => '/'], ['name' => 'Articles', 'link' => route('admin.articles.index')]])}}
@endsection

@section('content')
    <form id="articles-frm" method="POST" action="{{route('admin.articles.store')}}">
        @csrf
        <div class="row">
            <div class="col-9 bg-white py-2">
                <div class="card">
                    <div class="card-body">
                        @include('admin.pages.articles.components.toolbar_editor')
                        <div id="editor" style="height: 900px;" name="content" class="{{$errors->has('content') ? 'invalid-border' : ''}}"></div>
                        <x-custom-error field="content" />
                        <textarea id="editor" name="content" rows="30" style="display: none"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-3 bg-white py-2">
                <div class="form-group">
                    <label for="article-name">Title</label>
                    <input name="title" type="text" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" id="article-title" placeholder="Enter article title">
                    <x-custom-error field="title" />
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
                    <x-custom-error field="category_id" />
                </div>

                <div class="form-group">
                    <label for="article-series">Series</label>
                    <select class="custom-select custom-select-2 mr-sm-2" name="series_id">
                        <option selected value=""></option>
                        @if(isset($series))
                            @foreach($series as $seriesItem)
                                <option value="{{$seriesItem['id']}}">{{$seriesItem['name']}}</option>
                            @endforeach
                        @endif
                    </select>
                    <x-custom-error field="series_id" />
                </div>

                <div class="form-group">
                    <label for="article-tags">Tag</label>
                    <select id="article-tags-multiple" class="custom-select custom-select-2 mr-sm-2 select-tags" name="tags[]"
                            multiple="multiple">
                            @if(isset($tags))
                                @foreach($tags as $tag)
                                    <option value="{{$tag['id']}}">{{$tag['label']}}</option>
                                @endforeach
                            @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="excerpt-content">Status</label></br/>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" checked name="status" id="status-draft"
                               value="{{\App\Enums\DBConstant::ARTICLE_DRAFT}}">
                        <label class="form-check-label"
                               for="status-draft">{{\App\Enums\Constant::ARTICLE_DRAFT_LABEL}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status-publish"
                               value="{{\App\Enums\DBConstant::ARTICLE_PUBLISH}}">
                        <label class="form-check-label"
                               for="status-publish">{{\App\Enums\Constant::ARTICLE_PUBLISH_LABEL}}</label>
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
                        <input class="form-check-input" type="radio" checked name="type" id="type-learn"
                               value="{{\App\Enums\DBConstant::LEARN}}">
                        <label class="form-check-label" for="type-learn">{{\App\Enums\Constant::LEARN_LABEL}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="type-article"
                               value="{{\App\Enums\DBConstant::ARTICLE}}">
                        <label class="form-check-label"
                               for="type-article">{{\App\Enums\Constant::ARTICLE_LABEL}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="type-tip"
                               value="{{\App\Enums\DBConstant::TIP}}">
                        <label class="form-check-label" for="type-tip">{{\App\Enums\Constant::TIP_LABEL}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="type-copy"
                               value="{{\App\Enums\DBConstant::COPY}}">
                        <label class="form-check-label" for="type-copy">{{\App\Enums\Constant::COPY_LABEL}}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="excerpt-content">Excerpt</label>
                    <textarea name="excerpt" class="form-control {{$errors->has('excerpt') ? 'is-invalid' : ''}}" id="excerpt-content" rows="3"></textarea>
                    <x-custom-error field="excerpt" />
                </div>

                <div class="form-group">
                    <label for="excerpt-content">Image</label>
                    <div id="articles-image">
                        <input name="image" id="image-input" value="" type="hidden"/>
                        <img id="image-preview" src="{{asset('assets/images/no-image.png')}}" alt="no-image"/>
                        <div id="articles-image-remove" class="remove-button-corner d-flex justify-content-center align-items-center">
                        </div>
                    </div>
                    <x-custom-error field="image" />
                </div>

                <div class="form-group">
                    <button type="submit" id="btn-submit" class="btn btn-success">Submit</button>
                </div>

            </div>
    </form>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/highlight.min.js" integrity="sha512-z+/WWfyD5tccCukM4VvONpEtLmbAm5LDu7eKiyMQJ9m7OfPEDL7gENyDRL3Yfe8XAuGsS2fS4xSMnl6d30kqGQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/libs/quill/dist/quill.min.js')}}"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script type="text/javascript" src="{{asset('js/articles/add.js')}}"></script>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/styles/monokai-sublime.min.css" integrity="sha512-ade8vHOXH67Cm9z/U2vBpckPD1Enhdxl3N05ChXyFx5xikfqggrK4RrEele+VWY/iaZyfk7Bhk6CyZvlh7+5JQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
