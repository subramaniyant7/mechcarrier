@extends('frontend.employer.layout')
@section('title', 'Employer Job Post')
@section('content')

    <main>
        <div class="job-post">
            <div class="container job-post-title">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Create new job post <br /> or refile from history
                        </h1>
                    </div>
                    <div class="col-md-3">
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
                                        <div class="inside-circle"> 2/3 </div>
                                    </div>
                                </div>
                                <p>Job post quota - <span>add quota</span> </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <img src="{{ URL::asset(FRONTEND . '/assets/images/jobpost.svg') }}" />
                    </div>
                </div>
                <hr />
            </div>
            <div class="container job-post-main">
                <div class="row">
                    <div class="col-md-7">
                        @include('admin.notification')
                        <div class="form">
                            <form id="employer_post" action="{{ route('saveemployerjobpost') }}" methos="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-outline">
                                            <label>Job posting headline *</label>
                                            <input type="text" class="form-control" name="employer_post_headline"
                                                required placeholder="Add title which describe job role "
                                                value="{{ old('employer_post_headline') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-outline">
                                                <label>Employment type *</label>
                                                <select class="form-control" name="employer_post_employement_type" required>
                                                    <option selected="" value="">Select</option>
                                                    @foreach (employmentType() as $k => $employmentType)
                                                        <option value="{{ $k + 1 }}">{{ $employmentType }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group relative">
                                            <label>Job Description *</label>
                                            <textarea name="employer_post_description" required rows="5" minlength="10" maxlength="1000"
                                                placeholder="Describe activities in this job role " class="form-control">{{old('employer_post_description')}}</textarea>
                                            <div class="counter" id="the-count" style="font-weight: normal;">
                                                <span id="current" style="color: rgb(102, 102, 102);">0</span>
                                                <span id="maximum" style="color: rgb(102, 102, 102);">/ 1000</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-outline">
                                            <label>Key Skill *</label>
                                            <input type="text" required name="employer_post_key_skils"
                                                class="form-control" value="{{ old('employer_post_key_skils') }}"
                                                placeholder="  Add minimum 5 for better targeting candidates ( max 100 charactors )">
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-outline">
                                                <label>Educational Qualification *</label>
                                                <select class="form-control" name="employer_post_qualification" required>
                                                    <option selected="" value=""> Add qualification</option>
                                                    @foreach (education() as $k => $education)
                                                        <option value="{{ $k + 1 }}">{{ $education }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 d-flex">
                                        <p>salary range *</p>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    name="employer_post_hidesalary" >
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Hide from candidates
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="form-outline">
                                                <select class="form-control" name="employer_post_salary_range_from_lakhs"
                                                    required>
                                                    <option selected="" value="">Select</option>
                                                    @foreach (SalaryLakhs() as $l => $lakh)
                                                        <option value="{{ $l + 1 }}">
                                                            {{ $lakh }} Lakh{{ $l > 0 ? 's' : '' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-outline">
                                                <select class="form-control"
                                                    name="employer_post_salary_range_from_thousands" required>
                                                    <option selected="" value="">Select</option>
                                                    @foreach (SalaryThousands() as $k => $thousand)
                                                        <option value="{{ $k + 1 }}">
                                                            {{ $thousand }} Thousand</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <p>To</p>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="form-outline">
                                                <select class="form-control" name="employer_post_salary_range_to_lakhs"
                                                    required>
                                                    <option selected="" value="">Select</option>
                                                    @foreach (SalaryLakhs() as $l => $lakh)
                                                        <option value="{{ $l + 1 }}">
                                                            {{ $lakh }} Lakh{{ $l > 0 ? 's' : '' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-outline">
                                                <select class="form-control"
                                                    name="employer_post_salary_range_to_thousands" required>
                                                    <option selected="" value="">Select</option>
                                                    @foreach (SalaryThousands() as $k => $thousand)
                                                        <option value="{{ $k + 1 }}">
                                                            {{ $thousand }} Thousand</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Job Location *</label>
                                            <input type="text" name="employer_post_locations" required
                                                class="form-control" value="{{ old('employer_post_locations') }}" placeholder="Add job location ( maximum 3 ) ">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Add walkin details ( if need )</label>
                                            <input type="text" name="employer_post_walkin_details" value="{{ old('employer_post_walkin_details') }}"
                                                class="form-control" placeholder="   Add date, time and address">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="employer_post_save_status" value="1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button style="display:none" id="employer_post_submit" type="submit">Save</button>
                                            <button id="employer_post_save" type="button" class="btn btn-primary">Save</button>
                                            <button id="employer_post_save_publish" type="button" class="btn btn-primary">Save and publish</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <h3>Job post / saved history</h3>
                        <div class="similar-jobs">
                            <div class="form">
                                <form>
                                    <div class="form-group">
                                        <input type="text" placeholder="Search from history" class="form-control" />
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


                            <div class="pagination">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination pg-blue justify-content-center">
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
            </div>
        </div>
    </main>

@stop
