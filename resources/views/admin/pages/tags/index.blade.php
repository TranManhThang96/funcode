@extends('admin.layout.default')

@section('title', __('admin_label.pages.tags.title'))

@section('breadcrumb')
    {{renderBreadcrumb(__('admin_label.pages.tags.title'), [['name' => __('admin_label.pages.home.title'), 'link' => '/']])}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <button type="button" class="btn btn-success" id="btn-add-tag">
                {{__('admin_label.pages.tags.index.btn_add')}}
            </button>
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
        <div class="col-md-6 col-lg-6">
            <form class="form-inline justify-content-end" id="frm-search">
                <div class="form-group mx-sm-3 mb-2">
                    <label for="query-input" class="sr-only">Query</label>
                    <input type="text" class="form-control" name="q"
                           placeholder="{{__('admin_label.common.label.placeholder_search')}}"/>
                </div>
                <input type="hidden" name="sort_by" value=""/>
                <input type="hidden" name="order_by" value=""/>
                <input type="hidden" name="per_page" value="{{\App\Enums\Constant::DEFAULT_PER_PAGE}}"/>
                <input type="hidden" name="page" value="1"/>
                <button class="btn btn-primary mb-2" id="btn-search">{{__('admin_label.common.button.search')}}</button>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" id="data-table">
                        @include('admin.pages.tags.list')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-add-tag" tabindex="-1" aria-labelledby="modal-add-tag"
         aria-hidden="true">
        @include('admin.pages.tags.add')
    </div>

    <div class="modal fade" id="modal-edit-tag" tabindex="-1" aria-labelledby="modal-edit-tag"
         aria-hidden="true">
    </div>

@endsection

@section('script')
    <script type="text/javascript" src="{{asset('js/tags/index.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/tags/add.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/tags/edit.js')}}"></script>
@endsection

