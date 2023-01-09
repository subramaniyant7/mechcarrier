<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="@yield('description')">
    <meta name="keywords"
        content="Jobs for mechanical, mechanical engineering fresher jobs, job portal for mechanical candidates" />

    <meta property="og:type" content="India’s 1st Job Portal For Mechanical Fresher & Professionals" />
    <meta property="og:site_name" content="MechCareer" />
    <meta property="og:url" content="https://mechcareer.com/" />
    <meta property="og:facebook" content="https://www.facebook.com/MechanicalCareer" />
    <meta property="og:youtube" content="https://www.youtube.com/channel/UCe4_582Qu0Z4G4YUAJh8ovw" />
    <meta property="og:twetter" content="https://twitter.com/MechCareer" />
    <meta property="og:instagram" content="https://www.instagram.com/mechcareer" />
    <meta property="og:linkedin" content="https://www.linkedin.com/company/mechcareer" />

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
