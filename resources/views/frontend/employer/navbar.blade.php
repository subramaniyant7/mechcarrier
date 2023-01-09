<header>
    @if (!session('employer_id'))
        <div class="top-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            <li><a href="{{ route('jobseekerlogin') }}">Job Seekers</a></li>
                            <li><a href="" target="_blank">For Colleges TPO</a></li>
                            <li><a href="" target="_blank">For training institutes</a></li>
                            <li><a href="{{ route('employerhome') }}" class="active">For Employers</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-8  desktop-login-flex">
                    <a class="nav-link"
                        href="{{ session('employer_id') ? route('employerdashboard') : route('home') }}">
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
                                        <a class="nav-link" href="{{ route('employerjobpost') }}">Free Job Post</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('employersearchresume') }}">Free Resume
                                            Datebase</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Ready Screening Candidate </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="col-md-4 desktop-login-flex">
                    <div class="desktop-login">
                        <div class="notification-button">
                            @if (session('employer_id'))
                                <div class="user-login">
                                    <a href="{{ route('employerdashboard') }}" class="register-button">Dashboard</a>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            data-toggle="dropdown">Profile
                                            <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('employercompany') }}">Personal Details</a></li>
                                            <li><a href="{{ route('employerlogout') }}">Logout</a></li>
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <div class="user-login">
                                    <a href="{{ route('employerregister') }}" class="register-button">Register</a>
                                    <a href="{{ route('employerlogin') }}" class="login-button">Login</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
