@extends('admin.layout.default')

@section('title', 'Categories')

@section('breadcrumb')
    {{renderBreadcrumb('Categories', [['name' => 'Home', 'link' => 'https://google.com.vn']])}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-add-category">
                {{__('admin_label.categories.index.btn_add')}}
            </button>
        </div>
        <div class="col-md-6 col-lg-6">
            <form class="form-inline justify-content-end">
                <div class="form-group mx-sm-3 mb-2">
                    <label for="query-input" class="sr-only">Query</label>
                    <input type="text" class="form-control" id="query-input" placeholder="">
                </div>
                <button class="btn btn-primary mb-2">Search</button>
            </form>
        </div>
    </div>
@endsection

@include('admin.pages.categories.add')

@section('script')
    <script type="text/javascript" src="{{asset('js/categories/add.js')}}" />
@endsection
