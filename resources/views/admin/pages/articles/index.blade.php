@extends('admin.layout.default')

@section('title',  __('admin_label.pages.articles.title'))

@section('breadcrumb')
    {{renderBreadcrumb(__('admin_label.pages.articles.title'), [['name' => __('admin_label.pages.home.title'), 'link' => '/']])}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <a href="{{route('admin.articles.create')}}" class="btn btn-success">
                {{__('admin_label.pages.articles.index.btn_add')}}
            </a>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-6 col-lg-6">
            <div class="d-flex align-items-center">
                <span>{{__('admin_label.common.entries.show')}}</span>
                <select class="custom-select mx-2 select-per-page" id="select-per-page">
                    <option selected
                            value="{{\App\Enums\Constant::DEFAULT_PER_PAGE}}">{{\App\Enums\Constant::DEFAULT_PER_PAGE}}</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span>{{__('admin_label.common.entries.entries')}}</span>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <form class="form-inline justify-content-between" id="frm-search">
                <div class="form-group mb-2">
                    <label for="article-category">{{__('admin_label.pages.articles.table.status')}}</label>
                    <div class="ml-2 search-options">
                        <select class="custom-select custom-select-2 mr-sm-2" name="status">
                            <option value="">{{__('admin_label.common.table.please_select')}}</option>
                            <option
                                value="{{\App\Enums\DBConstant::ARTICLE_DRAFT}}" {{request()->status == \App\Enums\DBConstant::ARTICLE_DRAFT ? 'selected' : ''}}>{{\App\Enums\Constant::ARTICLE_DRAFT_LABEL}}</option>
                            <option
                                value="{{\App\Enums\DBConstant::ARTICLE_PUBLISH}}" {{request()->status == \App\Enums\DBConstant::ARTICLE_PUBLISH ? 'selected' : ''}}>{{\App\Enums\Constant::ARTICLE_PUBLISH_LABEL}}</option>
                            <option
                                value="{{\App\Enums\DBConstant::ARTICLE_DELETED}}" {{request()->status == \App\Enums\DBConstant::ARTICLE_DELETED ? 'selected' : ''}}>{{\App\Enums\Constant::ARTICLE_DELETED_LABEL}}</option>
                            <option
                                value="{{\App\Enums\DBConstant::ARTICLE_PENDING}}" {{request()->status == \App\Enums\DBConstant::ARTICLE_PENDING ? 'selected' : ''}}>{{\App\Enums\Constant::ARTICLE_PENDING_LABEL}}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label for="article-category">{{__('admin_label.pages.articles.table.type')}}</label>
                    <div class="ml-2 search-options">
                        <select class="custom-select custom-select-2 mr-sm-2" name="type">
                            <option value="">{{__('admin_label.common.table.please_select')}}</option>
                            <option
                                value="{{\App\Enums\DBConstant::LEARN}}" {{request()->status == \App\Enums\DBConstant::LEARN ? 'selected' : ''}}>{{\App\Enums\Constant::LEARN_LABEL}}</option>
                            <option
                                value="{{\App\Enums\DBConstant::ARTICLE}}" {{request()->status == \App\Enums\DBConstant::ARTICLE ? 'selected' : ''}}>{{\App\Enums\Constant::ARTICLE_LABEL}}</option>
                            <option
                                value="{{\App\Enums\DBConstant::TIP}}" {{request()->status == \App\Enums\DBConstant::TIP ? 'selected' : ''}}>{{\App\Enums\Constant::TIP_LABEL}}</option>
                            <option
                                value="{{\App\Enums\DBConstant::COPY}}" {{request()->status == \App\Enums\DBConstant::COPY ? 'selected' : ''}}>{{\App\Enums\Constant::COPY_LABEL}}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label for="article-category">{{__('admin_label.pages.articles.table.category')}}</label>
                    <div id="articles-categories-options" class="ml-2 search-options">
                        <select class="custom-select custom-select-2 mr-sm-2 select-category-option" name="category_id">
                            <option value="">{{__('admin_label.common.table.please_select')}}</option>
                            @if(isset($categories))
                                @foreach($categories as $category)
                                    <option
                                        value="{{$category['id']}}" {{request()->category_id == $category['id'] ? 'selected' : ''}}>{{$category['label']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label for="article-series">{{__('admin_label.pages.articles.table.series')}}</label>
                    <div id="articles-series-options" class="ml-2 search-options">
                        <select class="custom-select custom-select-2 mr-sm-2 select-series-option" name="series_id">
                            <option value="">{{__('admin_label.common.table.please_select')}}</option>
                            @if(isset($series))
                                @foreach($series as $seriesItem)
                                    <option
                                        value="{{$seriesItem['id']}}" {{request()->series_id == $seriesItem['id'] ? 'selected' : ''}}>{{$seriesItem['name']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label for="article-tags">{{__('admin_label.pages.articles.table.tag')}}</label>
                    <div class="ml-2 search-options">
                        <select class="custom-select custom-select-2 mr-sm-2 select-tags" name="tag_id">
                            <option value="">{{__('admin_label.common.table.please_select')}}</option>
                            @if(isset($tags))
                                @foreach($tags as $tag)
                                    <option
                                        value="{{$tag['id']}}" {{request()->tag_id == $tag['id'] ? 'selected' : ''}}>{{$tag['label']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label for="article-tags">{{__('admin_label.pages.articles.table.time')}}</label>
                    <div class="ml-2 search-options">
                        <input type="text" name="daterange" class="form-control"/>
                    </div>
                </div>

                <input type="hidden" name="sort_by" value=""/>
                <input type="hidden" name="order_by" value/>
                <input type="hidden" name="per_page" value="{{\App\Enums\Constant::DEFAULT_PER_PAGE}}"/>
                <input type="hidden" name="page" value="1"/>
                <div class="form-group ml-3 mb-2">
                    <input type="text" class="form-control" name="q" value="{{request()->q ?? ''}}"
                           placeholder="{{__('admin_label.common.label.placeholder_search')}}"/>
                </div>
                <button class="btn btn-primary mb-2" id="btn-search">{{__('admin_label.common.button.search')}}</button>
            </form>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" id="data-table">
                        @include('admin.pages.articles.list')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script type="text/javascript" src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="{{asset('js/articles/index.js')}}"></script>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <link href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}" rel="stylesheet"></link>
    <link type="text/css" href="{{asset('css/articles/index.css')}}" rel="stylesheet"/>
@endsection
