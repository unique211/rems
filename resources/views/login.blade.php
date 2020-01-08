
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Login Boxed - ArchitectUI HTML Bootstrap 4 Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
    />
    <meta name="description" content="ArchitectUI HTML Bootstrap 4 Dashboard Template">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
{{--
<link href="./main.87c0748b313a1dda75f5.css" rel="stylesheet"> --}}
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/resources/sass/css/main.css') }}" />
</head>

<body>
<div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="h-100 bg-plum-plate bg-animation">
                <div class="d-flex h-100 justify-content-center align-items-center">
                    <div class="mx-auto app-login-box col-md-8">
                        <div class="app-logo-inverse mx-auto mb-3"></div>
                        <div class="modal-dialog w-100 mx-auto">
                                <form id="login_form" name="login_form">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="h5 modal-title text-center">
                                        <h4 class="mt-2">
                                            <div>Welcome back,</div>
                                            <span>Please sign in to your account below.</span>
                                        </h4>
                                    </div>

                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group"><input id="email" name="email" id="exampleEmail" placeholder="Email here..." type="email" class="form-control"></div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="position-relative form-group"><input id="password" name="password" id="examplePassword" placeholder="Password here..." type="password" class="form-control"></div>
                                            </div>
                                        </div>
                                        <div class="position-relative form-check"><input name="check" id="exampleCheck" type="checkbox" class="form-check-input"><label for="exampleCheck" class="form-check-label">Keep me logged in</label></div>

                                    <div class="divider"></div>
                                    <h6 class="mb-0">No account? <a href="javascript:void(0);" class="text-primary">Sign up now</a></h6>
                                </div>
                                <div class="modal-footer clearfix">
                                    <div class="float-left"><a href="javascript:void(0);" class="btn-lg btn btn-link">Recover Password</a></div>
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-primary btn-lg">Login to Dashboard</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                        <div class="text-center text-white opacity-8 mt-3">Copyright © ArchitectUI 2019</div>
                    </div>
                </div>
            </div>
        </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });


});
var login="{{ url('login_check') }}";
var redirect="{{ url('dashboard') }}";

</script>

<script type='text/javascript' src="{{ URL::asset('/resources/js/myjs/login.js') }}">
<script src="{{ URL::asset('resources/sass/scripts/main.js') }}"></script>
</body>
</html>
