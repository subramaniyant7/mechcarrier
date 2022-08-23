@extends('frontend.layout')


@section('content')

<main>
    <div class="user-dashboard-detail">
        <div class="user-dashboard-detail-bggray"></div>
        <div class="user-dashboard-detail-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="recomended-jobs">
                            <div class="job-card">
                                <div class="job-card-title">
                                    <div class="d-flex">
                                        <h3>Lead Engineer / Senior Lead Engineer (Product Design)</h3>
                                        <p> Collins Aerospace technology</p>
                                    </div>
                                    <img src="{{ URL::asset(FRONTEND.'/assets/images/jobicon.svg') }}">
                                </div>
                                <div class="job-card-details">
                                    <div class="job-card-info">
                                        <div class="years">
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg') }}"> </span>5-10 Years
                                            </p>
                                        </div>
                                        <div class="location">
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg') }}"> </span>Banglore</p>
                                        </div>
                                        <div class="salary">
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/rupeeicon.svg') }}"> </span>5-6 Lakhs</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="job-card-apply">
                                    <div class="job-posted-date">
                                        <h4>Posted : <span>Just now</span></h4>
                                        <h4>Job Applicants : <span>164</span></h4>
                                    </div>
                                    <div class="job-card-button">
                                        <button type="button" class="btn btn-primary  bg-white">Save</button>
                                        <button type="button" class="btn btn-primary">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="job-match-score">
                            <h4>Your Job Match Score</h4>
                            <div class="job-match-score-dflex">
                                <ul>
                                    <li><span> <img src="{{ URL::asset(FRONTEND.'/assets/images/tickicon.svg') }}" /> </span> Keyskills</li>
                                    <li><span> <img src="{{ URL::asset(FRONTEND.'/assets/images/tickicon.svg') }}" /> </span> Location</li>
                                    <li><span> <img src="{{ URL::asset(FRONTEND.'/assets/images/tickicon1.svg') }}" /> </span> Work experience
                                    </li>
                                    <li><span> <img src="{{ URL::asset(FRONTEND.'/assets/images/tickicon1.svg') }}" /> </span> Salary</li>
                                </ul>
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
                                        <a href="#" target="_blank">How to improve </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="job-description">
                            <h3>Job description</h3>
                            <ul>
                                <li>Minimum 2 years experience in Wiring Harness</li>
                                <li>Should be expertise in Catia/UGNX.</li>
                                <li>Sound knowledge in using Teamcenter.</li>
                                <li>Should have Sound knowledge in Wiring Manufacturing.</li>
                                <li>Proficient in CAD software preferred UG NX</li>
                                <li>Seat complete study using kinematics/Motion file to be performing packaging
                                    studies.</li>
                                <li>Perform regulatory (AIS, ECE, FMVSS) related to Plastic components.</li>
                                <li>Creation of engineering Plastic component drawings</li>
                                <li>Understand customer requirements</li>
                            </ul>

                            <ul class="qualification">
                                <li><span>Role</span> Design Engineer</li>
                                <li><span>Industry Type </span> Automobile</li>
                                <li><span>Functional Area</span> Research & Development</li>
                                <li><span>Employment Type</span> Full Time, Permanent</li>
                                <li><span>Role Category</span> Engineering & Manufacturing</li>
                                <li class="education">
                                    <span>Education</span> B.Tech/B.E. in Automobile, Mechanical
                                </li>
                            </ul>
                        </div>
                        <div class="key-skills">
                            <h3>Key Skills</h3>
                            <ul>
                                <li>Catia V5</li>
                                <li>UGNX</li>
                                <li>Plastic Domain</li>
                                <li>Catia V5</li>
                            </ul>
                        </div>
                        <div class="job-match-score job-detail-social-icon">
                            <h4>Share this Job</h4>
                            <ul>
                                <li><img src="{{ URL::asset(FRONTEND.'/assets/images/jobdetailssocialicon1.svg') }}" /></li>
                                <li><img src="{{ URL::asset(FRONTEND.'/assets/images/jobdetailssocialicon2.svg') }}" /></li>
                                <li><img src="{{ URL::asset(FRONTEND.'/assets/images/jobdetailssocialicon3.svg') }}" /></li>
                                <li><img src="{{ URL::asset(FRONTEND.'/assets/images/jobdetailssocialicon4.svg') }}" /></li>
                                <li><img src="{{ URL::asset(FRONTEND.'/assets/images/jobdetailssocialicon5.svg') }}" /></li>
                            </ul>
                        </div>
                        <div class="about-company">
                            <h3>About Company</h3>
                            <p>For large global companies, Onward Technologies is the services provider
                                 who can help translate your vision into reality with high-end
                                  capabilities and flawless execution across the Engineering
                                  Services and the Digital Transformation suite, Embedded Systems,
                                  data analytics, data science, Artificial Intelligence (AI) and
                                  Machine Learning (ML).</p>
                            <p>YOUR IMAGINATION. DELIVERED TO PERFECTION – that's what we stand for,
                                 that's what we promise our customers, and that's how we will continue
                                 writing success stories for our customers, and for us.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="similar-jobs">
                            <h3>Similar Jobs</h3>
                            <div class="similar-jobs-card">
                                <div class="similar-job-card-title">
                                    <h4>Lead Engineer / Senior Lead Engineer (Product Design)</h4>
                                    <p>Collins Aerospace technology</p>
                                    <div class="similar-job-card-info">
                                        <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg') }}"> </span>5-10 Years
                                        </p><p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg') }}"> </span>Banglore</p>
                                    </div>
                                </div>
                            </div>
                            <div class="similar-jobs-card">
                                <div class="similar-job-card-title">
                                    <h4>Lead Engineer / Senior Lead Engineer (Product Design)</h4>
                                    <p>Collins Aerospace technology</p>
                                    <div class="similar-job-card-info">
                                        <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg') }}"> </span>5-10 Years
                                        </p><p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg') }}"> </span>Banglore</p>
                                    </div>
                                </div>
                            </div>
                            <div class="similar-jobs-card">
                                <div class="similar-job-card-title">
                                    <h4>Lead Engineer / Senior Lead Engineer (Product Design)</h4>
                                    <p>Collins Aerospace technology</p>
                                    <div class="similar-job-card-info">
                                        <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg') }}"> </span>5-10 Years
                                        </p><p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg') }}"> </span>Banglore</p>
                                    </div>
                                </div>
                            </div>
                            <div class="similar-jobs-card">
                                <div class="similar-job-card-title">
                                    <h4>Lead Engineer / Senior Lead Engineer (Product Design)</h4>
                                    <p>Collins Aerospace technology</p>
                                    <div class="similar-job-card-info">
                                        <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg') }}"> </span>5-10 Years
                                        </p><p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg') }}"> </span>Banglore</p>
                                    </div>
                                </div>
                            </div>
                            <div class="similar-jobs-card">
                                <div class="similar-job-card-title">
                                    <h4>Lead Engineer / Senior Lead Engineer (Product Design)</h4>
                                    <p>Collins Aerospace technology</p>
                                    <div class="similar-job-card-info">
                                        <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg') }}"> </span>5-10 Years
                                        </p><p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg') }}"> </span>Banglore</p>
                                    </div>
                                </div>
                            </div>
                            <div class="similar-jobs-card">
                                <div class="similar-job-card-title">
                                    <h4>Lead Engineer / Senior Lead Engineer (Product Design)</h4>
                                    <p>Collins Aerospace technology</p>
                                    <div class="similar-job-card-info">
                                        <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg') }}"> </span>5-10 Years
                                        </p><p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg') }}"> </span>Banglore</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="job-details-ad">
                            <img src="{{ URL::asset(FRONTEND.'/assets/images/jobdetailsad.svg') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@stop
