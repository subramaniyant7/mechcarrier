<!DOCTYPE html>
<html lang="en">
    @include('frontend.head')

    <body>
        @include('frontend.navbar')

        @yield('content')

        @include('frontend.footer')

    </body>

</html>
