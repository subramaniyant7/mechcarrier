@extends('frontend.employer.layout')
@section('title', 'Employer - Home')
@section('content')

    <main>
        <div class="mech-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1> India’s 1st <span> Mechanical </span> Recruitment Solution </h1>
                        <div class="banner-links">
                            <ul>
                                <li>Design</li>
                                <li>Quality</li>
                                <li>Production</li>
                                <li>R & D</li>
                                <li>Maintenance</li>
                                <li>CAE</li>
                                <li>Service</li>
                                <li>Sales</li>
                                <li>Purchase</li>
                                <li>Marketing</li>
                                <li>Applications</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="why-mech-career">
            <div class="why-mech-career-title">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1> Why Mech<span>Career</span></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="why-mech-career-main">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="why-mech-card">
                                <img src="{{ URL::asset(FRONTEND . '/assets/images/whymech1.svg') }}" />
                                <p>Free 1 Job post / Month</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-mech-card">
                                <img src="{{ URL::asset(FRONTEND . '/assets/images/whymech2.svg') }}" />
                                <p>Free 50 Resume database / Month</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-mech-card">
                                <img src="{{ URL::asset(FRONTEND . '/assets/images/whymech3.svg') }}" />
                                <p>Ready screening candidate </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="why-mech-card">
                                <img src="{{ URL::asset(FRONTEND . '/assets/images/whymech4.svg') }}" />
                                <p>Graphical representation</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-mech-card">
                                <img src="{{ URL::asset(FRONTEND . '/assets/images/whymech5.svg') }}" />
                                <p>College student database</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-mech-card">
                                <img src="{{ URL::asset(FRONTEND . '/assets/images/whymech6.svg') }}" />
                                <p>Quality candidate and high exp.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>

@stop
