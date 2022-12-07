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
                                <form method="GET" action="">
                                    <div class="d-flex">
                                        <input type="text" name="skil" class="form-control" required
                                            placeholder="Search job by skill, description"
                                            value="{{ request()->get('skil') }}">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                    <div style="display: flex">
                                        @php
                                            $cityName = '';
                                            if (request()->get('location') != '') {
                                                $cityInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getCityInfo(request()->get('location'));
                                                if (count($cityInfo)) {
                                                    $cityName = $cityInfo[0]->city_name;
                                                }
                                            }
                                        @endphp
                                        <div style="position:relative;width:80%;margin-right:2em;"
                                            class="autocomplete_ui_parent">
                                            <input type="text" placeholder="Search Location"
                                                class="form-control autocomplete_actual_id location"
                                                value="{{ $cityName }}" />
                                            <input type="hidden" class="autocomplete_id" name="location"
                                                value="{{ request()->get('location') }}">
                                            <div class="autocomplete-items" style="display:none"></div>
                                        </div>
                                        <select class="form-control" name="experience" style="width:50%;">
                                            <option value="">Select</option>
                                            @foreach (experienceGap() as $k => $experience)
                                                <option value={{ $k + 1 }}
                                                    {{ request()->get('experience') == $k + 1 ? 'selected' : '' }}>
                                                    {{ $experience }} Years</option>
                                            @endforeach
                                        </select>
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
                                <p><span><img src="{{ URL::asset(FRONTEND . '/assets/images/filtericon.svg') }}" /></span>
                                    Filters</p>
                                <h4>Clear all</h4>
                            </div>
                            <div class="searchfilters-list">
                                <h4>Job type </h4>
                                <ul>
                                    @foreach (employmentType() as $k => $employment)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input employment_type" name="employment_type"
                                                    type="checkbox" value="{{ $k + 1 }}">
                                                <label class="form-check-label">
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
                                    @foreach (typeOfCompany() as $p => $type)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $p }}"
                                                    id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    {{ $type }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="searchfilters-list">
                                <h4>Experience</h4>
                                <ul>
                                    @foreach (experienceGap() as $l => $experiencegap)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $l }}"
                                                    id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    {{ $experiencegap }} Years
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="searchfilters-list">
                                <h4>Education</h4>
                                <ul>
                                    @foreach (getActiveRecord('education_info') as $education_info)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $education_info->education_id }}" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    {{ $education_info->education_name }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="recomended-jobs">
                            @forelse ($skilMatchJobs as $skilMatchJob)
                                <div class="job-card">
                                    @php
                                        $employerName = $stateName = $cityName = '';
                                        $companyLogo = FRONTEND . '/assets/images/company_logo.svg';
                                        $employerInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getEmployerInfoById($skilMatchJob['employer_post_employee_id']);
                                        if (count($employerInfo)) {
                                            $employerName = $employerInfo[0]->employer_company_name;
                                            $companyLogo = $employerInfo[0]->employer_company_logo != '' ? '/uploads/employer/company/' . $employerInfo[0]->employer_company_logo : $companyLogo;
                                        }

                                        $stateInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getStateById($skilMatchJob['employer_post_location_state']);
                                        if (count($stateInfo)) {
                                            $stateName = $stateInfo[0]->state_name;
                                        }
                                        $cityInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getCityInfo($skilMatchJob['employer_post_location_city']);
                                        if (count($cityInfo)) {
                                            $cityName = $cityInfo[0]->city_name;
                                        }
                                    @endphp
                                    <div class="job-card-title">
                                        <div class="d-flex">
                                            <h3>{{ $skilMatchJob['employer_post_headline'] }}</h3>
                                            <p> {{ $employerName }}</p>
                                        </div>
                                        <img style="width:10%;height:50px;" src="{{ URL::asset($companyLogo) }}">
                                    </div>
                                    <div class="job-card-details">
                                        <div class="job-card-info">
                                            <div class="years">
                                                <p><span><img
                                                            src="{{ URL::asset(FRONTEND . '/assets/images/briefccaseicon.svg') }}">
                                                    </span>{{ experienceGap()[$skilMatchJob['employer_post_experience'] - 1] }}
                                                </p>
                                            </div>

                                            <div class="location">
                                                <p><span><img
                                                            src="{{ URL::asset(FRONTEND . '/assets/images/mappinicon.svg') }}">
                                                    </span>{{ $stateName }}</p>
                                            </div>
                                            @if ($skilMatchJob['employer_post_hidesalary'] == 2)
                                                <div class="salary">
                                                    <p><span>
                                                            <img
                                                                src="{{ URL::asset(FRONTEND . '/assets/images/rupeeicon.svg') }}">
                                                        </span>{{ SalaryLakhs()[$skilMatchJob['employer_post_salary_range_from_lakhs'] - 1] }}
                                                        -{{ SalaryLakhs()[$skilMatchJob['employer_post_salary_range_to_lakhs'] - 1] }}
                                                        Lakhs
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="job-posted-date">
                                            <h4>Posted :
                                                <span>{{ date('d M Y', strtotime($skilMatchJob['created_at'])) }}</span>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="job-card-description">
                                        <p>{{ $skilMatchJob['employer_post_description'] }} <span>more</span></p>
                                    </div>
                                    <div class="job-card-apply">
                                        <h4><img src="{{ URL::asset(FRONTEND . '/assets/images/filetexticon.svg') }}"> Key
                                            skill
                                            : <span>{{ $skilMatchJob['employer_post_key_skils'] }}</span>
                                        </h4>
                                        <div class="job-card-button">
                                            <button type="button" class="btn btn-primary  bg-white">Save</button>
                                            <button type="button" class="btn btn-primary">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div>No Job Found</div>
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
