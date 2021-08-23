<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}"/>
    <title>@yield('title', 'Funcode')</title>
    <!-- Toast CSS -->
    <link href="{{asset('assets/libs/toastr/build/toastr.min.css')}}" rel="stylesheet"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/libs/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet"/>

    @yield('css')
    <!-- App CSS -->
    <link href="{{asset('assets/libs/prism/prism.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/web/app.css')}}" rel="stylesheet"/>
</head>

<body>
<div class="container-fluid px-0">

    @include('web.layout.base._header')

    <div id="content-container" class="my-5">
        <div class="row mx-0">
            <div id="aside-left-content" class="col-sm-12 col-md-2"></div>
            <div id="main-content" class="col-sm-12 col-md-8">
                @yield('content')
            </div>
            <div id="aside-right-content" class="col-sm-12 col-md-2"></div>
        </div>
    </div>

    @include('web.layout.base._footer')
</div>
<script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('assets/extra-libs/sparkline/sparkline.js')}}"></script>
<script src="{{asset('assets/libs/toastr/build/toastr.min.js')}}"></script>
<script src="{{asset('assets/libs/prism/prism.js')}}"></script>
<script src="{{asset('js/web/app.js')}}"></script>
@yield('script')
</body>
@toastr_render
</html>
