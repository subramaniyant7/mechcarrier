@extends('frontend.employer.layout')
@section('title', 'Preview Job Post ')

@section('content')
    @php
        $location = $employerName = $designation = $employmentType = $qualification = $industry = $department = '';
        $companyLogo = URL::asset(FRONTEND . '/assets/images/company_logo.svg');
        $employerInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getEmployerById($employerPostInfo[0]->employer_post_employee_id);
        if (count($employerInfo)) {
            $employerName = $employerInfo[0]->employer_company_name;
            $companyLogo = URL::asset('uploads/employer/company/' . $employerInfo[0]->employer_company_logo);
        }

        $cityInfo = explode(',', $employerPostInfo[0]->employer_post_location_city);
        foreach ($cityInfo as $k => $city) {
            $cityDetails = \App\Http\Controllers\Frontend\Helper\HelperController::getCityById($city);
            if (count($cityDetails)) {
                $location .= $cityDetails[0]->city_name . (count($cityInfo) != $k + 1 ? ',' : '');
            }
        }
        $designationInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getDesignationById($employerPostInfo[0]->employer_post_designation);

        $designation = count($designationInfo) ? $designationInfo[0]->designation_name : $employerPostInfo[0]->employer_post_designation;

        $employmentTypeInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getEmploymentTypeId($employerPostInfo[0]->employer_post_employement_type);
        if (count($employmentTypeInfo)) {
            $employmentType = $employmentTypeInfo[0]->employmenttype_name;
        }
        $skils = explode(',', $employerPostInfo[0]->employer_post_key_skils);

        $qualificationInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getEducationById($employerPostInfo[0]->employer_post_qualification);
        if (count($qualificationInfo)) {
            $qualification = $qualificationInfo[0]->education_name;
        }

        $industry = $employerPostInfo[0]->employer_post_industry_name;
        if ($employerPostInfo[0]->employer_post_industry_name == '') {
            $industryInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getIndutryById($employerPostInfo[0]->employer_post_industry_type);
            $industry = count($industryInfo) ? $industryInfo[0]->industry_name : $industry;
        }

        $department = $employerPostInfo[0]->employer_post_department_name;
        if ($employerPostInfo[0]->employer_post_department_name == '') {
            $departmentInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getDepartmentById($employerPostInfo[0]->employer_post_department);
            $department = count($departmentInfo) ? $departmentInfo[0]->department_name : $department;
        }

    @endphp
    <main>
        <div class="job-post-previews">
            <div class="breadcrumbs-bg"></div>
            <div class="job-post-previews-main">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="recomended-jobs">
                                <div class="job-card">
                                    <div class="job-card-title">
                                        <div class="d-flex">
                                            <h3>{{ $employerPostInfo[0]->employer_post_headline }}</h3>
                                            <p> {{ $employerName }}</p>
                                        </div>
                                        <img style="width:100px;height:50px;" src="{{ $companyLogo }}">
                                    </div>
                                    <div class="job-card-details">
                                        <div class="job-card-info">
                                            <div class="years">
                                                <p><span><img
                                                            src="{{ URL::asset(FRONTEND . '/assets/images/briefccaseicon.svg') }}">
                                                    </span>
                                                    {{ SalaryLakhs()[$employerPostInfo[0]->employer_post_experience_from-1] }}-{{ SalaryLakhs()[$employerPostInfo[0]->employer_post_experience_to-1] }}
                                                    Years
                                                </p>
                                            </div>
                                            <div class="location">
                                                <p><span><img
                                                            src="{{ URL::asset(FRONTEND . '/assets/images/mappinicon.svg') }}">
                                                    </span>{{ $location }}
                                                </p>
                                            </div>
                                            <div class="salary">
                                                <p><span><img
                                                            src="{{ URL::asset(FRONTEND . '/assets/images/rupeeicon.svg') }}">
                                                    </span>{{ SalaryLakhs()[$employerPostInfo[0]->employer_post_salary_range_from_lakhs-1] }}-{{ SalaryLakhs()[$employerPostInfo[0]->employer_post_salary_range_to_lakhs-1] }}
                                                    Lakhs</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="job-card-designation">
                                        <ul>
                                            <li>Job Role ( Designation ) : {{ $designation }}</li>
                                            <li>Job Type: {{ $employmentType }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="key-skills">
                                <h3> Skill Keywords</h3>
                                <ul>
                                    @foreach ($skils as $skil)
                                        <li>{{ $skil }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="job-description">
                                <h3>Job description</h3>
                                {{ $employerPostInfo[0]->employer_post_description }}

                                <br />
                                <div class="education-details">
                                    <div class="d-flex">
                                        <p><span>Education <span>:</span></span> </p>
                                        <p>{{ $qualification }} </p>
                                    </div>
                                    <div class="d-flex">
                                        <p><span>Industry Type <span>:</span></span> </p>
                                        <p>{{ $industry }} </p>
                                    </div>
                                    <div class="d-flex">
                                        <p><span>Department <span>:</span></span> </p>
                                        <p>{{ $department }}</p>
                                    </div>
                                    <div class="d-flex">
                                        <p><span>No. of vacancies <span>:</span></span> </p>
                                        <p>{{ $employerPostInfo[0]->employer_post_vacancies }} </p>
                                    </div>
                                </div>
                                @if ($employerPostInfo[0]->employer_post_walkin == 1)
                                    <div class="walk-in-details">
                                        <h3>Walk-in Details : </h3>
                                        <div class="d-flex">
                                            <p><span>Date <span>:</span></span> </p>
                                            <p> 27 Dec, 2023 ( Monday ) </p>
                                        </div>
                                        <div class="d-flex">
                                            <p><span>Time <span>:</span></span> </p>
                                            <p>{{ $employerPostInfo[0]->employer_post_walkin_time_from }} to
                                                {{ $employerPostInfo[0]->employer_post_walkin_time_to }}</p>
                                        </div>
                                        <div class="d-flex">
                                            <p><span>Address <span>:</span></span> </p>
                                            <p>
                                                {{ $employerPostInfo[0]->employer_post_walkin_address }}
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                @if ($employerPostInfo[0]->employer_post_external == 1)
                                    <div class="external-apply-link">
                                        <h3> External apply link :</h3>
                                        <a href="{{ $employerPostInfo[0]->employer_post_apply_link }}"
                                            target="_blank">{{ $employerPostInfo[0]->employer_post_apply_link }}</a>
                                    </div>
                                @endif
                            </div>
                            <form action="{{ route('publishemployerjobpost') }}" id="job_publish" method="POST">
                                @csrf
                                <input type="hidden" name="employer_post_id"
                                    value="{{ encryption($employerPostInfo[0]->employer_post_id) }}">

                                <div class="job-post-previews-button">
                                    <div class="d-flex">
                                        <a style="margin-right:10px;"
                                            href="{{ route('employerjobpost') . '?mode=edit&id=' . encryption($employerPostInfo[0]->employer_post_id) }}"
                                            class="btn btn-primary">Edit</a>
                                        <button type="submit" id="publish_btn" class="btn-primary">Publish</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

@stop

