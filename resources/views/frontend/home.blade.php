@extends('frontend.layout')
@section('title', 'Home')
@section('content')
    <main>
        <div class="mech-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>
                            India’s 1st Job Portal For <br/> Mechanical Fresher <br/> & Professionals
                        </h1>
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


        <!--section-0-->

        <div class="mech-search">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 home-page">
                        <div class="title">
                            <h1>Find Your Dream Job Now</h1>
                            <h3>5000+ Jobs For You To Explore</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="search-form">
                            <form>
                                <div class="form-outline">
                                    <div class="d-flex">
                                        <span><img src="{{ URL::asset(FRONTEND.'/assets/images/home/searchicon.svg')}}" /></span>
                                        <input  type="text" id="form1Example1" placeholder="Enter skills/ designation/ companies" class="form-control form-skills" />
                                        <span class="map-icon">
                                            <img src="{{ URL::asset(FRONTEND.'/assets/images/home/mapicon.svg')}}" /></span>
                                        <span class="line-border"></span>
                                        <input type="text" id="form1Example1" placeholder="Enter Location" class="form-control" />
                                        <button type="submit" class="btn-prrimary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--secrion1-->

        <div class="why-switch-career">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title">
                            <h1>Why to switch in Mechcareer</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="why-card">
                            <img src="{{ URL::asset(FRONTEND.'/assets/images/home/why1.svg')}}" />
                            <div class="item-title">
                                <p>specialy for mechanical</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="why-card">
                            <img src="{{ URL::asset(FRONTEND.'/assets/images/home/why2.svg')}}" />
                            <div class="item-title">
                                <p>5000+ employers</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="why-card">
                            <img src="{{ URL::asset(FRONTEND.'/assets/images/home/why3.svg')}}" />
                            <div class="item-title">
                                <p>skill upgrade courses</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="why-card">
                            <img src="{{ URL::asset(FRONTEND.'/assets/images/home/why4.svg')}}" />
                            <div class="item-title">
                                <p>performance tracking</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--- Section2 -->

        <div class="featured-companies">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title">
                            <h1>Featured Companies Actively Hiring</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="feature-card">
                            <div class="featured-image">
                                <img src="{{ URL::asset(FRONTEND.'/assets/images/home/fc1.svg')}}" />
                            </div>
                            <div class="featured-title">
                                <h4>8 Jobs Available</h4>
                                <a href="#" target="_blank">View Jobs <span><img
                                            src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg')}}" /></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="feature-card">
                            <div class="featured-image">
                                <img src="{{ URL::asset(FRONTEND.'/assets/images/home/fc2.svg')}}" />
                            </div>
                            <div class="featured-title">
                                <h4>12 Jobs Available</h4>
                                <a href="#" target="_blank">View Jobs <span><img
                                            src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg')}}" /></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="feature-card">
                            <div class="featured-image">
                                <img src="{{ URL::asset(FRONTEND.'/assets/images/home/fc3.svg')}}" />
                            </div>
                            <div class="featured-title">
                                <h4>4 Jobs Available</h4>
                                <a href="#" target="_blank">View Jobs <span><img
                                            src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg')}}" /></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="feature-card">
                            <div class="featured-image">
                                <img src="{{ URL::asset(FRONTEND.'/assets/images/home/fc4.svg')}}" />
                            </div>
                            <div class="featured-title">
                                <h4>24 Jobs Available</h4>
                                <a href="#" target="_blank">View Jobs <span><img
                                            src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg')}}" /></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="feature-card">
                            <div class="featured-image">
                                <img src="{{ URL::asset(FRONTEND.'/assets/images/home/fc5.svg')}}" />
                            </div>
                            <div class="featured-title">
                                <h4>8 Jobs Available</h4>
                                <a href="#" target="_blank">View Jobs <span><img
                                            src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg')}}" /></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="feature-card">
                            <div class="featured-image">
                                <img src="{{ URL::asset(FRONTEND.'/assets/images/home/fc6.svg')}}" />
                            </div>
                            <div class="featured-title">
                                <h4>12 Jobs Available</h4>
                                <a href="#" target="_blank">View Jobs <span><img
                                            src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg')}}" /></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="feature-card">
                            <div class="featured-image">
                                <img src="{{ URL::asset(FRONTEND.'/assets/images/home/fc7.svg')}}" />
                            </div>
                            <div class="featured-title">
                                <h4>4 Jobs Available</h4>
                                <a href="#" target="_blank">View Jobs <span><img
                                            src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg')}}" /></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="feature-card">
                            <div class="featured-image">
                                <img src="{{ URL::asset(FRONTEND.'/assets/images/home/fc8.svg')}}" />
                            </div>
                            <div class="featured-title">
                                <h4>24 Jobs Available</h4>
                                <a href="#" target="_blank">View Jobs <span><img
                                            src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg')}}" /></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row home-button">
                    <div class="col-md-12">
                        <button type="button" class="home-button"> View all companies </button>
                    </div>
                </div>
            </div>
        </div>

        <!--section3-->

        <div class="enhance-your-resume">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 home-page">
                        <div class="title">
                            <h1>Enhance your Resume and Shortlisting</h1>
                            <p>Take Course and Personal Assistance</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="enhance-your-resume-card">
                            <div class="enhance-your-resume-image">
                                <img src="{{ URL::asset(FRONTEND.'/assets/images/home/er1.svg')}}" />
                            </div>
                            <div class="enhance-your-resume-card-title">
                                <h4>Resume Building</h4>
                                <p>Grab the attention of employers by building best grab the attention ...</p>
                                <a href="#" target="_blank">Read More<span><img
                                            src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg')}}" /></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="enhance-your-resume-card">
                            <div class="enhance-your-resume-image">
                                <img src="{{ URL::asset(FRONTEND.'/assets/images/home/er2.svg')}}" />
                            </div>
                            <div class="enhance-your-resume-card-title">
                                <h4>Career Booster</h4>
                                <p>Grab the attention of employers by building best grab the attention ...</p>
                                <a href="#" target="_blank">Read More<span><img
                                            src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg')}}" /></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="enhance-your-resume-card">
                            <div class="enhance-your-resume-image">
                                <img src="{{ URL::asset(FRONTEND.'/assets/images/home/er1.svg')}}" />
                            </div>
                            <div class="enhance-your-resume-card-title">
                                <h4>Resume Building</h4>
                                <p>Grab the attention of employers by building best grab the attention ...</p>
                                <a href="#" target="_blank">Read More<span><img
                                            src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg')}}" /></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="enhance-your-resume-card">
                            <div class="enhance-your-resume-image">
                                <img src="{{ URL::asset(FRONTEND.'/assets/images/home/er2.svg')}}" />
                            </div>
                            <div class="enhance-your-resume-card-title">
                                <h4>Personal guide</h4>
                                <p>Grab the attention of employers by building best grab the attention ...</p>
                                <a href="#" target="_blank">Read More<span><img
                                            src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg')}}" /></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row home-button">
                    <div class="col-md-12">
                        <button type="button" class="home-button"> Explore All </button>
                    </div>
                </div>
            </div>

        </div>

        <!--section4-->

        <div class="enhance-your-resume training-partner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 home-page">
                        <div class="title">
                            <h1>Upskill yourself with our Training Partner</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="enhance-your-resume-card">
                            <div class="enhance-your-resume-image">
                                <img src="{{ URL::asset(FRONTEND.'/assets/images/home/ty1.svg')}}" />
                            </div>
                            <div class="enhance-your-resume-card-title">
                                <h4>CAD Courses</h4>
                                <p>Grab the attention of employers by building best grab the attention ...</p>
                                <a href="#" target="_blank">Read More<span><img
                                            src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg')}}" /></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="enhance-your-resume-card">
                            <div class="enhance-your-resume-image">
                                <img src="{{ URL::asset(FRONTEND.'/assets/images/home/ty2.svg')}}" />
                            </div>
                            <div class="enhance-your-resume-card-title">
                                <h4>Product Design Courses</h4>
                                <p>Grab the attention of employers by building best grab the attention ...</p>
                                <a href="#" target="_blank">Read More<span><img
                                            src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg')}}" /></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="enhance-your-resume-card">
                            <div class="enhance-your-resume-image">
                                <img src="{{ URL::asset(FRONTEND.'/assets/images/home/ty3.svg')}}" />
                            </div>
                            <div class="enhance-your-resume-card-title">
                                <h4>Tool Design Courses</h4>
                                <p>Grab the attention of employers by building best grab the attention ...</p>
                                <a href="#" target="_blank">Read More<span><img
                                            src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg')}}" /></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="enhance-your-resume-card">
                            <div class="enhance-your-resume-image">
                                <img src="{{ URL::asset(FRONTEND.'/assets/images/home/ty4.svg')}}" />
                            </div>
                            <div class="enhance-your-resume-card-title">
                                <h4>Fixture Design Courses</h4>
                                <p>Grab the attention of employers by building best grab the attention ...</p>
                                <a href="#" target="_blank">Read More<span><img
                                            src="{{ URL::asset(FRONTEND.'/assets/images/home/arrowsvgicon.svg')}}" /></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row home-button">
                    <div class="col-md-12">
                        <button type="button" class="home-button"> Explore All </button>
                    </div>
                </div>
            </div>

        </div>

    </main>
@stop
