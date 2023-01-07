@extends('frontend.employer.layout')
@section('title', 'Search Resume')

@section('content')

    <main>
        <div class="search-resume-database">
            <div class="container search-resume-database-main">
                <div class="row">
                    <div class="col-md-7">
                        <div class="search-resume-database-title">
                            <h1>Search Resume</h1>
                        </div>
                        <div class="form">
                            <form>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-outline">
                                            <label>Resume database name * <span>Its help you to find
                                                    later</span></label>
                                            <input type="text" class="form-control"
                                                placeholder="e.g. BIW design engineer 2 to 5 year seach - pune" required>
                                        </div>
                                    </div>
                                </div>
                                <div style="background: rgba(161, 161, 162, 0.16);">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-outline">
                                                <label>All keyword *</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Skill, designation role seperated by comma" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Total Year Experience *</label>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="form-outline">
                                                    <select class="form-control" required>
                                                        <option selected=""> Minimum</option>
                                                        <option value="1"> Add qualification</option>
                                                        <option value="2"> Add qualification</option>
                                                        <option value="3"> Add qualification</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-outline">
                                                <select class="form-control">
                                                    <option selected=""> Maximum</option>
                                                    <option value="1"> Add qualification</option>
                                                    <option value="2"> Add qualification</option>
                                                    <option value="3"> Add qualification</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button class="btn btn-primary">Search and view result</button>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr />
                                        <a href="#" target="_blank">Advanced Search</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-outline">
                                                <label>Search in </label>
                                                <select class="form-control">
                                                    <option selected=""> Entire Resume</option>
                                                    <option value="1"> Add qualification</option>
                                                    <option value="2"> Add qualification</option>
                                                    <option value="3"> Add qualification</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-outline">
                                                <label>Qualifacation</label>
                                                <select class="form-control">
                                                    <option selected="">Add Qualifacation</option>
                                                    <option value="1"> Add qualification</option>
                                                    <option value="2"> Add qualification</option>
                                                    <option value="3"> Add qualification</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex-salary">
                                    <div class="col-md-12">
                                        <label>Current Salary Range</label>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-outline">
                                                <select class="form-control">
                                                    <option selected="">Lakh</option>
                                                    <option value="1"> Add qualification</option>
                                                    <option value="2"> Add qualification</option>
                                                    <option value="3"> Add qualification</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-outline">
                                                <select class="form-control">
                                                    <option selected="">Thousand</option>
                                                    <option value="1"> Add qualification</option>
                                                    <option value="2"> Add qualification</option>
                                                    <option value="3"> Add qualification</option>
                                                </select>
                                            </div>
                                        </div>
                                        <p>To</p>
                                        <div class="form-group">
                                            <div class="form-outline">
                                                <select class="form-control">
                                                    <option selected="">Lakh</option>
                                                    <option value="1"> Add qualification</option>
                                                    <option value="2"> Add qualification</option>
                                                    <option value="3"> Add qualification</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-outline">
                                                <select class="form-control">
                                                    <option selected="">Thousand</option>
                                                    <option value="1"> Add qualification</option>
                                                    <option value="2"> Add qualification</option>
                                                    <option value="3"> Add qualification</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-outline">
                                                <label>Current Location</label>
                                                <select class="form-control">
                                                    <option selected="">Add Job Location</option>
                                                    <option value="1"> Add qualification</option>
                                                    <option value="2"> Add qualification</option>
                                                    <option value="3"> Add qualification</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-outline">
                                            <label>Current Employer</label>
                                            <input type="text" class="form-control" placeholder="Add Employers Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-outline">
                                                <label>Notice Period</label>
                                                <select class="form-control">
                                                    <option selected="">1 Month</option>
                                                    <option value="1"> Add qualification</option>
                                                    <option value="2"> Add qualification</option>
                                                    <option value="3"> Add qualification</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-outline">
                                                <label>Active In</label>
                                                <select class="form-control">
                                                    <option selected="">1 Month</option>
                                                    <option value="1"> Add qualification</option>
                                                    <option value="2"> Add qualification</option>
                                                    <option value="3"> Add qualification</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group d-flex">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Save Search For Next Time
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary">Search and view result</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-5 job-post">
                        <div class="search-image">
                            <img src="{{ URL::asset(FRONTEND . '/assets/images/searchresume.svg') }}" alt="search" />
                        </div>
                        <h3>Resume search History</h3>
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
                                    <h4>Lead Engineer | Senior Lead Engineer Product Design Collins Aerospace and BIW design
                                        pune...</h4>
                                    <div class="similar-job-card-info">
                                        <p><span><img src="{{ URL::asset(FRONTEND . '/assets/images/briefccaseicon.svg') }}">
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
                                            <button type="button" class="btn btn-primary">Prefill</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="job-post-mail">post on 25 Apr, 2022 by Email : hr@isopara.com</span>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@stop
