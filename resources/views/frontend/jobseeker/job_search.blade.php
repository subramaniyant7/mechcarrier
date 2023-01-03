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
                        <div class="searchfilter-dflex">
                            <p><span><img src="{{ URL::asset(FRONTEND . '/assets/images/filtericon.svg') }}" /></span>
                                Filters</p>
                            <h4>Clear all</h4>
                        </div>
                        <div class="searchfilter-sidebar">

                            <div class="searchfilters-list">
                                <h4>Employment type </h4>
                                <ul>
                                    @foreach (getActiveRecord('employmenttype') as $employment)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input search" name="emptype" type="checkbox"
                                                    value="{{ $employment->employmenttype_id }}"
                                                    {{ request()->get('type') == $employment->employmenttype_id ? 'checked' : '' }}>
                                                <label class="form-check-label">
                                                    {{ $employment->employmenttype_name }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="searchfilters-list" style="margin-bottom: 20px;">
                                <h4>Walkin </h4>
                                <div class="form-check">
                                    <input class="form-check-input walkin_post" type="checkbox" name="walkin_post"
                                        value="" {{ request()->get('walkin') == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                        Show only walkin
                                    </label>
                                </div>
                            </div>
                            <div class="searchfilters-list">
                                <h4>Job posted at</h4>
                                <ul>
                                    @foreach (jobPostRange() as $j => $jobpostrange)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input search" type="checkbox"
                                                    value="{{ $j + 1 }}" name="post_range"
                                                    {{ request()->get('post_at') == $j + 1 ? 'checked' : '' }}>
                                                <label class="form-check-label">
                                                    Last {{ $jobpostrange }} days
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
                                                <input class="form-check-input search" type="checkbox"
                                                    value="{{ $p }}" id="defaultCheck1" name="type">
                                                <label class="form-check-label">
                                                    {{ $type }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="searchfilters-list">
                                <h4>Salary</h4>
                                <ul>
                                    @foreach (salaryRange() as $s => $salaryrange)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input search" type="checkbox"
                                                    value="{{ $s + 1 }}" id="defaultCheck1" name="salary">
                                                <label class="form-check-label">
                                                    {{ $salaryrange }} Lakhs
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
                                                <input class="form-check-input search" type="checkbox"
                                                    value="{{ $l }}" id="defaultCheck1" name="experience">
                                                <label class="form-check-label">
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
                                    @foreach (getActiveRecord('education_info') as $k => $education_info)
                                        @if ($k > 1)
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input search" type="checkbox"
                                                        value="{{ $education_info->education_id }}" name="education">
                                                    <label class="form-check-label">
                                                        {{ $education_info->education_name }}
                                                    </label>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>

                            <div class="searchfilters-list" style="position: relative">
                                <h4>Industry Type</h4>
                                <ul class="rootclass {{ count(getActiveRecord('industry')) > 4 ? 'expand restrictclass' : '' }}">
                                    @foreach (getActiveRecord('industry') as $k => $industry)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input search" type="checkbox"
                                                    value="{{ $industry->industry_id }}" name="industry">
                                                <label class="form-check-label" style="text-overflow: ellipsis;
                                                white-space: nowrap;
                                                overflow: hidden;
                                                width: 255px;">
                                                    {{ $industry->industry_name }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                                @if (count(getActiveRecord('industry')) > 4)
                                <span>more</span>
                            @endif
                            </div>

                            <div class="searchfilters-list" style="position: relative">
                                <h4>Department</h4>
                                <ul
                                    class="rootclass {{ count(getActiveRecord('department')) > 4 ? 'expand restrictclass' : '' }}">
                                    @foreach (getActiveRecord('department') as $k => $department)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input search" type="checkbox"
                                                    value="{{ $department->department_id }}" name="department">
                                                <label class="form-check-label">
                                                    {{ $department->department_name }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                                @if (count(getActiveRecord('department')) > 4)
                                    <span>more</span>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="job_list">
                            @include('frontend.jobseeker.recommended_jobs')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

@stop
