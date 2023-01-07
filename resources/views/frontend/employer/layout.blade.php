<!DOCTYPE html>
<html lang="en">
@include('frontend.head')

<body>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-EX2R7FBW54"></script>
    <script> window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-EX2R7FBW54');
    </script>

    @include('frontend.loader')
    @include('frontend.employer.navbar')
    @yield('content')
    @include('frontend.footer')
</body>

</html>
