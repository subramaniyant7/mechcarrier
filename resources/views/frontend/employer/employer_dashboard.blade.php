@extends('frontend.employer.layout')
@section('title', 'Employer Dashboard')

@section('content')
    <main>
        <div class="profile-creation-top employee-dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="profile-contact">
                            <h1>{{ $employerInfo[0]->employer_company_name}}</h1>
                            <ul>
                                <li class="email"> <img
                                        src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/mail.svg') }}" />
                                        {{ $employerInfo[0]->employer_email}}
                                </li>
                                <li class="phone"> <img
                                        src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/phone.svg') }}" />
                                        {{ $employerInfo[0]->employer_mobile}}
                                </li>

                                <li class="location"><img
                                        src="{{ URL::asset(FRONTEND . '/assets/images/userdashboard.svg') }}" /> {{ $employerInfo[0]->employer_contact_person}}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="user-progress-bar">
                            <div class="user-progress">
                                <div class="circle-wrap">
                                    <div class="circle">
                                        <div class="mask full">
                                            <div class="fill"></div>
                                        </div>
                                        <div class="mask half">
                                            <div class="fill"></div>
                                        </div>
                                        <div class="inside-circle"> 12/200 </div>
                                    </div>
                                </div>
                                <p>Resume Search Quota</p>
                                <h6>Add Quota</h6>
                            </div>
                            <div class="user-progress">
                                <div class="circle-wrap">
                                    <div class="circle">
                                        <div class="mask full">
                                            <div class="fill"></div>
                                        </div>
                                        <div class="mask half">
                                            <div class="fill"></div>
                                        </div>
                                        <div class="inside-circle"> 1/5 </div>
                                    </div>
                                </div>
                                <p>Job Post Quota</p>
                                <h6>Add Quota</h6>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="employee-dashboard-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="emp-dash-card">
                            <div class="card-image">
                                <img src="{{ URL::asset(FRONTEND . '/assets/images/emdash1.svg') }}" />
                            </div>
                            <div class="card-title">
                                <p>Job post</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="emp-dash-card">
                            <div class="card-image">
                                <img src="{{ URL::asset(FRONTEND . '/assets/images/emdash2.svg') }}" />
                            </div>
                            <div class="card-title">
                                <p>Resume database</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="emp-dash-card">
                            <div class="card-image">
                                <img src="{{ URL::asset(FRONTEND . '/assets/images/emdash3.svg') }}" />
                            </div>
                            <div class="card-title">
                                <p>College database</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="emp-dash-card">
                            <div class="card-image">
                                <img src="{{ URL::asset(FRONTEND . '/assets/images/emdash4.svg') }}" />
                            </div>
                            <div class="card-title">
                                <p>Screening candidate </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop
