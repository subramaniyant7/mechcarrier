@extends('frontend.layout')
@section('title','User Dashboard')
@section('content')
    <main>
        <div class="user-dashboard">
            <div class="user-dashboard-search">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="user-dasboard-form">
                                <div class="form-dflex">
                                    <form>
                                        <div class="d-flex">
                                            <input type="text" class="form-control" placeholder="Search job by skill, destination or companies" />
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                        <div class="d-flex">
                                            <input type="text" placeholder="Location" class="form-control" />
                                            <input type="text" placeholder="Experience" class="form-control" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="user-dashboard-main">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="beware">
                                <div class="icon">
                                    <img src="{{ URL::asset(FRONTEND.'/assets/images/attention.svg')}}" />
                                </div>
                                <div class="beware-text">
                                    <h3>Beware of fake calls and emails or scammers</h3>
                                    <p>Mechcareer.com not ask money for promising a jobs or interview. <br/>Dont share OTP, passward and more important details</p>
                                </div>
                                <div class="beware-button">
                                    <button type="button" class="btn btn-primary">Got it</button>
                                </div>
                            </div>
                            <div class="recomended-jobs">
                                <div class="job-title">
                                    <h2>45 New Recomended Jobs</h2>
                                </div>
                                <div class="job-card">
                                    <div class="job-card-title">
                                        <div class="d-flex">
                                            <h3>Lead Engineer / Senior Lead Engineer (Product Design)</h3>
                                            <p> Collins Aerospace technology</p>
                                        </div>
                                        <img src="{{ URL::asset(FRONTEND.'/assets/images/jobicon.svg')}}" />
                                    </div>
                                    <div class="job-card-details">
                                        <div class="job-card-info">
                                            <div class="years">
                                                <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg')}}" /> </span>5-10 Years</p>
                                            </div>
                                            <div class="location">
                                                <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg')}}" /> </span>Banglore</p>
                                            </div>
                                            <div class="salary">
                                                <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/rupeeicon.svg')}}" /> </span>5-6 Lakhs</p>
                                            </div>
                                        </div>
                                        <div class="job-posted-date">
                                            <h4>Posted : <span>Just now</span></h4>
                                        </div>
                                    </div>
                                    <div class="job-card-description">
                                        <p>CATIA, PLM , Change management, SAP , Avaition, Aerospace, CAD, Senior, Lead,  Continue. In this role the Lead Engineer / Senior Lead Engineer will actively participate in reviewing the Lead Engineer,  Senior Lead Engineer will actively participat...</p>
                                    </div>
                                    <div class="job-card-apply">
                                        <h4><img src="{{ URL::asset(FRONTEND.'/assets/images/filetexticon.svg')}}" /> Key skill : <span>SAP, PLM, CATIA</span></h4>
                                        <div class="job-card-button">
                                            <button type="button" class="btn btn-primary  bg-white">Save</button>
                                            <button type="button" class="btn btn-primary">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="recomended-jobs">
                                <div class="job-card">
                                    <div class="job-card-title">
                                        <div class="d-flex">
                                            <h3>Lead Engineer / Senior Lead Engineer (Product Design)</h3>
                                            <p> Collins Aerospace technology</p>
                                        </div>
                                        <img src="{{ URL::asset(FRONTEND.'/assets/images/jobicon.svg')}}" />
                                    </div>
                                    <div class="job-card-details">
                                        <div class="job-card-info">
                                            <div class="years">
                                                <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg')}}" /> </span>5-10 Years</p>
                                            </div>
                                            <div class="location">
                                                <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg')}}" /> </span>Banglore</p>
                                            </div>
                                            <div class="salary">
                                                <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/rupeeicon.svg')}}" /> </span>5-6 Lakhs</p>
                                            </div>
                                        </div>
                                        <div class="job-posted-date">
                                            <h4>Posted : <span>Just now</span></h4>
                                        </div>
                                    </div>
                                    <div class="job-card-description">
                                        <p>CATIA, PLM , Change management, SAP , Avaition, Aerospace, CAD, Senior, Lead,  Continue. In this role the Lead Engineer / Senior Lead Engineer will actively participate in reviewing the Lead Engineer,  Senior Lead Engineer will actively participat...</p>
                                    </div>
                                    <div class="job-card-apply">
                                        <h4><img src="{{ URL::asset(FRONTEND.'/assets/images/filetexticon.svg')}}" /> Key skill : <span>SAP, PLM, CATIA</span></h4>
                                        <div class="job-card-button">
                                            <button type="button" class="btn btn-primary  bg-white">Save</button>
                                            <button type="button" class="btn btn-primary">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="recomended-jobs">
                                <div class="job-card">
                                    <div class="job-card-title">
                                        <div class="d-flex">
                                            <h3>Lead Engineer / Senior Lead Engineer (Product Design)</h3>
                                            <p> Collins Aerospace technology</p>
                                        </div>
                                        <img src="{{ URL::asset(FRONTEND.'/assets/images/jobicon.svg')}}" />
                                    </div>
                                    <div class="job-card-details">
                                        <div class="job-card-info">
                                            <div class="years">
                                                <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg')}}" /> </span>5-10 Years</p>
                                            </div>
                                            <div class="location">
                                                <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg')}}" /> </span>Banglore</p>
                                            </div>
                                            <div class="salary">
                                                <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/rupeeicon.svg')}}" /> </span>5-6 Lakhs</p>
                                            </div>
                                        </div>
                                        <div class="job-posted-date">
                                            <h4>Posted : <span>Just now</span></h4>
                                        </div>
                                    </div>
                                    <div class="job-card-description">
                                        <p>CATIA, PLM , Change management, SAP , Avaition, Aerospace, CAD, Senior, Lead,  Continue. In this role the Lead Engineer / Senior Lead Engineer will actively participate in reviewing the Lead Engineer,  Senior Lead Engineer will actively participat...</p>
                                    </div>
                                    <div class="job-card-apply">
                                        <h4><img src="{{ URL::asset(FRONTEND.'/assets/images/filetexticon.svg')}}" /> Key skill : <span>SAP, PLM, CATIA</span></h4>
                                        <div class="job-card-button">
                                            <button type="button" class="btn btn-primary  bg-white">Save</button>
                                            <button type="button" class="btn btn-primary">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="recomended-jobs">
                                <div class="job-card">
                                    <div class="job-card-title">
                                        <div class="d-flex">
                                            <h3>Lead Engineer / Senior Lead Engineer (Product Design)</h3>
                                            <p> Collins Aerospace technology</p>
                                        </div>
                                        <img src="{{ URL::asset(FRONTEND.'/assets/images/jobicon.svg')}}" />
                                    </div>
                                    <div class="job-card-details">
                                        <div class="job-card-info">
                                            <div class="years">
                                                <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg')}}" /> </span>5-10 Years</p>
                                            </div>
                                            <div class="location">
                                                <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg')}}" /> </span>Banglore</p>
                                            </div>
                                            <div class="salary">
                                                <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/rupeeicon.svg')}}" /> </span>5-6 Lakhs</p>
                                            </div>
                                        </div>
                                        <div class="job-posted-date">
                                            <h4>Posted : <span>Just now</span></h4>
                                        </div>
                                    </div>
                                    <div class="job-card-description">
                                        <p>CATIA, PLM , Change management, SAP , Avaition, Aerospace, CAD, Senior, Lead,  Continue. In this role the Lead Engineer / Senior Lead Engineer will actively participate in reviewing the Lead Engineer,  Senior Lead Engineer will actively participat...</p>
                                    </div>
                                    <div class="job-card-apply">
                                        <h4><img src="{{ URL::asset(FRONTEND.'/assets/images/filetexticon.svg')}}" /> Key skill : <span>SAP, PLM, CATIA</span></h4>
                                        <div class="job-card-button">
                                            <button type="button" class="btn btn-primary  bg-white">Save</button>
                                            <button type="button" class="btn btn-primary">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="recomended-jobs">
                                <div class="job-card">
                                    <div class="job-card-title">
                                        <div class="d-flex">
                                            <h3>Lead Engineer / Senior Lead Engineer (Product Design)</h3>
                                            <p> Collins Aerospace technology</p>
                                        </div>
                                        <img src="{{ URL::asset(FRONTEND.'/assets/images/jobicon.svg')}}" />
                                    </div>
                                    <div class="job-card-details">
                                        <div class="job-card-info">
                                            <div class="years">
                                                <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg')}}" /> </span>5-10 Years</p>
                                            </div>
                                            <div class="location">
                                                <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg')}}" /> </span>Banglore</p>
                                            </div>
                                            <div class="salary">
                                                <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/rupeeicon.svg')}}" /> </span>5-6 Lakhs</p>
                                            </div>
                                        </div>
                                        <div class="job-posted-date">
                                            <h4>Posted : <span>Just now</span></h4>
                                        </div>
                                    </div>
                                    <div class="job-card-description">
                                        <p>CATIA, PLM , Change management, SAP , Avaition, Aerospace, CAD, Senior, Lead,  Continue. In this role the Lead Engineer / Senior Lead Engineer will actively participate in reviewing the Lead Engineer,  Senior Lead Engineer will actively participat...</p>
                                    </div>
                                    <div class="job-card-apply">
                                        <h4><img src="{{ URL::asset(FRONTEND.'/assets/images/filetexticon.svg')}}" /> Key skill : <span>SAP, PLM, CATIA</span></h4>
                                        <div class="job-card-button">
                                            <button type="button" class="btn btn-primary  bg-white">Save</button>
                                            <button type="button" class="btn btn-primary">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="explore-button">
                                <button type="submit" class="btn btn-primary">Explore More</button>
                            </div>
                            <div class="enhance-your-resume">
                                <div class="row">
                                    <div class="col-md-12 home-page">
                                        <div class="title">
                                            <h1>Enhance your Resume and Shortlisting</h1>
                                            <p>Take Course and Personal Assistance</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
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
                                    <div class="col-md-6">
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
                                </div>
                                <div class="row home-button">
                                    <div class="col-md-12">
                                        <button type="button" class="home-button"> Explore All </button>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-5">
                            <div class="user-dashboard-sidebar">
                                <div class="user-information">
                                    <div class="edit-profile">
                                        <a href="#" target="_blank"> <span><img src="{{ URL::asset(FRONTEND.'/assets/images/editprofileicon.svg')}}" /></span> Edit Profile</a>
                                    </div>
                                    <div class="personal-info">
                                        <div class="user-image">
                                            <img src="{{ URL::asset(FRONTEND.'/assets/images/usericonimage.svg')}}" />
                                        </div>
                                        <div class="user-info">
                                            <h3>{{ $userInfo[0]->user_firstname.' '. $userInfo[0]->user_lastname}}</h3>
                                            <h4>Senior product design engineer </h4>
                                            <h5>at ISOPARA engineering services ...</h5>
                                        </div>
                                    </div>
                                    <div class="user-expectations">
                                        <div class="exp-icon">
                                            <div class="exp-icon-details">
                                                <img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg')}}" />
                                                <p>Pune</p>
                                            </div>
                                            <div class="exp-icon-details">
                                                <img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg')}}" />
                                                <p>2.6 Years</p>
                                            </div>
                                            <div class="exp-icon-details">
                                                <img src="{{ URL::asset(FRONTEND.'/assets/images/rupeedashicon.svg')}}" />
                                                <p>5-6 Lakh</p>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <div class="inside-circle"> 30% </div>
                                                </div>
                                            </div>
                                            <p>Profile Completed</p>
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
                                                    <div class="inside-circle"> 30% </div>
                                                </div>
                                            </div>
                                            <p>Apply Limit</p>
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
                                                    <div class="inside-circle"> 30% </div>
                                                </div>
                                            </div>
                                            <p>Profile Performance</p>
                                        </div>
                                    </div>
                                    <div class="profile-activation">
                                        <label class="switch">
                                            <input type="checkbox" class="switch-input">
                                            <span class="switch-label" data-on="On" data-off="Off"></span>
                                            <span class="switch-handle"></span>
                                        </label>
                                        <h4>Profile Active (Visible)</h4>
                                    </div>
                                    <hr/>
                                    <div class="userdashboard-information">
                                        <ul>
                                            <li><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mailicon.svg')}}" /> </span> My mail box (2) - <a href="#">View</a></li>
                                            <li><span><img src="{{ URL::asset(FRONTEND.'/assets/images/tagicon.svg')}}" /> </span>Referal link  - <a href="#">Share</a></li>
                                            <li><span><img src="{{ URL::asset(FRONTEND.'/assets/images/monitoricon.svg')}}" /> </span> My courses & services - <a href="#">View</a></li>
                                            <li><span><img src="{{ URL::asset(FRONTEND.'/assets/images/bellicon.svg')}}" /> </span> Jobs notification alerts - <a href="#">Manage</a></li>
                                            <li><span><img src="{{ URL::asset(FRONTEND.'/assets/images/gifticon.svg')}}" /> </span> My referal earn points  - 2</li>
                                            <li><span><img src="{{ URL::asset(FRONTEND.'/assets/images/saveicon.svg')}}" /> </span> My saved jobs - <a href="#">View</a></li>
                                        </ul>
                                    </div>
                                    <hr/>
                                    <div class="user-data-selection">
                                        <form>
                                            <label>Current Working In</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Design - Automotive Plastic Product</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                            <label>Job Looking In</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Same Field</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </form>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="top-hiring-recruiter">
                                <h2>Top Hiring Recruiters </h2>
                                <div class="top-hiring-recruiter-icon">
                                    <img src="{{ URL::asset(FRONTEND.'/assets/images/tc1.svg')}}" />
                                    <img src="{{ URL::asset(FRONTEND.'/assets/images/tc2.svg')}}" />
                                </div>
                                <div class="top-hiring-recruiter-icon">
                                    <img src="{{ URL::asset(FRONTEND.'/assets/images/tc3.svg')}}" />
                                    <img src="{{ URL::asset(FRONTEND.'/assets/images/tc4.svg')}}" />
                                </div>
                                <div class="top-hiring-recruiter-icon">
                                    <img src="{{ URL::asset(FRONTEND.'/assets/images/tc5.svg')}}" />
                                    <img src="{{ URL::asset(FRONTEND.'/assets/images/tc6.svg')}}" />
                                </div>
                                <div class="top-hiring-recruiter-icon">
                                    <img src="{{ URL::asset(FRONTEND.'/assets/images/tc7.svg')}}" />
                                    <img src="{{ URL::asset(FRONTEND.'/assets/images/tc8.svg')}}" />
                                </div>
                            </div>
                            <div class="mech-advertisment">
                                <span>ad</span>
                                <h2>Makeover your skill <br/>
                                    using our online courses</h2>
                                <ul>
                                    <li>CAD Courses</li>
                                    <li>Product Design Courses</li>
                                    <li>Tool Design Courses</li>
                                    <li>Fixture Design Courses</li>
                                    <li>CAE Courses</li>
                                    <li>Engineering courses and more</li>
                                    <button class="btn btn-primary" type="button">Learn More</button>
                                    <a href="#" target="_blank">www.isopara.com</a>
                                </ul>
                            </div>
                            <div class="mech-advertisment">
                                <span>ad</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop
