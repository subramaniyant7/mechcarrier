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
                            <form class="search_form" action="{{ route('employersearchresponse') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-outline">
                                            <label>Resume database name * <span>Its help you to find
                                                    later</span></label>
                                            <input type="text" class="form-control" name="employer_post_headline"
                                                placeholder="e.g. BIW design engineer 2 to 5 year seach - pune" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="background_design">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-outline">
                                                <label>All keyword *</label>
                                                <input type="text" class="form-control" name="employer_post_key_skils"
                                                    placeholder="Skill, designation role seperated by comma" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Total Year Experience *</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-outline">
                                                    <select class="form-control" name="employer_post_experience_from" required>
                                                        <option value="" selected=""> Minimum</option>
                                                        @foreach (SalaryLakhs() as $l => $lakh)
                                                            <option value="{{ $l + 1 }}">
                                                                {{ $lakh }} Year{{ $l > 0 ? 's' : '' }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-outline">
                                                    <select class="form-control" name="employer_post_experience_to" required>
                                                        <option value="" selected=""> Maximum</option>
                                                        @foreach (SalaryLakhs() as $l => $lakh)
                                                            <option value="{{ $l + 1 }}">
                                                                {{ $lakh }} Year{{ $l > 0 ? 's' : '' }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="show_advancedresume_search">
                                            <input class="advance_checkbox" type="checkbox">Advanced Search</span>
                                    </div>
                                </div>

                                <div class="advance_content">

                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-primary">Search and view result</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="col-md-5 job-post">

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
