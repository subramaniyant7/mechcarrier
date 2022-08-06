<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">
                <div class="nav-item theme-logo">
                    <a href="{{ url('/dashboard') }}">
                         <img src="{{ URL::asset('uploads/LOGO.png')}}" class="navbar-logo1" alt="logo">
                    </a>
                </div>
                <div class="nav-item theme-text">
                    <a href="{{ url(ADMINURL.'/analysisdashboard') }}" class="nav-link"> {{SITENAME}} </a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-chevrons-left">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu active">
                <a href="#dashboard" data-bs-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>Dashboard</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled show" id="dashboard"
                    data-bs-parent="#accordionExample">
                    <li class="{{request()->segment(2) == 'analysisdashboard' ? 'active' : ''}}">
                        <a href="{{ url(ADMINURL.'/analysisdashboard') }}"> Analytics </a>
                    </li>
                    <li class="{{request()->segment(2) == 'salesdashboard' ? 'active' : ''}}" element="{{request()->segment(1)}}">
                        <a href="{{ url(ADMINURL.'/salesdashboard') }}"> Sales </a>
                    </li>
                </ul>
            </li>

            <li class="menu">
                <a href="{{ route('socialmedia') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                        <span>Social Media </span>
                    </div>
                </a>
            </li>

{{--            <li class="menu">--}}
{{--                <a href="#" aria-expanded="false" class="dropdown-toggle">--}}
{{--                    <div class="">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"--}}
{{--                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"--}}
{{--                            stroke-linecap="round" stroke-linejoin="round"--}}
{{--                            class="feather feather-message-square">--}}
{{--                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>--}}
{{--                        </svg>--}}
{{--                        <span>Chat</span>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="menu">--}}
{{--                <a href=".#" aria-expanded="false" class="dropdown-toggle">--}}
{{--                    <div class="">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"--}}
{{--                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"--}}
{{--                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">--}}
{{--                            <path--}}
{{--                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">--}}
{{--                            </path>--}}
{{--                            <polyline points="22,6 12,13 2,6"></polyline>--}}
{{--                        </svg>--}}
{{--                        <span>Mailbox</span>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="menu">--}}
{{--                <a href="#" aria-expanded="false" class="dropdown-toggle">--}}
{{--                    <div class="">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"--}}
{{--                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"--}}
{{--                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">--}}
{{--                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>--}}
{{--                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>--}}
{{--                        </svg>--}}
{{--                        <span>Todo List</span>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="menu">--}}
{{--                <a href="#" aria-expanded="false" class="dropdown-toggle">--}}
{{--                    <div class="">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"--}}
{{--                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"--}}
{{--                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">--}}
{{--                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>--}}
{{--                            <polyline points="14 2 14 8 20 8"></polyline>--}}
{{--                            <line x1="16" y1="13" x2="8" y2="13"></line>--}}
{{--                            <line x1="16" y1="17" x2="8" y2="17"></line>--}}
{{--                            <polyline points="10 9 9 9 8 9"></polyline>--}}
{{--                        </svg>--}}
{{--                        <span>Notes</span>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="menu">--}}
{{--                <a href="#" aria-expanded="false" class="dropdown-toggle">--}}
{{--                    <div class="">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"--}}
{{--                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"--}}
{{--                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus">--}}
{{--                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>--}}
{{--                            <polyline points="14 2 14 8 20 8"></polyline>--}}
{{--                            <line x1="12" y1="18" x2="12" y2="12"></line>--}}
{{--                            <line x1="9" y1="15" x2="15" y2="15"></line>--}}
{{--                        </svg>--}}
{{--                        <span>Scrumboard</span>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="menu">--}}
{{--                <a href="#" aria-expanded="false" class="dropdown-toggle">--}}
{{--                    <div class="">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"--}}
{{--                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"--}}
{{--                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin">--}}
{{--                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>--}}
{{--                            <circle cx="12" cy="10" r="3"></circle>--}}
{{--                        </svg>--}}
{{--                        <span>Contacts</span>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
    </nav>
</div>
<!--  END SIDEBAR  -->
