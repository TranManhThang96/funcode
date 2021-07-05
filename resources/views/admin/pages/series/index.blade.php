@extends('admin.layout.default')

@section('title', 'Series')

@section('breadcrumb')
    {{renderBreadcrumb('Series', [['name' => 'Home', 'link' => '/']])}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <button type="button" class="btn btn-success" id="btn-add-series">
                {{__('admin_label.series.index.btn_add')}}
            </button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6 col-lg-6">
            <div class="d-flex align-items-center">
                <span>Show</span>
                <select class="custom-select mx-2 select-per-page" id="select-per-page">
                    <option selected
                            value="{{\App\Enums\Constant::DEFAULT_PER_PAGE}}">{{\App\Enums\Constant::DEFAULT_PER_PAGE}}</option>
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

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" id="data-table">
                        @include('admin.pages.series.list')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-add-series" tabindex="-1" aria-labelledby="modal-add-series"
         aria-hidden="true">
        @include('admin.pages.series.add')
    </div>

    <div class="modal fade" id="modal-edit-series" tabindex="-1" aria-labelledby="modal-edit-series"
         aria-hidden="true">
    </div>

@endsection

@section('script')
    <script type="text/javascript" src="{{asset('js/series/index.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/series/add.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/series/edit.js')}}"></script>
@endsection
