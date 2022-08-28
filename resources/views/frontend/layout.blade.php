<!DOCTYPE html>
<html lang="en">
@include('frontend.head')

<body>
    @include('frontend.navbar')
    <div class="loader">
        <div class="lds-dual-ring"> </div>
    </div
    @yield('content') @include('frontend.footer') </body>

</html>
