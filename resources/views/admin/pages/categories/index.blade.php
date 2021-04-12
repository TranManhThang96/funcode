@extends('admin.layout.default')

@section('title', 'Categories')

@section('breadcrumb')
    {{renderBreadcrumb('Dashboard', [['name' => 'Home', 'link' => 'https://google.com.vn']])}}
@endsection
