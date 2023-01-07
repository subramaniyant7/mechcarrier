@extends('frontend.layout')
@section('title', 'Job Search')
@section('content')
    <main>
        @php
            $industryInfo = getActiveRecord('industry');
            $departmentInfo = getActiveRecord('department');
        @endphp
        <div class="job-search-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="user-dasboard-form">
                            <div class="form-dflex">
                                <form method="GET" action="">
                                    <div class="d-flex skillsearch">
                                        <input type="text" name="skil" class="form-control" required
                                            placeholder="Search job by skill, description"
                                            value="{{ request()->get('skil') }}">
                                        <button type="submit" style="display: {{ request()->get('advance') == 1 ? 'none' : 'block' }};" class="btn btn-primary">Search</button>
                                    </div>
                                    <div style="margin-bottom: 42px;">
                                        @php
                                            $cityName = '';
                                            if (request()->get('location') != '') {
                                                $cityInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getCityInfo(request()->get('location'));
                                                if (count($cityInfo)) {
                                                    $cityName = $cityInfo[0]->city_name;
                                                }
                                            }
                                        @endphp
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div style="position:relative;margin-right:2em;width:100%;"
                                                    class="autocomplete_ui_parent">
                                                    <input type="text" placeholder="Search Location"
                                                        class="form-control autocomplete_actual_id location"
                                                        value="{{ $cityName }}" />
                                                    <input type="hidden" class="autocomplete_id" name="location"
                                                        value="{{ request()->get('location') }}">
                                                    <div class="autocomplete-items" style="display:none"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control" name="experience">
                                                    <option value="">Select Experience</option>
                                                    @foreach (experienceGap() as $k => $experience)
                                                        <option value={{ $k + 1 }}
                                                            {{ request()->get('experience') == $k + 1 ? 'selected' : '' }}>
                                                            {{ $experience }} Years</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="advanced_search" style="display: {{ request()->get('advance') == 1 ? 'block' : 'none' }};">
                                        <input type="hidden" name="advance" class="advance_input">
                                        <div class="row" style="margin-bottom: 42px;">
                                            <div class="col-md-6">
                                                <select class="form-control" name="industry">
                                                    <option value="">Select Industry</option>
                                                    @foreach ($industryInfo as $k => $industry)
                                                        <option value={{ $industry->industry_id }}
                                                            {{ request()->get('industry') == $industry->industry_id ? 'selected' : '' }}>
                                                            {{ $industry->industry_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <select class="form-control" name="department">
                                                    <option value="">Select Department</option>
                                                    @foreach ($departmentInfo as $k => $department)
                                                        <option value={{ $department->department_id }}
                                                            {{ request()->get('department') == $department->department_id ? 'selected' : '' }}>
                                                            {{ $department->department_name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="row" style="margin-bottom: 42px;">
                                            <div class="col-md-6">
                                                <select class="form-control" name="type">
                                                    <option value="">Select Type</option>
                                                    @foreach (typeOfCompany() as $k => $type)
                                                        <option value={{ $k + 1 }}
                                                            {{ request()->get('type') == $k + 1 ? 'selected' : '' }}>
                                                            {{ $type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button style="background-color: #1D56BB;border-color: #1D56BB;width: 100%;margin-bottom:16px;"
                                                    class="btn btn-primary" type="submit">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="show_advanced_search" style="color: #1d56bb;cursor: pointer;display: {{ request()->get('advance') == 1 ? 'none' : 'block' }};">Advanced Search</span>
                                    <span class="show_default_search" style="color: #1d56bb;cursor: pointer;display: {{ request()->get('advance') == 1 ? 'block' : 'none' }};">Default Search</span>
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
                                                    {{ request()->get('emptype') == $employment->employmenttype_id ? 'checked' : '' }}>
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
                                <ul>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input walkin_post" type="checkbox" name="walkin_post"
                                                value="" {{ request()->get('walkin') == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                Show only walkin
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="searchfilters-list">
                                <h4>Job posted at</h4>
                                <ul>
                                    @foreach (jobPostRange() as $j => $jobpostrange)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input search" type="checkbox"
                                                    value="{{ $jobpostrange }}" name="post_range"
                                                    {{ request()->get('post_range') == $jobpostrange ? 'checked' : '' }}>
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
                                                    value="{{ $p + 1 }}" id="defaultCheck1" name="type"
                                                    {{ request()->get('type') == $p + 1 ? 'checked' : '' }}>
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
                                                    value="{{ $s + 1 }}" id="defaultCheck1" name="salary"
                                                    {{ request()->get('salary') == $s + 1 ? 'checked' : '' }}>
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
                                                    value="{{ $l + 1 }}" id="defaultCheck1" name="experience"
                                                    {{ request()->get('experience') == $l + 1 ? 'checked' : '' }}>
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
                                                        value="{{ $education_info->education_id }}" name="education"
                                                        {{ request()->get('education') == $education_info->education_id ? 'checked' : '' }}>
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
                                <ul class="rootclass {{ count($industryInfo) > 4 ? 'expand restrictclass' : '' }}">
                                    @foreach ($industryInfo as $k => $industry)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input search" type="checkbox"
                                                    value="{{ $industry->industry_id }}" name="industry"
                                                    {{ request()->get('industry') == $industry->industry_id ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    style="text-overflow: ellipsis;
                                                white-space: nowrap;
                                                overflow: hidden;
                                                width: 255px;">
                                                    {{ $industry->industry_name }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                                @if (count($industryInfo) > 4)
                                    <span>more</span>
                                @endif
                            </div>

                            <div class="searchfilters-list" style="position: relative">
                                <h4>Department</h4>
                                <ul class="rootclass {{ count($departmentInfo) > 4 ? 'expand restrictclass' : '' }}">
                                    @foreach ($departmentInfo as $k => $department)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input search" type="checkbox"
                                                    value="{{ $department->department_id }}" name="department"
                                                    {{ request()->get('department') == $department->department_id ? 'checked' : '' }}>
                                                <label class="form-check-label">
                                                    {{ $department->department_name }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                                @if (count($departmentInfo) > 4)
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
