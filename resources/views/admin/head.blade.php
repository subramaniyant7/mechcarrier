<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Mechcareer Admin | Dashboard </title>
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('uploads/LOGO.ico')}}" />
    <link href="{{ URL::asset(ADMINCSS . '/light/loader.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset(ADMINCSS . '/dark/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ URL::asset(ADMINJS . '/loader.js') }}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ URL::asset(ADMIN . '/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset(ADMINCSS . '/light/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset(ADMINCSS . '/dark/plugins.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    @yield('head')
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>
