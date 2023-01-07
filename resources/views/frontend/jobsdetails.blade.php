@extends('frontend.layout')
@section('title', $postInfo[0]->employer_post_headline)

@section('content')

    <main>
        @php
            $employerName = $aboutCompany = $stateName = $cityName = '';
            $companyLogo = FRONTEND . '/assets/images/company_logo.svg';
            $employerInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getEmployerInfoById($postInfo[0]->employer_post_employee_id);
            if (count($employerInfo)) {
                $employerName = $employerInfo[0]->employer_company_name;
                $aboutCompany = $employerInfo[0]->employer_about_company;
                $companyLogo = $employerInfo[0]->employer_company_logo != '' ? '/uploads/employer/company/' . $employerInfo[0]->employer_company_logo : $companyLogo;
            }

            $stateInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getStateById($postInfo[0]->employer_post_location_state);
            if (count($stateInfo)) {
                $stateName = $stateInfo[0]->state_name;
            }
            $cityInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getCityInfo($postInfo[0]->employer_post_location_city);
            if (count($cityInfo)) {
                $cityName = $cityInfo[0]->city_name;
            }
        @endphp
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
                                            <h3>{{ $postInfo[0]->employer_post_headline }}</h3>
                                            <p> {{ $employerName }}</p>
                                        </div>
                                        <img src="{{ URL::asset($companyLogo) }}">
                                    </div>
                                    <div class="job-card-details">
                                        <div class="job-card-info">
                                            <div class="years">
                                                <p><span><img
                                                            src="{{ URL::asset(FRONTEND . '/assets/images/briefccaseicon.svg') }}">
                                                    </span>
                                                    {{ SalaryLakhs()[$postInfo[0]->employer_post_experience_from - 1] }} - {{ SalaryLakhs()[$postInfo[0]->employer_post_experience_to - 1] }} Years
                                                </p>
                                            </div>
                                            <div class="location">
                                                <p><span><img
                                                            src="{{ URL::asset(FRONTEND . '/assets/images/mappinicon.svg') }}">
                                                    </span>{{ $cityName }}</p>
                                            </div>
                                            <div class="salary">
                                                <p><span><img
                                                            src="{{ URL::asset(FRONTEND . '/assets/images/rupeeicon.svg') }}">
                                                    </span>
                                                    @if ($postInfo[0]->employer_post_hidesalary == 2)
                                                        {{ SalaryLakhs()[$postInfo[0]->employer_post_salary_range_from_lakhs - 1] }}
                                                        -
                                                        {{ SalaryLakhs()[$postInfo[0]->employer_post_salary_range_to_lakhs - 1] }}
                                                        Lakhs
                                                    @else
                                                        Not disclosed
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="job-card-apply">
                                        <div class="job-posted-date">
                                            <h4>Posted : <span>{{ date('d-m-Y', strtotime($postInfo[0]->created_at)) }}</span></h4>
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
                                        <li><span> <img src="{{ URL::asset(FRONTEND . '/assets/images/tickicon.svg') }}" />
                                            </span> Keyskills</li>
                                        <li><span> <img src="{{ URL::asset(FRONTEND . '/assets/images/tickicon.svg') }}" />
                                            </span> Location</li>
                                        <li><span> <img
                                                    src="{{ URL::asset(FRONTEND . '/assets/images/tickicon1.svg') }}" />
                                            </span> Work experience
                                        </li>
                                        <li><span> <img
                                                    src="{{ URL::asset(FRONTEND . '/assets/images/tickicon1.svg') }}" />
                                            </span> Salary</li>
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
                                @php
                                    $desc = [];
                                    $desc = explode('•', $postInfo[0]->employer_post_description);
                                @endphp
                                <ul style="padding-top:5px;">
                                    @foreach ($desc as $desc1)
                                        @if ($desc1 != '')
                                            <li> {{ $desc1 }} </li>
                                        @endif
                                    @endforeach
                                </ul>
                                {{-- <ul>
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
                                </ul> --}}
                            </div>
                            <div class="key-skills">
                                <h3>Key Skills</h3>
                                <ul>
                                    @php
                                        $skil = [];
                                        $skil = explode(',', $postInfo[0]->employer_post_key_skils);
                                    @endphp
                                    @foreach ($skil as $skil)
                                        @if ($skil != '')
                                            <li> {{ $skil }} </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="job-match-score job-detail-social-icon">
                                <h4>Share this Job</h4>
                                <ul>
                                    <li><img
                                            src="{{ URL::asset(FRONTEND . '/assets/images/jobdetailssocialicon1.svg') }}" />
                                    </li>
                                    <li><img
                                            src="{{ URL::asset(FRONTEND . '/assets/images/jobdetailssocialicon2.svg') }}" />
                                    </li>
                                    <li><img
                                            src="{{ URL::asset(FRONTEND . '/assets/images/jobdetailssocialicon3.svg') }}" />
                                    </li>
                                    <li><img
                                            src="{{ URL::asset(FRONTEND . '/assets/images/jobdetailssocialicon4.svg') }}" />
                                    </li>
                                    <li><img
                                            src="{{ URL::asset(FRONTEND . '/assets/images/jobdetailssocialicon5.svg') }}" />
                                    </li>
                                </ul>
                            </div>
                            <div class="about-company">
                                <h3>About Company</h3>
                                <p>{{ $aboutCompany }}</p>
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
                                            <p><span><img
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/briefccaseicon.svg') }}">
                                                </span>5-10 Years
                                            </p>
                                            <p><span><img
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/mappinicon.svg') }}">
                                                </span>Banglore</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="similar-jobs-card">
                                    <div class="similar-job-card-title">
                                        <h4>Lead Engineer / Senior Lead Engineer (Product Design)</h4>
                                        <p>Collins Aerospace technology</p>
                                        <div class="similar-job-card-info">
                                            <p><span><img
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/briefccaseicon.svg') }}">
                                                </span>5-10 Years
                                            </p>
                                            <p><span><img
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/mappinicon.svg') }}">
                                                </span>Banglore</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="similar-jobs-card">
                                    <div class="similar-job-card-title">
                                        <h4>Lead Engineer / Senior Lead Engineer (Product Design)</h4>
                                        <p>Collins Aerospace technology</p>
                                        <div class="similar-job-card-info">
                                            <p><span><img
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/briefccaseicon.svg') }}">
                                                </span>5-10 Years
                                            </p>
                                            <p><span><img
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/mappinicon.svg') }}">
                                                </span>Banglore</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="similar-jobs-card">
                                    <div class="similar-job-card-title">
                                        <h4>Lead Engineer / Senior Lead Engineer (Product Design)</h4>
                                        <p>Collins Aerospace technology</p>
                                        <div class="similar-job-card-info">
                                            <p><span><img
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/briefccaseicon.svg') }}">
                                                </span>5-10 Years
                                            </p>
                                            <p><span><img
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/mappinicon.svg') }}">
                                                </span>Banglore</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="similar-jobs-card">
                                    <div class="similar-job-card-title">
                                        <h4>Lead Engineer / Senior Lead Engineer (Product Design)</h4>
                                        <p>Collins Aerospace technology</p>
                                        <div class="similar-job-card-info">
                                            <p><span><img
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/briefccaseicon.svg') }}">
                                                </span>5-10 Years
                                            </p>
                                            <p><span><img
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/mappinicon.svg') }}">
                                                </span>Banglore</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="similar-jobs-card">
                                    <div class="similar-job-card-title">
                                        <h4>Lead Engineer / Senior Lead Engineer (Product Design)</h4>
                                        <p>Collins Aerospace technology</p>
                                        <div class="similar-job-card-info">
                                            <p><span><img
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/briefccaseicon.svg') }}">
                                                </span>5-10 Years
                                            </p>
                                            <p><span><img
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/mappinicon.svg') }}">
                                                </span>Banglore</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="job-details-ad">
                                <img src="{{ URL::asset(FRONTEND . '/assets/images/jobdetailsad.svg') }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@stop
