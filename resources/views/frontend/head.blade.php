<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ SITENAME }} - @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ URL::asset(FRONTEND . '/assets/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ URL::asset(FRONTEND . '/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset(FRONTEND . '/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ URL::asset(FRONTEND . '/assets/css/owl.carousel.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />

    <script>
        let siteurl = "{{ FRONTENDURL }}";
    </script>
</head>
