<!DOCTYPE html>
<html lang="en">
@include('admin.head')

<body class=" layout-boxed">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    @include('admin.navbar')

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container " id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('admin.sidebar')

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="middle-content container-xxl p-0">

                    @yield('content')

                </div>

            </div>
            @include('admin.footer')
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ URL::asset(ADMIN.'/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ URL::asset(ADMIN.'/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ URL::asset(ADMIN.'/plugins/src/mousetrap/mousetrap.min.js')}}"></script>
    <script src="{{ URL::asset(ADMINJS.'/app.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ URL::asset(ADMIN.'/plugins/src/apex/apexcharts.min.js')}}"></script>
    <script src="{{ URL::asset(ADMIN.'/assets/js/dashboard/dash_2.js')}}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

</body>

</html>

</html>
