@extends('admin.layout.default')

@section('title', 'Categories')

@section('breadcrumb')
    {{renderBreadcrumb('Categories', [['name' => 'Home', 'link' => 'https://google.com.vn']])}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <button type="button" class="btn btn-success" id="btn-add-category">
                {{__('admin_label.categories.index.btn_add')}}
            </button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6 col-lg-6">
            <div class="d-flex align-items-center">
                <span>Show</span>
                <select class="custom-select mx-2 select-per-page" id="select-per-page">
                    <option selected value="{{\App\Enums\Constant::DEFAULT_PER_PAGE}}">{{\App\Enums\Constant::DEFAULT_PER_PAGE}}</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span>entries</span>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <form class="form-inline justify-content-end" id="frm-search">
                <div class="form-group mx-sm-3 mb-2">
                    <label for="query-input" class="sr-only">Query</label>
                    <input type="text" class="form-control" name="q" placeholder=""/>
                </div>
                <input type="hidden" name="sort_by" value=""/>
                <input type="hidden" name="order_by" value/>
                <input type="hidden" name="per_page" value="{{\App\Enums\Constant::DEFAULT_PER_PAGE}}"/>
                <input type="hidden" name="page" value="1"/>
                <button class="btn btn-primary mb-2" id="btn-search">Search</button>
            </form>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive" id="data-table">
                        @include('admin.pages.categories.list')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-add-category" tabindex="-1" aria-labelledby="modal-add-category"
         aria-hidden="true">
        @include('admin.pages.categories.add')
    </div>

    <div class="modal fade" id="modal-edit-category" tabindex="-1" aria-labelledby="modal-edit-category"
         aria-hidden="true">
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('js/categories/index.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/categories/add.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/categories/edit.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
@endsection

@section('css')
    <link href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}" rel="stylesheet"></link>
@endsection
