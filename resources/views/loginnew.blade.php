
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Login - ArchitectUI HTML Bootstrap 4 Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
    />
    <meta name="description" content="ArchitectUI HTML Bootstrap 4 Dashboard Template">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/resources/sass/css/login.css') }}" />
{{--  tost msg  --}}
<link href="{{ URL::asset('/resources/sass/toastr/toastr.min.css') }}" rel="stylesheet">
<body>

    <div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="h-100">
                <div class="h-100 no-gutters row">
                    <div class="d-none d-lg-block col-lg-4">
                        <div class="slider-light">
                            <div class="slick-slider slick-initialized slick-dotted"><button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="">Previous</button><div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 3171px; transform: translate3d(-906px, 0px, 0px);"><div class="slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true" tabindex="-1" style="width: 453px;"><div><div style="width: 100%; display: inline-block;">
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-sunny-morning" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('resources/sass/images/avatars/citydark.jpg');"></div>
                                        <div class="slider-content"><h3>Complex, but lightweight</h3>
                                            <p>We've included a lot of components that cover almost all use cases for any type of application.</p></div>
                                    </div>
                                </div></div></div><div class="slick-slide" data-slick-index="0" aria-hidden="true" role="tabpanel" id="slick-slide00" tabindex="-1" aria-describedby="slick-slide-control00" style="width: 453px;"><div><div style="width: 100%; display: inline-block;">
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('resources/sass/images/avatars/city.jpg');"></div>
                                        <div class="slider-content"><h3>Perfect Balance</h3>
                                            <p>ArchitectUI is like a dream. Some think it's too good to be true! Extensive collection of unified React Boostrap Components and Elements.</p></div>
                                    </div>
                                </div></div></div><div class="slick-slide slick-current slick-active" data-slick-index="1" aria-hidden="false" role="tabpanel" id="slick-slide01" aria-describedby="slick-slide-control01" style="width: 453px;"><div><div style="width: 100%; display: inline-block;">
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('resources/sass/images/avatars/citynights.jpg');"></div>
                                        <div class="slider-content"><h3>Scalable, Modular, Consistent</h3>
                                            <p>Easily exclude the components you don't require. Lightweight, consistent Bootstrap based styles across all elements and components</p></div>
                                    </div>
                                </div></div></div><div class="slick-slide" data-slick-index="2" aria-hidden="true" tabindex="-1" role="tabpanel" id="slick-slide02" aria-describedby="slick-slide-control02" style="width: 453px;"><div><div style="width: 100%; display: inline-block;">
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-sunny-morning" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('resources/sass/images/avatars/citydark.jpg');"></div>
                                        <div class="slider-content"><h3>Complex, but lightweight</h3>
                                            <p>We've included a lot of components that cover almost all use cases for any type of application.</p></div>
                                    </div>
                                </div></div></div><div class="slick-slide slick-cloned" data-slick-index="3" aria-hidden="true" tabindex="-1" style="width: 453px;"><div><div style="width: 100%; display: inline-block;">
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('resources/sass/images/avatars/city.jpg');"></div>
                                        <div class="slider-content"><h3>Perfect Balance</h3>
                                            <p>ArchitectUI is like a dream. Some think it's too good to be true! Extensive collection of unified React Boostrap Components and Elements.</p></div>
                                    </div>
                                </div></div></div><div class="slick-slide slick-cloned" data-slick-index="4" aria-hidden="true" tabindex="-1" style="width: 453px;"><div><div style="width: 100%; display: inline-block;">
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('resources/sass/images/avatars/citynights.jpg');"></div>
                                        <div class="slider-content"><h3>Scalable, Modular, Consistent</h3>
                                            <p>Easily exclude the components you don't require. Lightweight, consistent Bootstrap based styles across all elements and components</p></div>
                                    </div>
                                </div></div></div><div class="slick-slide slick-cloned" data-slick-index="5" aria-hidden="true" tabindex="-1" style="width: 453px;"><div><div style="width: 100%; display: inline-block;">
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-sunny-morning" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('resources/sass/images/avatars/citydark.jpg');"></div>
                                        <div class="slider-content"><h3>Complex, but lightweight</h3>
                                            <p>We've included a lot of components that cover almost all use cases for any type of application.</p></div>
                                    </div>
                                </div></div></div></div></div><button class="slick-next slick-arrow" aria-label="Next" type="button" style="">Next</button><ul class="slick-dots" style="" role="tablist"><li class="" role="presentation"><button type="button" role="tab" id="slick-slide-control00" aria-controls="slick-slide00" aria-label="1 of 3" tabindex="-1">1</button></li><li role="presentation" class="slick-active"><button type="button" role="tab" id="slick-slide-control01" aria-controls="slick-slide01" aria-label="2 of 3" tabindex="0" aria-selected="true">2</button></li><li role="presentation"><button type="button" role="tab" id="slick-slide-control02" aria-controls="slick-slide02" aria-label="3 of 3" tabindex="-1">3</button></li></ul></div>
                        </div>
                    </div>
                    <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">
                        <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                            <div class="app-logo"></div>
                            <h4 class="mb-0">
                                <span class="d-block"></span>
                                <span></span></h4>
                            <h6 class="mt-3"><a href="javascript:void(0);" class="text-primary"></a></h6>
                            <div class="divider row"></div>
                            <div>
                                <form class="" id="login_form" name="login_form" >
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group"><label for="exampleEmail" class="">User Name</label><input id="username" name="username" id="exampleEmail" placeholder="User Name here.." type="text" class="form-control"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative form-group"><label for="examplePassword" class="">Password</label><input name="password" id="examplePassword" placeholder="Password here..." type="password" class="form-control"></div>
                                        </div>
                                    </div>
                                    <div class="position-relative form-check"><input name="check" id="exampleCheck" type="checkbox" class="form-check-input"><label for="exampleCheck" class="form-check-label"></label></div>
                                    <div class="divider row"></div>
                                    <div class="d-flex align-items-center">
                                         <div class="ml-auto">
                                          {{--  <a href="javascript:void(0);" class="btn-lg btn btn-link">Recover Password</a> --}}
                                            <button type="submit" class="btn btn-primary btn-lg">Login to Dashboard</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

{{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> --}}
{{-- //-- Jquery -- --}}
<script type='text/javascript' src="{{ URL::asset('/resources/js/jquery-1.10.2.min.js') }}">
</script>
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
{{-- <script type='text/javascript' src="https://demo.dashboardpack.com/architectui-html-pro/assets/scripts/main.87c0748b313a1dda75f5.js"></script> --}}
{{-- <script type='text/javascript' src="{{ URL::asset('/resources/sass/loginmain.js') }}"></script> --}}
<script type='text/javascript' src="{{ URL::asset('/resources/js/myjs/login.js') }}"></script>

</body>
 <!-- tost msg -->
<script type='text/javascript' src="{{ URL::asset('/resources/sass/toastr/toastr.min.js')}}"></script>

<script type='text/javascript' src="{{ URL::asset('/resources/sass/toastr/tost.js')}}"></script>
<script src="{{ URL::asset('resources/sass/scripts/main.js') }}"></script>
</html>
