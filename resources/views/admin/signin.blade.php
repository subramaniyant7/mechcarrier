<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Mechcareer - Admin </title>
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('uploads/LOGO.ico')}}" />
    <link href="{{ URL::asset(ADMINCSS . '/light/loader.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset(ADMINCSS . '/dark/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ URL::asset(ADMINJS . '/loader.js') }}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ URL::asset(ADMIN . '/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset(ADMINCSS . '/light/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset(ADMINCSS . '/dark/plugins.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset(ADMINCSS.'/light/authentication/auth-boxed.css')}}" rel="stylesheet" type="text/css" />
    <link href=".{{ URL::asset(ADMINCSS.'/dark/authentication/auth-boxed.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

</head>
<body class="form">

<!-- BEGIN LOADER -->
<div id="load_screen"> <div class="loader"> <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div></div></div>
<!--  END LOADER -->

<div class="auth-container d-flex">
    <div class="container mx-auto align-self-center">
        <div class="row">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                <div class="card mt-3 mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <h2>Log In</h2>
                                <p>Enter your email and password to login</p>
                            </div>
                            @include('admin.notification')
                            <form action="{{ url(ADMINURL.'/admin_authenticate')}}" method="post">
                                @csrf
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" required name="admin_email">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-4">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" required name="admin_password">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-secondary w-100">SIGN IN</button>
                                </div>
                            </div>

                            </form>
                            <div class="col-12 mb-4">
                                <div class="">
                                    <div class="seperator">
                                        <hr>
                                        <div class="seperator-text"> <span>Or continue with</span></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-2 col-12"></div>

                            <div class="col-sm-4 col-12">
                                <div class="mb-4">
                                    <a href="{{ url(ADMINURL.'/login/google') }}" class="btn  btn-social-login w-100 ">
                                        <img src="{{ URL::asset(ADMIN.'/assets/img/google-gmail.svg')}}" alt="" class="img-fluid">
                                        <span class="btn-text-inner">Google</span>
                                    </a>
                                </div>
                            </div>

                            <div class="col-sm-4 col-12">
                                <div class="mb-4">
                                    <a href="{{ url(ADMINURL.'/login/linkedin') }}" class="btn  btn-social-login w-100">
                                        <img src="{{ URL::asset(ADMIN.'/assets/img/linkedin.svg')}}" alt="" class="img-fluid">
                                        <span class="btn-text-inner">LinkedIn</span>
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ URL::asset(ADMIN.'/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->


</body>
</html>
