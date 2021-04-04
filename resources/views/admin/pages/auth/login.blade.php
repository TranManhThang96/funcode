@extends('admin.layout.blank')

@section('content')
    <div id="loginform">
        <div class="text-center p-t-20 p-b-20">
            <span class="db"><img src="{{asset('assets/images/logo.png')}}" alt="logo"/></span>
        </div>
        <!-- Form -->
        <form class="form-horizontal m-t-20" id="loginform" method="post">
            @csrf
            <div class="row p-b-30">
                <div class="col-12">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-success text-white" id="basic-addon1"><i
                                    class="ti-user"></i></span>
                        </div>
                        <input type="text" class="form-control form-control-lg" placeholder="Username"
                               aria-label="Username" aria-describedby="basic-addon1" required="" name="email">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-warning text-white" id="basic-addon2"><i
                                    class="ti-pencil"></i></span>
                        </div>
                        <input type="text" class="form-control form-control-lg" placeholder="Password"
                               aria-label="Password" aria-describedby="basic-addon1" required="" name="password">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input mt-1" type="checkbox" value="1" id="remember-me">
                        <label class="form-check-label ml-1 text-light" for="remember-me">
                            Remember me
                        </label>
                    </div>
                </div>
            </div>
            <div class="row border-top border-secondary">
                <div class="col-12">
                    <div class="form-group">
                        <div class="p-t-20">
                            <button class="btn btn-info" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i>
                                Lost password?
                            </button>
                            <button class="btn btn-success float-right" type="submit">Login</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="recoverform">
        <div class="text-center">
            <span class="text-white">Enter your e-mail address below and we will send you instructions how to recover a password.</span>
        </div>
        <div class="row m-t-20">
            <!-- Form -->
            <form class="col-12" action="index.html">
                <!-- email -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-danger text-white" id="basic-addon1"><i
                                class="ti-email"></i></span>
                    </div>
                    <input type="text" class="form-control form-control-lg" placeholder="Email Address"
                           aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <!-- pwd -->
                <div class="row m-t-20 p-t-20 border-top border-secondary">
                    <div class="col-12">
                        <a class="btn btn-success" href="#" id="to-login" name="action">Back To Login</a>
                        <button class="btn btn-info float-right" type="button" name="action">Recover</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        // ==============================================================
        // Login and Recover Password
        // ==============================================================
        $('#to-recover').on("click", function () {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        $('#to-login').click(function () {

            $("#recoverform").hide();
            $("#loginform").fadeIn();
        });
    </script>

@endsection


