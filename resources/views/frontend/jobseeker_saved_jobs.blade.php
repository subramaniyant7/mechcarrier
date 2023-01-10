@extends('frontend.layout')
@section('title', 'Job Search')
@section('content')

    <main>
        <div class="job-search-page">
            <div class="job-search-bg">

            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="searchfilter-sidebar">
                            <div class="searchfilter-dflex">
                                <p><span><img src="{{ URL::asset(FRONTEND . '/assets/images/filtericon.svg') }}" /></span>
                                    Filters</p>
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
                        <div class="jobsearch-title">
                            <h3>My saved jobs ( {{ count($savedJobs) }} )</h3>
                        </div>
                        <div class="recomended-jobs">
                            @forelse ($savedJobs as $savedJob)
                                @php
                                    $employerName = $stateName = $cityName = '';
                                    $companyLogo = FRONTEND . '/assets/images/company_logo.svg';
                                    $postInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getJobPostById($savedJob->user_saved_post_id);

                                    if (count($postInfo)) {
                                        $employerInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getEmployerInfoById($postInfo[0]->employer_post_employee_id);
                                        if (count($employerInfo)) {
                                            $employerName = $employerInfo[0]->employer_company_name;
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
                                    }
                                @endphp


                                <div class="job-card">
                                    <div class="job-card-title">
                                        <div class="d-flex">
                                            <h3>{{ $postInfo[0]->employer_post_headline }}</h3>
                                            <p> {{ $employerName }}</p>
                                        </div>
                                        <a
                                            href="{{ route('jobsdetails', ['id' => encryption($postInfo[0]->employer_post_id)]) }}"><img
                                                style="width:100px;height:50px;" src="{{ URL::asset($companyLogo) }}"></a>
                                    </div>
                                    <div class="job-card-details">
                                        <div class="job-card-info">
                                            <div class="years">
                                                <p><span><img
                                                            src="{{ URL::asset(FRONTEND . '/assets/images/briefccaseicon.svg') }}">
                                                    </span>

                                                    {{ SalaryLakhs()[$postInfo[0]->employer_post_experience_from - 1] }}-{{ SalaryLakhs()[$postInfo[0]->employer_post_experience_to - 1] }}
                                                    Years
                                                </p>
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

                                            <div class="location">
                                                <p><span><img
                                                            src="{{ URL::asset(FRONTEND . '/assets/images/mappinicon.svg') }}">
                                                    </span>{{ $cityName }}</p>
                                            </div>

                                        </div>
                                        <div class="job-posted-date">
                                            <h4>Posted :
                                                <span>{{ date('d M Y', strtotime($postInfo[0]->created_at)) }}</span>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="job-card-description">
                                        <p class="jobpost_desc searchdescription">
                                            {{ $postInfo[0]->employer_post_description }} </p>


                                        <span>{{ strlen($postInfo[0]->employer_post_description) > 311 ? 'more' : '' }}</span>
                                    </div>
                                    <div class="job-card-apply">
                                        <h4><img src="{{ URL::asset(FRONTEND . '/assets/images/filetexticon.svg') }}"> Key
                                            skill
                                            : <span class="skills">{{ $postInfo[0]->employer_post_key_skils }}</span>
                                        </h4>
                                        <div class="job-card-button">
                                            <button type="button" class="btn btn-primary  bg-white">Remove</button>
                                            <button type="button" class="btn btn-primary">Apply</button>
                                        </div>
                                    </div>
                                </div>

                            @empty
                            @endforelse

                        </div>
                        <div class="pagination" style="display: none;">
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
