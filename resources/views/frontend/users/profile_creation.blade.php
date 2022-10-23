@extends('frontend.layout')
@section('title', 'User Profile Creation')
<style>
    .form-buttons,
    .text_limit {
        display: none;
    }

    .hide {
        display: none !important;
    }

    .edit_headline,
    .pointer {
        cursor: pointer;
    }

    .disablemode {
        opacity: 0.5;
        pointer-events: none;
    }

    .key_hint {
        text-align: left;
        padding-top: 0.5em;
        font-size: 12px;
        display: none;
    }
</style>
@section('content')

    <main>
        <div class="profile-creation-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div class="profile-image">
                            @php
                                $profile = $userInfo['userDetails'][0]->user_profile_picture != '' ? 'uploads/users/profilepic/' . $userInfo['userDetails'][0]->user_profile_picture : FRONTEND . '/assets/images/profile_pic.svg';
                            @endphp
                            <img style="height: 90px; width: 56%;border-radius: 50%;" src="{{ URL::asset($profile) }}" />
                            <img onclick="{ $('.user_img').trigger('click'); }"
                                src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/camera.svg') }}" />
                            <h4>{{ $userInfo['userDetails'][0]->user_firstname . ' ' . $userInfo['userDetails'][0]->user_lastname }}
                            </h4>
                            <input type="file" class="user_img" name="user_profile" style="display:none;">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="profile-contact">
                            <ul>
                                <li class="phone"> <img
                                        src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/phone.svg') }}" />

                                    @php
                                        $mobileimg = $emailimg = 'alerticon';
                                        $mobileverifiedText = $emailverifiedText = 'verify';
                                        if ($userInfo['userDetails'][0]->user_email_verified == 1) {
                                            $emailimg = 'verifiedicon';
                                            $emailverifiedText = 'verified';
                                        }

                                        if ($userInfo['userDetails'][0]->user_phonenumber_verified == 1) {
                                            $mobileimg = 'verifiedicon';
                                            $mobileverifiedText = 'verified';
                                        }
                                    @endphp
                                    @if ($userInfo['userDetails'][0]->user_phonenumber != '')
                                        {{ $userInfo['userDetails'][0]->user_phonenumber }}
                                        <span>
                                            <img
                                                src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/' . $mobileimg . '.svg') }}" />
                                            {{ $mobileverifiedText }}
                                        </span>
                                    @endif
                                </li>
                                <li class="email"> <img
                                        src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/mail.svg') }}" />
                                    @if ($userInfo['userDetails'][0]->user_email != '')
                                        {{ $userInfo['userDetails'][0]->user_email }}
                                        <span>
                                            <img
                                                src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/' . $emailimg . '.svg') }}" />
                                            {{ $emailverifiedText }}
                                        </span>
                                    @endif
                                </li>
                                @if ($userInfo['userDetails'][0]->user_state != '')
                                    <li class="location"><img
                                            src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/location.svg') }}" />
                                        {{ $userInfo[0]->user_state }}
                                    </li>
                                @endif
                                @if (count($userInfo['userProfile']))
                                    @if ($userInfo['userProfile'][0]->user_total_experience_year != '')
                                        <li class="workexp"><img
                                                src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/workexp.svg') }}" />{{ $userInfo['userProfile'][0]->user_total_experience_year }}
                                            Years
                                            {{ $userInfo['userProfile'][0]->user_total_experience_month != 0 ? $userInfo['userProfile'][0]->user_total_experience_month . ' Months' : '' }}
                                        </li>
                                    @endif
                                @endif
                                @if (count($currentEmployment))
                                    @if ($currentEmployment[0]->user_employment_current_salary_lakh != '')
                                        <li class="deposit"><img
                                                src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/deposit.svg') }}" />
                                            {{ $currentEmployment[0]->user_employment_current_salary_lakh }} Lakhs
                                            {{ $currentEmployment[0]->user_employment_current_salary_thousand . ' Thousand' }}
                                            /
                                            Annum </li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                                        <div class="inside-circle"> 30% </div>
                                    </div>
                                </div>
                                <p>Profile Completed</p>
                                <h6> How to improve</h6>
                            </div>
                            <div class="user-progress">
                                <div class="circle-wrap">
                                    <div class="circle">
                                        <div class="mask full">
                                            <div class="fill"></div>
                                        </div>
                                        <div class="mask half">
                                            <div class="fill"></div>
                                        </div>
                                        <div class="inside-circle"> 30% </div>
                                    </div>
                                </div>
                                <p>Apply Limit</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-creation-body">
            <div class="profile-title">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Edit or create profile <span>( only complete profile recruiter shows intrest to view )
                                </span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-dashboard">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="profile-sidebar">
                                <h6>Profile Last Updated : 01 March, 2022</h6>
                                <h4>Quick Links</h4>
                                <ul>
                                    @foreach (getUserSidebar() as $k => $sidebar)
                                        <li>
                                            <img
                                                src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/sidebar' . ($k + 1) . '.svg') }}" />
                                            {{ $sidebar['name'] }}
                                            <span>
                                                @php
                                                    $verify = 'close';
                                                    if ($sidebar['key'] == 'resume' && count($userInfo['userProfile']) && $userInfo['userProfile'][0]->user_resume != '') {
                                                        $verify = 'check';
                                                    }

                                                    if ($sidebar['key'] == 'headline' && count($userInfo['userProfile']) && $userInfo['userProfile'][0]->user_resume_headline != '') {
                                                        $verify = 'check';
                                                    }

                                                    if ($sidebar['key'] == 'userKeySkils' && count($userInfo['userKeySkils'])) {
                                                        $verify = 'check';
                                                    }

                                                    if ($sidebar['key'] == 'userEmployments' && count($userInfo['userEmployments'])) {
                                                        $verify = 'check';
                                                    }

                                                    if ($sidebar['key'] == 'userEducations' && count($userInfo['userEducations'])) {
                                                        $verify = 'check';
                                                    }

                                                    if ($sidebar['key'] == 'profilesummary' && count($userInfo['userProfile']) && $userInfo['userProfile'][0]->user_resume_headline != '') {
                                                        $verify = 'check';
                                                    }

                                                    if ($sidebar['key'] == 'currentlocation' && count($userInfo['userDetails']) && $userInfo['userDetails'][0]->user_city != '') {
                                                        $verify = 'check';
                                                    }

                                                    if ($sidebar['key'] == 'totalexperience' && count($userInfo['userProfile']) && $userInfo['userProfile'][0]->user_total_experience_year != '') {
                                                        $verify = 'check';
                                                    }

                                                    if ($sidebar['key'] == 'userITSkils' && count($userInfo['userITSkils'])) {
                                                        $verify = 'check';
                                                    }

                                                    if ($sidebar['key'] == 'personadetail' && (count($userInfo['userLanguages']) && $userInfo['userDetails'][0]->user_gender != '' && $userInfo['userDetails'][0]->user_marital_status != '' && $userInfo['userDetails'][0]->user_dob != '' && $userInfo['userDetails'][0]->user_permanent_address != '' && $userInfo['userDetails'][0]->user_permanent_address_pin != '')) {
                                                        $verify = 'check';
                                                    }

                                                @endphp
                                                <img
                                                    src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/' . $verify . '.svg') }}" />
                                            </span>
                                        </li>
                                    @endforeach

                                </ul>

                            </div>

                        </div>
                        <div class="col-md-9">
                            @php
                                $resumeAvailable = count($userInfo['userProfile']) && $userInfo['userProfile'][0]->user_resume != '';
                            @endphp
                            <div class="profile-dashboard-content">
                                <div class="resume-upload">
                                    <div class="d-flex">
                                        <h4>Resume</h4>
                                        @if ($resumeAvailable)
                                            <a href="javascript:void(0)"
                                                data-id="{{ encryption(session('frontend_userid')) }}"
                                                class="delete_resume">Delete Resume </a>
                                        @endif

                                    </div>
                                    <p>Resume is the most important document recruiters look for Recruitment.</p>
                                    <form>
                                        <input type="file" class="resume_upload" name="uploadfile" id="Resume"
                                            style="display:none;">
                                        <label for="Resume">
                                            @if ($resumeAvailable)
                                                Update
                                            @else
                                                Upload
                                            @endif New Resume
                                        </label>
                                    </form>
                                    <div class="form-dflex">
                                        <span>Supported Format- doc, pdf, upto 2 MB </span>
                                        @if ($resumeAvailable)
                                            <a href="{{ route('downloadresume') }}">
                                                <img class="download_resume"
                                                    src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/download.svg') }}" />
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="resume-upload resume-headline">
                                    <div class="d-flex">
                                        <h4>Profile Headline </h4>
                                        <span class="edit_headline">
                                            <img
                                                src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/edit.svg') }}" />
                                            Edit</span>
                                    </div>
                                    @php
                                        $headline = count($userInfo['userProfile']) ? $userInfo['userProfile'][0]->user_resume_headline : '';
                                    @endphp
                                    <form action="#" id="update_resume_headline">
                                        <div class="text-left inline_text">{{ $headline }} </div>
                                        <textarea required class="inputinfo hide" name="user_resume_headline" rows="3" cols="30" minlength="10"
                                            maxlength="250"
                                            placeholder="Add Headline e.g : Design Engineer with 5.6 year experience in Automotive Plastic Product Design with 1 year BIW design.">{{ $headline }}</textarea>
                                        <span class="text_limit"> 0/250 </span>
                                        <div class="form-buttons">
                                            <button type="button" class="btn btn-cancel cancelaction">Cancel</button>
                                            <button type="submit" class="btn btn-save">Save</button>
                                        </div>
                                    </form>

                                </div>

                                <div class="resume-upload resume-headline keyskills">
                                    <div class="d-flex">
                                        <h4>Key Skills </h4>
                                        <span class="edit_headline"><img
                                                src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/edit.svg') }}" />
                                            Add</span>
                                    </div>
                                    @if (count($userInfo['userKeySkils']))
                                        <ul>
                                            @foreach ($userInfo['userKeySkils'] as $skil)
                                                <li>
                                                    {{ $skil->user_key_skil_text }}
                                                    <img class="pointer"
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/cancel.svg') }}"
                                                        onclick="removeKeySkil({{ $skil->user_key_skil_id }})" />
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <form action="#" id="create_keyskils">
                                        <input required type="text" minlength="4" maxlength="300"
                                            class="form-control inputinfo hide" name="key_skils"
                                            placeholder="Add Technical Skill ( maximum 10 or 300 charactors)" />
                                        <div class="key_hint">Note: Can add multiple skills with comma(,) separator</div>
                                        <div class="form-buttons">
                                            <button type="button" class="btn btn-cancel cancelaction">Cancel</button>
                                            <button type="submit" class="btn btn-save">Save</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="resume-upload resume-headline employement">
                                    <div class="d-flex">
                                        <h4>Employment </h4>
                                        <span class="create_employment pointer">
                                            <img
                                                src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/edit.svg') }}" />
                                            Add
                                        </span>
                                    </div>
                                    @if (count($userInfo['userEmployments']))
                                        @foreach ($userInfo['userEmployments'] as $employment)
                                            @php
                                                $fromMonth = date('M', strtotime(date('Y') . '-' . Months()[$employment->user_employment_joining_month - 1] . '-01'));
                                                $fromYear = Year()[$employment->user_employment_joining_year - 1];

                                                $toMonth = date('M', strtotime(date('Y') . '-' . Months()[$employment->user_employment_working_month - 1] . '-01'));

                                                $toYear = Year()[$employment->user_employment_working_year - 1];

                                                $datetime1 = new DateTime('1 ' . $fromMonth . ' ' . $fromYear);
                                                $datetime2 = new DateTime('1 ' . $toMonth . ' ' . $toYear);

                                                $interval = $datetime1->diff($datetime2);

                                                $months = $interval->format('%m') > 0 ? $interval->format('%m months') : '';
                                                $companyName = '';
                                                $getCompany = \App\Http\Controllers\Frontend\Helper\HelperController::getCompanyById($employment->user_employment_current_companyname);
                                                if (count($getCompany)) {
                                                    $companyName = $getCompany[0]->company_detail_name;
                                                }
                                            @endphp
                                            <div>
                                                <h5>
                                                    {{ $companyName }} -
                                                    {{ $employment->user_employment_type == 1 ? 'Full Time' : 'Part Time' }}
                                                    -
                                                    {{ $fromMonth }} {{ $fromYear }} to {{ $toMonth }}
                                                    {{ $toYear }} ({{ $interval->format('%y years') }}
                                                    {{ $months }})
                                                    <span class="edit_employment pointer">
                                                        <img data-id="{{ encryption($employment->user_employment_id) }}"
                                                            data-employment="{{ $employment->user_employment_id }}"
                                                            src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/edit.svg') }}" />
                                                        Edit
                                                    </span>
                                                </h5>
                                                @if ($employment->user_employment_description != '')
                                                    <p><span>Job Profile :</span>
                                                        {{ $employment->user_employment_description }}</p>
                                                @endif
                                            </div>
                                            <div class="edit_employment_content"
                                                id="employment_{{ $employment->user_employment_id }}"></div>
                                        @endforeach

                                    @endif
                                    <div class="action_employment"></div>
                                </div>

                                <div class="resume-upload resume-headline employement">
                                    <div class="d-flex">
                                        <h4>Education </h4>
                                        <span class="create_education pointer"><img
                                                src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/edit.svg') }}" />
                                            Add</span>
                                    </div>
                                    <div class="education-list">
                                        @if (count($userInfo['userEmployments']))
                                            @foreach ($userInfo['userEducations'] as $education)
                                                <h5> {{ education()[$education->user_education_primary_id - 1] }} :
                                                    {{ courses()[$education->user_education_course_id - 1] }} -
                                                    {{ specialization()[$education->user_education_specialization - 1] }} -
                                                    {{ Year()[$education->user_education_passed_year - 1] }}
                                                    <span class="edit_education pointer"
                                                        data-id="{{ encryption($education->user_education_id) }}"
                                                        data-education="{{ $education->user_education_id }}">
                                                        <img
                                                            src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/edit.svg') }}" />
                                                        Edit</span>
                                                </h5>
                                                <div class="edit_education_content"
                                                    id="education_{{ $education->user_education_id }}"></div>
                                            @endforeach

                                        @endif
                                    </div>
                                    <div class="action_education"></div>
                                </div>

                                <div class="resume-upload resume-headline current-location">
                                    <form class="current-location" action="#" id="current-location">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4>Current Location </h4>
                                                <select class="form-control custom_change" name="user_city" required
                                                    aria-label="Default select example">
                                                    <option selected value="">Select city</option>
                                                    @foreach (city() as $k => $city)
                                                        <option value="{{ $k + 1 }}"
                                                            {{ count($userInfo['userDetails']) && $userInfo['userDetails'][0]->user_city == $k + 1 ? 'selected' : '' }}>
                                                            {{ $city }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4>Preferred Job Location </h4>
                                                <div class="d-flex">
                                                    <select class="form-control custom_change"
                                                        name="user_preferred_location" required
                                                        aria-label="Default select example">
                                                        <option selected value="">Select city</option>
                                                        @foreach (city() as $k => $city)
                                                            <option value="{{ $k + 1 }}"
                                                                {{ count($userInfo['userProfile']) && $userInfo['userProfile'][0]->user_preferred_location == $k + 1 ? 'selected' : '' }}>
                                                                {{ $city }}</option>
                                                        @endforeach
                                                    </select>
                                                    {{-- <select class="form-control custom_change"
                                                        name="user_total_experience_year" required
                                                        aria-label="Default select example">
                                                        <option selected value="">Year</option>
                                                        @foreach (experience() as $k => $experience)
                                                            <option value="{{ $k + 1 }}"
                                                                {{ count($userInfo['userProfile']) && $userInfo['userProfile'][0]->user_total_experience_year == $k + 1 ? 'selected' : '' }}>
                                                                {{ $experience }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <select class="form-control custom_change"
                                                        name="user_total_experience_month" required
                                                        aria-label="Default select example">
                                                        <option selected value="">Month</option>
                                                        @foreach (Months() as $k => $month)
                                                            <option value="{{ $k + 1 }}"
                                                                {{ count($userInfo['userProfile']) && $userInfo['userProfile'][0]->user_total_experience_month == $k + 1 ? 'selected' : '' }}>
                                                                {{ $month }}
                                                            </option>
                                                        @endforeach
                                                    </select> --}}
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-buttons">
                                                    <button type="button" class="btn btn-cancel">Cancel</button>
                                                    <button type="submit" class="btn btn-save">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="resume-upload resume-headline employement">
                                    <div class="d-flex">
                                        <h4>IT skill </h4>
                                        <span class="create_itskill pointer"><img
                                                src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/edit.svg') }}" />
                                            Add</span>
                                    </div>
                                    <div class="education-list">
                                        @if (count($userInfo['userITSkils']))
                                            @foreach ($userInfo['userITSkils'] as $itskil)
                                                <div>
                                                    <h5>{{ $itskil->user_itskil_skil_name }} - Experience-
                                                        {{ experience()[$itskil->user_itskil_experience_year - 1] }}
                                                        year
                                                        <span class="edit_itskill pointer"
                                                            data-id="{{ encryption($itskil->user_itskil_id) }}"
                                                            data-itskill="{{ $itskil->user_itskil_id }}">
                                                            <img
                                                                src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/edit.svg') }}" />
                                                            Edit</span>
                                                    </h5>
                                                </div>
                                                <div class="edit_itskill_content"
                                                    id="itskill_{{ $itskil->user_itskil_id }}"></div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="action_itskill"></div>
                                </div>

                                <div class="resume-upload resume-headline employement personal-details">
                                    <div class="d-flex">
                                        <h4>Personal Details </h4>
                                        <span class="action_personaldetails pointer">
                                            <img
                                                src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/edit.svg') }}" />
                                            Add/edit</span>
                                    </div>
                                    <div class="education-list">
                                        <ul>
                                            <li>Personal :
                                                <span>{{ $userInfo['userDetails'][0]->user_gender != ''
                                                    ? Gender()[$userInfo['userDetails'][0]->user_gender - 1] . ' ,'
                                                    : '-' }}
                                                    {{ $userInfo['userDetails'][0]->user_marital_status != '' ? Maritual()[$userInfo['userDetails'][0]->user_marital_status - 1] : '' }}</span>
                                            </li>
                                            <li>Date of Birth : <span>
                                                    {{ $userInfo['userDetails'][0]->user_dob != '' ? date('d F Y', strtotime($userInfo['userDetails'][0]->user_dob)) : '-' }}
                                                </span> </li>
                                            <li>Work Permit : <span> Germeny</span> </li>
                                        </ul>
                                        <p>Address : <span>
                                                {{ $userInfo['userDetails'][0]->user_permanent_address != ''
                                                    ? $userInfo['userDetails'][0]->user_permanent_address . ','
                                                    : '-' }}
                                                {{ $userInfo['userDetails'][0]->user_permanent_address_pin }}</span> </p>

                                        @if (count($userInfo['userLanguages']))
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Languages : </th>
                                                        <th>Proficiency </th>
                                                        <th>Read</th>
                                                        <th>Write</th>
                                                        <th>Speak</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($userInfo['userLanguages'] as $language)
                                                        @php
                                                            $read = $language->user_language_read == 1 ? 'tablecheck.svg' : 'cancel.svg';
                                                            $write = $language->user_language_write == 1 ? 'tablecheck.svg' : 'cancel.svg';
                                                            $speak = $language->user_language_speak == 1 ? 'tablecheck.svg' : 'cancel.svg';
                                                        @endphp
                                                        <tr>
                                                            <td>{{ language()[$language->user_language_primary_id - 1] }}
                                                            </td>
                                                            <td>{{ languageStrength()[$language->user_language_proficiency - 1] }}
                                                            </td>
                                                            <td><img
                                                                    src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/' . $read) }}" />
                                                            </td>
                                                            <td><img
                                                                    src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/' . $write) }}" />
                                                            </td>
                                                            <td><img
                                                                    src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/' . $speak) }}" />
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        @endif
                                        <div class="action_personaldetailsdata"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>



    </main>


@stop
