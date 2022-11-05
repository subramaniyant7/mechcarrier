<!DOCTYPE html>
<html lang="en">
@include('frontend.head')

<body>
    @include('frontend.loader')
    @include('frontend.employer.navbar')
    @yield('content')
    @include('frontend.footer')
</body>

</html>
