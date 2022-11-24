@extends('frontend.layout')
@section('title', 'Job Search')
@section('content')
    <main>
        <div class="job-search-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="user-dasboard-form">
                            <div class="form-dflex">
                                <form method="GET">
                                    <div class="d-flex">
                                        <input type="text" name="skil" class="form-control"
                                            placeholder="Search job by skill, destination or companies">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                    <div class="d-flex">
                                        <input type="text" name="location" placeholder="Location" class="form-control">
                                        <input type="text" name="experience" placeholder="Experience" class="form-control">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <img src="{{ URL::asset(FRONTEND . '/assets/images/jobsearchimg.svg') }}" />
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="searchfilter-sidebar">
                            <div class="searchfilter-dflex">
                                <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/filtericon.svg')}}" /></span> Filters</p>
                                <h4>Clear all</h4>
                            </div>
                            <div class="searchfilters-list">
                                <h4>Job type </h4>
                                <ul>
                                    @foreach(employmentType() as $k => $employment)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{$k+1}}"
                                                       id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    {{ $employment }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="searchfilters-list">
                                <h4>Posted by</h4>
                                <ul>
                                    @foreach(typeOfCompany() as $p => $type)
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{$p}}"
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                {{$type}}
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="searchfilters-list">
                                <h4>Experience</h4>
                                <ul>
                                    @foreach(experienceGap() as $l => $experiencegap)
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{$l}}"
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                {{$experiencegap}} Years
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="searchfilters-list">


                                <h4>Education</h4>
                                <ul>
                                    @foreach(getActiveRecord('education_info') as $education_info)
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $education_info->education_id }}"
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                {{ $education_info->education_name }}
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="searchfilters-list">
                                <h4>Company Type</h4>
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
                                    <img src="{{URL::asset(FRONTEND.'/assets/images/jobicon.svg')}}">
                                </div>
                                <div class="job-card-details">
                                    <div class="job-card-info">
                                        <div class="years">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg')}}"> </span>5-10 Years</p>
                                        </div>
                                        <div class="location">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/mappinicon.svg')}}"> </span>Banglore</p>
                                        </div>
                                        <div class="salary">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/rupeeicon.svg')}}"> </span>5-6 Lakhs</p>
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
                                    <h4><img src="{{URL::asset(FRONTEND.'/assets/images/filetexticon.svg')}}"> Key skill : <span>SAP, PLM, CATIA</span>
                                    </h4>
                                    <div class="job-card-button">
                                        <button type="button" class="btn btn-primary  bg-white">Saved</button>
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
                                    <img src="{{URL::asset(FRONTEND.'/ssets/images/jobicon.svg')}}">
                                </div>
                                <div class="job-card-details">
                                    <div class="job-card-info">
                                        <div class="years">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg')}}"> </span>5-10 Years</p>
                                        </div>
                                        <div class="location">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/mappinicon.svg')}}"> </span>Banglore</p>
                                        </div>
                                        <div class="salary">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/rupeeicon.svg')}}"> </span>5-6 Lakhs</p>
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
                                    <h4><img src="{{URL::asset(FRONTEND.'/assets/images/filetexticon.svg')}}"> Key skill : <span>SAP, PLM, CATIA</span>
                                    </h4>
                                    <div class="job-card-button">
                                        <button type="button" class="btn btn-primary  bg-white">Saved</button>
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
                                    <img src="{{URL::asset(FRONTEND.'/assets/images/jobicon.svg')}}">
                                </div>
                                <div class="job-card-details">
                                    <div class="job-card-info">
                                        <div class="years">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg')}}"> </span>5-10 Years</p>
                                        </div>
                                        <div class="location">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/mappinicon.svg')}}"> </span>Banglore</p>
                                        </div>
                                        <div class="salary">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/rupeeicon.svg')}}"> </span>5-6 Lakhs</p>
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
                                    <h4><img src="{{URL::asset(FRONTEND.'/assets/images/filetexticon.svg')}}"> Key skill : <span>SAP, PLM, CATIA</span>
                                    </h4>
                                    <div class="job-card-button">
                                        <button type="button" class="btn btn-primary  bg-white">Saved</button>
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
                                    <img src="{{URL::asset(FRONTEND.'/assets/images/jobicon.svg')}}">
                                </div>
                                <div class="job-card-details">
                                    <div class="job-card-info">
                                        <div class="years">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg')}}"> </span>5-10 Years</p>
                                        </div>
                                        <div class="location">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/mappinicon.svg')}}"> </span>Banglore</p>
                                        </div>
                                        <div class="salary">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/rupeeicon.svg')}}"> </span>5-6 Lakhs</p>
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
                                    <h4><img src="{{URL::asset(FRONTEND.'/assets/images/filetexticon.svg')}}"> Key skill : <span>SAP, PLM, CATIA</span>
                                    </h4>
                                    <div class="job-card-button">
                                        <button type="button" class="btn btn-primary  bg-white">Saved</button>
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
                                    <img src="{{URL::asset(FRONTEND.'/assets/images/jobicon.svg')}}">
                                </div>
                                <div class="job-card-details">
                                    <div class="job-card-info">
                                        <div class="years">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg')}}"> </span>5-10 Years</p>
                                        </div>
                                        <div class="location">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/mappinicon.svg')}}"> </span>Banglore</p>
                                        </div>
                                        <div class="salary">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/rupeeicon.svg')}}"> </span>5-6 Lakhs</p>
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
                                    <h4><img src="{{URL::asset(FRONTEND.'/assets/images/filetexticon.svg')}}"> Key skill : <span>SAP, PLM, CATIA</span>
                                    </h4>
                                    <div class="job-card-button">
                                        <button type="button" class="btn btn-primary  bg-white">Saved</button>
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
                                    <img src="{{URL::asset(FRONTEND.'/assets/images/jobicon.svg')}}">
                                </div>
                                <div class="job-card-details">
                                    <div class="job-card-info">
                                        <div class="years">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg')}}"> </span>5-10 Years</p>
                                        </div>
                                        <div class="location">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/mappinicon.svg')}}"> </span>Banglore</p>
                                        </div>
                                        <div class="salary">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/rupeeicon.svg')}}"> </span>5-6 Lakhs</p>
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
                                    <h4><img src="{{URL::asset(FRONTEND.'/assets/images/filetexticon.svg')}}"> Key skill : <span>SAP, PLM, CATIA</span>
                                    </h4>
                                    <div class="job-card-button">
                                        <button type="button" class="btn btn-primary  bg-white">Saved</button>
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
                                    <img src="{{URL::asset(FRONTEND.'/assets/images/jobicon.svg')}}">
                                </div>
                                <div class="job-card-details">
                                    <div class="job-card-info">
                                        <div class="years">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/briefccaseicon.svg')}}"> </span>5-10 Years</p>
                                        </div>
                                        <div class="location">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/mappinicon.svg')}}"> </span>Banglore</p>
                                        </div>
                                        <div class="salary">
                                            <p><span><img src="{{URL::asset(FRONTEND.'/assets/images/rupeeicon.svg')}}"> </span>5-6 Lakhs</p>
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
                                    <h4><img src="{{URL::asset(FRONTEND.'/assets/images/filetexticon.svg')}}"> Key skill : <span>SAP, PLM, CATIA</span>
                                    </h4>
                                    <div class="job-card-button">
                                        <button type="button" class="btn btn-primary  bg-white">Saved</button>
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
