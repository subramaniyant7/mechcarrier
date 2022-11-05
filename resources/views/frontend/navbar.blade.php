<header>
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li><a href="" target="_blank" class="active">Job Seekers</a></li>
                        <li><a href="" target="_blank">For Colleges TPO</a></li>
                        <li><a href="" target="_blank">For training institutes</a></li>
                        <li><a href="{{ route('employerlogin') }}">For employers</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-8  desktop-login-flex">
                    <a class="nav-link"
                        href="{{ session('frontend_useremail') ? route('userdashboard') : route('home') }}">
                        <div class="logo">
                            <h1>
                                <img src="{{ URL::asset(FRONTEND . '/assets/images/logo.svg') }}" />
                                Mech<span>Career</span>
                            </h1>
                        </div>
                    </a>
                    <div class="desktop-menu">
                        <nav class="navbar navbar-expand-lg">
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('jobsearch') }}">Job Search</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Free Course</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Career Consuling </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Resume Building </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="col-md-4 desktop-login-flex">
                    <div class="desktop-login">
                        <div class="notification-button">
                            @if (session('frontend_useremail'))
                                <img src="{{ URL::asset(FRONTEND . '/assets/images/home/notification.svg') }}" />
                                <div class="user-login">
                                    <a href="{{ route('userlogout') }}" style="padding-top:0.4em;"
                                        class="register-button">Logout</a>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            data-toggle="dropdown">Profile
                                            <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('userdashboard') }}">My Dashboard</a></li>
                                            <li><a href="#">Personal Details</a></li>
                                            <li><a href="#">My Courses</a></li>
                                            <li><a href="#">My Mail Box</a></li>
                                            <li><a href="#">Account Settings</a></li>
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <div class="user-login">
                                    <a href="{{ route('jobseekerregister') }}" class="register-button">Register</a>
                                    <a href="{{ route('jobseekerlogin') }}" class="login-button">Login</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
