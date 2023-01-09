@extends('frontend.employer.layout')
@section('title', 'Search Resume Data')

@section('content')

    <main>
        <div class="search-resume-database resume-database-view">
            <div class="container search-resume-database-main">
                <div class="row">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="d-flex-title">
                                <h1>Resume database search for</h1>
                                <a href="#">Edit <span> <img
                                            src="{{ URL::asset(FRONTEND . '/assets/images/editicon.svg') }}" /> </span></a>
                            </div>
                            <div class="job-card">
                                <div class="job-card-title">
                                    <div class="d-flex">
                                        <h3>Lead Engineer / Senior Lead Engineer (Product Design)</h3>
                                        <p> Collins Aerospace technology</p>
                                    </div>
                                </div>
                                <div class="job-card-details">
                                    <div class="job-card-info">
                                        <div class="years">
                                            <p><span><img
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/briefccaseicon.svg') }}">
                                                </span>5-10 Years</p>
                                        </div>
                                        <div class="location">
                                            <p><span><img
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/mappinicon.svg') }}">
                                                </span>Banglore</p>
                                        </div>
                                        <div class="salary">
                                            <p><span><img src="{{ URL::asset(FRONTEND . '/assets/images/rupeeicon.svg') }}">
                                                </span>5-6 Lakhs</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="job-card-description">
                                    <p>CATIA, PLM , Change management, SAP , Avaition, Aerospace, CAD, Senior, Lead,
                                        Continue. In this role the Lead Engineer / Senior Lead Engineer will actively
                                        participate in reviewing the Lead Engineer, Senior Lead Engineer will actively
                                        participat...</p>
                                </div>
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
                                    <div class="d-flex">
                                        <p>Resume Search Quota - </p>
                                        <h6> Add Quota</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-7">
                        <div class="resume-database-cardview">
                            <div class="d-flex-title">
                                <h3>Resume Database : <span>351 Cadndidate found</span> </h3>
                                <label>Filter </label>
                                <select class="form-control" aria-label="Default select example">
                                    <option selected>Top Matched</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>

                            @forelse ($data as $data)
                                @php
                                    $cityName = '';

                                    $cities = explode(',', $data->user_preferred_city);
                                    $cityname = [];
                                    foreach ($cities as $city) {
                                        $cityInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getCityInfo($city);
                                        if (count($cityInfo)) {
                                            array_push($cityname, $cityInfo[0]->city_name);
                                        }
                                    }
                                    $cityName = implode(',', $cityname);

                                @endphp
                                <div class="database-dflex">
                                    <div class="resume-view-card">
                                        <div class="d-flex card-header">
                                            <h4>{{ $data->user_firstname.' '.$data->user_lastname }}</h4>
                                            <div class="resume-progress">
                                                <div class="d-flex">
                                                    <label>Profile Match</label>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 25%"
                                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <label>Skill Match</label>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 25%"
                                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="job-card-details">
                                            <div class="job-card-info">
                                                <div class="years">
                                                    {{-- <p><span><img
                                                                src="{{ URL::asset(FRONTEND . '/assets/images/briefccaseicon.svg') }}">
                                                        </span>{{ SalaryLakhs()[$data->user_total_experience_year - 1] }}
                                                        - {{ SalaryLakhs()[$data->user_total_experience_month - 1] }} Years
                                                    </p> --}}
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

                                                            {{-- {{ SalaryLakhs()[$data->user_current_salary_year - 1] }}
                                                            -
                                                            {{ SalaryLakhs()[$data->user_current_salary_month - 1] }} --}}
                                                            Lakhs

                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-flex">
                                            <div class="candidate-details">
                                                <ul>
                                                    <li><span>Title <span> : </span> </span>
                                                        {{ $data->user_resume_headline }} </li>
                                                    <li><span>Education <span> : </span></span>
                                                    </li>
                                                    <li><span>Pref Location <span> : </span> </span> Pune, chennai</li>
                                                    <li><span>Key Skill <span> : </span> </span> Catia, Plastic domain,
                                                        Automotive</li>
                                                    <li><span>Also Know <span> : </span></span> NX, BW, Tool design</li>
                                                </ul>
                                            </div>
                                            <div class="candidate-photo">
                                                <img src="assets/images/useravatar.svg" alt="image" />
                                                <button class="btn view">View Mobile/Resume</button>
                                                <span>Last active : 25 Apr, 2022</span>
                                            </div>
                                        </div>
                                        <div class="card-save">
                                            <img src="{{ URL::asset(FRONTEND . '/assets/images/saveicon.svg') }}"
                                                alt="image" />
                                            <span>Save</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse

                        </div>
                        <div class="pagination">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pg-blue">
                                    <li class="page-item disabled">
                                        <a class="page-link" tabindex="-1"><span><img
                                                    src="{{ URL::asset(FRONTEND . '/assets/images/arrowleft.svg') }}"></span>
                                            Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link">1</a></li>
                                    <li class="page-item"><a class="page-link">2</a></li>
                                    <li class="page-item active"><a class="page-link">3</a></li>
                                    <li class="page-item"><a class="page-link">4</a></li>
                                    <li class="page-item"><a class="page-link">5</a></li>
                                    <li class="page-item"><a class="page-link">....</a></li>
                                    <li class="page-item">
                                        <a class="page-link">Next <span><img
                                                    src="{{ URL::asset(FRONTEND . '/assets/images/arrowleft.svg') }}"></span></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-md-5 job-post">
                        <div class="d-flex">
                            <h3>Saved candidate data</h3>
                            <a href="#">See all</a>
                        </div>
                        <div class="similar-jobs">
                            <div class="form">
                                <form>
                                    <div class="form-group">
                                        <input type="text" placeholder="Search from history" class="form-control">
                                    </div>
                                </form>
                            </div>
                            <div class="similar-jobs-card">
                                <div class="similar-job-card-title">
                                    <div class="d-flex">
                                        <h4>Pritam Nagale </h4>
                                        <span><a href="#"><img
                                                    src="{{ URL::asset(FRONTEND . '/assets/images/closeicon.svg') }}" /></a></span>
                                    </div>
                                    <p><span>Design engineer - Automotive Plastic Product design..</span></p>
                                    <div class="similar-job-card-info">
                                        <p><span><img
                                                    src="{{ URL::asset(FRONTEND . '/assets/images/briefccaseicon.svg') }}">
                                            </span>5-10 Years
                                        </p>
                                        <p><span><img src="{{ URL::asset(FRONTEND . '/assets/images/mappinicon.svg') }}">
                                            </span>Banglore</p>
                                        <p><span><img src="{{ URL::asset(FRONTEND . '/assets/images/rupeeicon.svg') }}">
                                            </span>5-6 Lakhs</p>
                                    </div>
                                    <div class="job-card-apply">
                                        <h4> Key skill : <span>SAP, PLM, CATIA</span></h4>
                                        <div class="job-card-button">
                                            <button type="button" class="btn btn-primary">View</button>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                        <div class="pagination">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pg-blue">
                                    <li class="page-item disabled">
                                        <a class="page-link" tabindex="-1"><span><img
                                                    src="{{ URL::asset(FRONTEND . '/assets/images/arrowleft.svg') }}" /></span>
                                            Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link">1</a></li>
                                    <li class="page-item"><a class="page-link">2</a></li>
                                    <li class="page-item active"><a class="page-link">3</a></li>
                                    <li class="page-item"><a class="page-link">4</a></li>
                                    <li class="page-item"><a class="page-link">5</a></li>
                                    <li class="page-item"><a class="page-link">....</a></li>
                                    <li class="page-item">
                                        <a class="page-link">Next <span><img
                                                    src="{{ URL::asset(FRONTEND . '/assets/images/arrowleft.svg') }}" /></span></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
    </main>


@stop
