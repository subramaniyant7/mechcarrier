@extends('frontend.layout')
@section('title', 'Job Search')
@section('content')
    <main>
        <div class="job-search-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2> <span><img src="{{ URL::asset(FRONTEND.'/assets/images/searchicon.svg') }}" /></span> Jobs search for : Catia v5, Automotive,
                            plastic... - Pune, Benglore - <span>Edit</span> <img src="{{ URL::asset(FRONTEND.'/assets/images/editicon.svg') }}" /> </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="searchfilter-sidebar">
                            <div class="searchfilter-dflex">
                                <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/filtericon.svg') }}" /></span> Filters</p>
                                <h4>Clear all</h4>
                            </div>
                            <div class="searchfilters-list">
                                <h4>job type </h4>
                                <ul>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Part Time
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Full Time
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="searchfilters-list">
                                <h4>Posted by</h4>
                                <ul>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Company
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Consultacy
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="searchfilters-list">
                                <h4>Experience</h4>
                                <ul>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                0 -1 years
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                1 - 3 Years
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                3 - 5 Years
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                5 - 10 Years
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                10 - 15 Years
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                15 + Years
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="searchfilters-list">
                                <h4>Education</h4>
                                <ul>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Diploma
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                B.E / B.Tech
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                M.E / M.Tech
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Other
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="searchfilters-list">
                                <h4>Comapany Type</h4>
                                <ul>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Foreign MNC
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Indian MNC
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Corporate
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Start Up
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Contract base
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
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
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg') }}"> </span>5-10 Years</p>
                                        </div>
                                        <div class="location">
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg') }}"> </span>Banglore</p>
                                        </div>
                                        <div class="salary">
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/rupeeicon.svg') }}"> </span>5-6 Lakhs</p>
                                        </div>
                                    </div>
                                    <div class="job-posted-date">
                                        <h4>Posted : <span>Just now</span></h4>
                                    </div>
                                </div>
                                <div class="job-card-description">
                                    <p>CATIA, PLM , Change management, SAP , Avaition, Aerospace, CAD, Senior, Lead,
                                        Continue. In this role the Lead Engineer / Senior Lead Engineer will actively
                                        participate in reviewing the Lead Engineer, Senior Lead Engineer will actively
                                        participat... <span>more</span></p>
                                </div>
                                <div class="job-card-apply">
                                    <h4><img src="{{ URL::asset(FRONTEND.'/assets/images/filetexticon.svg') }}"> Key skill : <span>SAP, PLM, CATIA</span>
                                    </h4>
                                    <div class="job-card-button">
                                        <button type="button" class="btn btn-primary  bg-white">Save</button>
                                        <button type="button" class="btn btn-primary">Apply</button>
                                    </div>
                                </div>
                            </div>
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
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg') }}"> </span>5-10 Years</p>
                                        </div>
                                        <div class="location">
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg') }}"> </span>Banglore</p>
                                        </div>
                                        <div class="salary">
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/rupeeicon.svg') }}"> </span>5-6 Lakhs</p>
                                        </div>
                                    </div>
                                    <div class="job-posted-date">
                                        <h4>Posted : <span>Just now</span></h4>
                                    </div>
                                </div>
                                <div class="job-card-description">
                                    <p>CATIA, PLM , Change management, SAP , Avaition, Aerospace, CAD, Senior, Lead,
                                        Continue. In this role the Lead Engineer / Senior Lead Engineer will actively
                                        participate in reviewing the Lead Engineer, Senior Lead Engineer will actively
                                        participat... <span>more</span></p>
                                </div>
                                <div class="job-card-apply">
                                    <h4><img src="{{ URL::asset(FRONTEND.'/assets/images/filetexticon.svg') }}"> Key skill : <span>SAP, PLM, CATIA</span>
                                    </h4>
                                    <div class="job-card-button">
                                        <button type="button" class="btn btn-primary  bg-white">Save</button>
                                        <button type="button" class="btn btn-primary">Apply</button>
                                    </div>
                                </div>
                            </div>
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
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg') }}"> </span>5-10 Years</p>
                                        </div>
                                        <div class="location">
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg') }}"> </span>Banglore</p>
                                        </div>
                                        <div class="salary">
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/rupeeicon.svg') }}"> </span>5-6 Lakhs</p>
                                        </div>
                                    </div>
                                    <div class="job-posted-date">
                                        <h4>Posted : <span>Just now</span></h4>
                                    </div>
                                </div>
                                <div class="job-card-description">
                                    <p>CATIA, PLM , Change management, SAP , Avaition, Aerospace, CAD, Senior, Lead,
                                        Continue. In this role the Lead Engineer / Senior Lead Engineer will actively
                                        participate in reviewing the Lead Engineer, Senior Lead Engineer will actively
                                        participat... <span>more</span></p>
                                </div>
                                <div class="job-card-apply">
                                    <h4><img src="{{ URL::asset(FRONTEND.'/assets/images/filetexticon.svg') }}"> Key skill : <span>SAP, PLM, CATIA</span>
                                    </h4>
                                    <div class="job-card-button">
                                        <button type="button" class="btn btn-primary  bg-white">Save</button>
                                        <button type="button" class="btn btn-primary">Apply</button>
                                    </div>
                                </div>
                            </div>
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
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg') }}"> </span>5-10 Years</p>
                                        </div>
                                        <div class="location">
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg') }}"> </span>Banglore</p>
                                        </div>
                                        <div class="salary">
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/rupeeicon.svg') }}"> </span>5-6 Lakhs</p>
                                        </div>
                                    </div>
                                    <div class="job-posted-date">
                                        <h4>Posted : <span>Just now</span></h4>
                                    </div>
                                </div>
                                <div class="job-card-description">
                                    <p>CATIA, PLM , Change management, SAP , Avaition, Aerospace, CAD, Senior, Lead,
                                        Continue. In this role the Lead Engineer / Senior Lead Engineer will actively
                                        participate in reviewing the Lead Engineer, Senior Lead Engineer will actively
                                        participat... <span>more</span></p>
                                </div>
                                <div class="job-card-apply">
                                    <h4><img src="{{ URL::asset(FRONTEND.'/assets/images/filetexticon.svg') }}"> Key skill : <span>SAP, PLM, CATIA</span>
                                    </h4>
                                    <div class="job-card-button">
                                        <button type="button" class="btn btn-primary  bg-white">Save</button>
                                        <button type="button" class="btn btn-primary">Apply</button>
                                    </div>
                                </div>
                            </div>
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
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg') }}"> </span>5-10 Years</p>
                                        </div>
                                        <div class="location">
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg') }}"> </span>Banglore</p>
                                        </div>
                                        <div class="salary">
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/rupeeicon.svg') }}"> </span>5-6 Lakhs</p>
                                        </div>
                                    </div>
                                    <div class="job-posted-date">
                                        <h4>Posted : <span>Just now</span></h4>
                                    </div>
                                </div>
                                <div class="job-card-description">
                                    <p>CATIA, PLM , Change management, SAP , Avaition, Aerospace, CAD, Senior, Lead,
                                        Continue. In this role the Lead Engineer / Senior Lead Engineer will actively
                                        participate in reviewing the Lead Engineer, Senior Lead Engineer will actively
                                        participat... <span>more</span></p>
                                </div>
                                <div class="job-card-apply">
                                    <h4><img src="{{ URL::asset(FRONTEND.'/assets/images/filetexticon.svg') }}"> Key skill : <span>SAP, PLM, CATIA</span>
                                    </h4>
                                    <div class="job-card-button">
                                        <button type="button" class="btn btn-primary  bg-white">Save</button>
                                        <button type="button" class="btn btn-primary">Apply</button>
                                    </div>
                                </div>
                            </div>
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
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg') }}"> </span>5-10 Years</p>
                                        </div>
                                        <div class="location">
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg') }}"> </span>Banglore</p>
                                        </div>
                                        <div class="salary">
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/rupeeicon.svg') }}"> </span>5-6 Lakhs</p>
                                        </div>
                                    </div>
                                    <div class="job-posted-date">
                                        <h4>Posted : <span>Just now</span></h4>
                                    </div>
                                </div>
                                <div class="job-card-description">
                                    <p>CATIA, PLM , Change management, SAP , Avaition, Aerospace, CAD, Senior, Lead,
                                        Continue. In this role the Lead Engineer / Senior Lead Engineer will actively
                                        participate in reviewing the Lead Engineer, Senior Lead Engineer will actively
                                        participat... <span>more</span></p>
                                </div>
                                <div class="job-card-apply">
                                    <h4><img src="{{ URL::asset(FRONTEND.'/assets/images/filetexticon.svg') }}"> Key skill : <span>SAP, PLM, CATIA</span>
                                    </h4>
                                    <div class="job-card-button">
                                        <button type="button" class="btn btn-primary  bg-white">Save</button>
                                        <button type="button" class="btn btn-primary">Apply</button>
                                    </div>
                                </div>
                            </div>
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
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg') }}"> </span>5-10 Years</p>
                                        </div>
                                        <div class="location">
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/mappinicon.svg') }}"> </span>Banglore</p>
                                        </div>
                                        <div class="salary">
                                            <p><span><img src="{{ URL::asset(FRONTEND.'/assets/images/rupeeicon.svg') }}"> </span>5-6 Lakhs</p>
                                        </div>
                                    </div>
                                    <div class="job-posted-date">
                                        <h4>Posted : <span>Just now</span></h4>
                                    </div>
                                </div>
                                <div class="job-card-description">
                                    <p>CATIA, PLM , Change management, SAP , Avaition, Aerospace, CAD, Senior, Lead,
                                        Continue. In this role the Lead Engineer / Senior Lead Engineer will actively
                                        participate in reviewing the Lead Engineer, Senior Lead Engineer will actively
                                        participat... <span>more</span></p>
                                </div>
                                <div class="job-card-apply">
                                    <h4><img src="{{ URL::asset(FRONTEND.'/assets/images/filetexticon.svg') }}"> Key skill : <span>SAP, PLM, CATIA</span>
                                    </h4>
                                    <div class="job-card-button">
                                        <button type="button" class="btn btn-primary  bg-white">Save</button>
                                        <button type="button" class="btn btn-primary">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pagination">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pg-blue justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link" tabindex="-1">Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link">1</a></li>
                                    <li class="page-item"><a class="page-link">2</a></li>
                                    <li class="page-item active"><a class="page-link">3</a></li>
                                    <li class="page-item"><a class="page-link">4</a></li>
                                    <li class="page-item"><a class="page-link">5</a></li>
                                    <li class="page-item"><a class="page-link">6</a></li>
                                    <li class="page-item"><a class="page-link">....</a></li>
                                    <li class="page-item"><a class="page-link">12</a></li>
                                    <li class="page-item"><a class="page-link">13</a></li>
                                    <li class="page-item">
                                        <a class="page-link">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@stop
