<form id="employer_post" action="{{ route('saveemployerjobpost') }}" method="POST" autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-outline">
                <label>Job Post Headline *</label>
                <input type="text" class="form-control" name="employer_post_headline" required autocomplete="off"
                    placeholder="Add title which describe job role"
                    value="{{ isset($jobPost) ? $jobPost[0]->employer_post_headline : old('employer_post_headline') }}">
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-outline">
                    <label>Employment Type *</label>
                    <select class="form-control" name="employer_post_employement_type" required>
                        <option selected="" value="">Select</option>
                        @foreach (getActiveRecord('employmenttype') as $employmentType)
                            <option value="{{ $employmentType->employmenttype_id }}"
                                {{ isset($jobPost) && $jobPost[0]->employer_post_employement_type == $employmentType->employmenttype_id ? 'selected' : '' }}>
                                {{ $employmentType->employmenttype_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-outline">
                    <label>Job Type *</label>
                    <select class="form-control" name="employer_post_job_type" required>
                        <option selected="" value="">Select</option>
                        @foreach (jobType() as $k => $jobtype)
                            <option value="{{ $k + 1 }}"
                                {{ isset($jobPost) && $jobPost[0]->employer_post_job_type == $k + 1 ? 'selected' : '' }}>
                                {{ $jobtype }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="background">
                <div class="form-group relative">
                    <label>Job Description *</label>
                    <textarea onInput="handleInput(event)" autocomplete="off" name="employer_post_description" required rows="5"
                        minlength="10" maxlength="1000" placeholder="Describe activities in this job role " class="form-control">{{ isset($jobPost) ? $jobPost[0]->employer_post_description : old('employer_post_description') }}</textarea>
                    <div class="counter" id="the-count" style="font-weight: normal;">
                        <span id="current"
                            style="color: rgb(102, 102, 102);">{{ isset($jobPost) ? strlen($jobPost[0]->employer_post_description) : 0 }}</span>
                        <span id="maximum" style="color: rgb(102, 102, 102);">/ 1000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="background">
                <div class="pb-10">
                    <label>Skill Keywords*</label>
                    <input autocomplete="off" type="text" required name="employer_post_key_skils"
                        class="form-control"
                        value="{{ isset($jobPost) ? $jobPost[0]->employer_post_key_skils : old('employer_post_key_skils') }}"
                        placeholder="Add minimum 5 for better targeting candidates ( max 200 charactors )"
                        maxlength="200">
                    <div class="key_hint">Note: Can add mutiple skills with comma(,) separator</div>
                </div>
            </div>
        </div>
    </div>

    @php
        $educationInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getEducationInfo();
    @endphp
    <div class="background">
        <div class="row">
            <div class="col-md-6">

                <label>Educational Qualification *</label>
                <div class="multiselect" >
                    <div class="selectBox"  onclick="showCheckboxes()" >
                        <select class="form-control ttt employer_post_qualification" name="employer_post_qualification"
                            required >
                            <option value="">Add Qualification</option>
                        </select>
                        {{-- <select class="form-control" name="employer_post_qualification" required onchange="">
                        <option selected="" value=""> Add Qualification</option>
                        @foreach ($educationInfo as $k => $education)
                            @if ($k > 1)
                                <option value="{{ $education->education_id }}"
                                    {{ isset($jobPost) && $jobPost[0]->employer_post_qualification == $education->education_id ? 'selected' : '' }}>
                                    {{ $education->education_name }}</option>
                            @endif
                        @endforeach
                    </select> --}}
                        <div class="overSelect"></div>
                    </div>

                    <div id="checkboxes" >

                        @foreach ($educationInfo as $k => $education)
                            @if ($k > 1)
                                @php

                                    $post = [];
                                    if (isset($jobPost)) {
                                        $post = explode(',', $jobPost[0]->employer_post_qualification);
                                    }

                                @endphp
                                <label>
                                    <input onchange="handleSelect()" class="form-checkbox employer_education"
                                        type="checkbox" name="employer_post_qualification[]"
                                        value="{{ $education->education_id }}"
                                        {{ isset($jobPost) && in_array($education->education_id, $post)  ? 'checked' : '' }} />
                                    {{ $education->education_name }}
                                </label>
                            @endif

                        @endforeach
                    </div>
                </div>

            </div>

            <div class="col-md-6">

                <label>Experience Range*</label>
                <div>
                    <div class="row" style="position: relative;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-outline">
                                    <select class="form-control" name="employer_post_experience_from" required>
                                        <option selected="" value="">Select</option>
                                        @foreach (SalaryLakhs() as $l => $lakh)
                                            <option value="{{ $l + 1 }}"
                                                {{ isset($jobPost) && $jobPost[0]->employer_post_experience_from == $l + 1 ? 'selected' : '' }}>
                                                {{ $lakh }} Year{{ $l > 0 ? 's' : '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-outline">
                                    <select class="form-control" name="employer_post_experience_to" required>
                                        <option selected="" value="">Select</option>
                                        @foreach (SalaryLakhs() as $l => $lakh)
                                            <option value="{{ $l + 1 }}"
                                                {{ isset($jobPost) && $jobPost[0]->employer_post_experience_to == $l + 1 ? 'selected' : '' }}>
                                                {{ $lakh }} Year{{ $l > 0 ? 's' : '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div style="position: absolute;left:47.5%;">
                            <p class="to">To</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="background">
        <div class="row">
            <div class="col-md-3 d-flex">
                <p>Salary range *</p>
            </div>
            <div class="col-md-9">
                <div class="form-group" style="margin-bottom:0;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1"
                            name="employer_post_hidesalary"
                            {{ isset($jobPost) && $jobPost[0]->employer_post_hidesalary == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexCheckDefault">
                            Hide from candidates
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="position: relative;">
            <div class="col-md-3">
                <div class="form-group">
                    <div class="form-outline">
                        <select class="form-control" name="employer_post_salary_range_from_lakhs" required>
                            <option selected="" value="">Select</option>
                            @foreach (SalaryLakhs() as $l => $lakh)
                                <option value="{{ $l + 1 }}"
                                    {{ isset($jobPost) && $jobPost[0]->employer_post_salary_range_from_lakhs == $l + 1 ? 'selected' : '' }}>
                                    {{ $lakh }} Lakh{{ $l > 0 ? 's' : '' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <div class="form-outline">
                        <select class="form-control" name="employer_post_salary_range_from_thousands" required>
                            <option selected="" value="">Select</option>
                            @foreach (SalaryThousands() as $k => $thousand)
                                <option value="{{ $k + 1 }}"
                                    {{ isset($jobPost) && $jobPost[0]->employer_post_salary_range_from_thousands == $k + 1 ? 'selected' : '' }}>
                                    {{ $thousand }} Thousand</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <div class="form-outline">
                        <select class="form-control" name="employer_post_salary_range_to_lakhs" required>
                            <option selected="" value="">Select</option>
                            @foreach (SalaryLakhs() as $l => $lakh)
                                <option value="{{ $l + 1 }}"
                                    {{ isset($jobPost) && $jobPost[0]->employer_post_salary_range_to_lakhs == $l + 1 ? 'selected' : '' }}>
                                    {{ $lakh }} Lakh{{ $l > 0 ? 's' : '' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <div class="form-outline">
                        <select class="form-control" name="employer_post_salary_range_to_thousands" required>
                            <option selected="" value="">Select</option>
                            @foreach (SalaryThousands() as $k => $thousand)
                                <option value="{{ $k + 1 }}"
                                    {{ isset($jobPost) && $jobPost[0]->employer_post_salary_range_to_thousands == $k + 1 ? 'selected' : '' }}>
                                    {{ $thousand }} Thousand</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div style="position: absolute;left:48.5%;">
                <p class="to">To</p>
            </div>
        </div>
    </div>

    <div class="background">
        @if (isset($jobPost) && count($jobPost))
            @php
                $allState = explode(',', $jobPost[0]->employer_post_location_state);
                $allCity = explode(',', $jobPost[0]->employer_post_location_city);
            @endphp
            @foreach ($allState as $k => $state)
                @php
                    $stateName = $cityName = $stateId = $cityId = '';
                    $stateInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getStateById($state);
                    if (count($stateInfo)) {
                        $stateId = $stateInfo[0]->state_id;
                        $stateName = $stateInfo[0]->state_name;
                        $cityInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getCityById($allCity[$k]);
                        if (count($cityInfo)) {
                            $cityId = $cityInfo[0]->city_id;
                            $cityName = $cityInfo[0]->city_name;
                        }
                    }
                @endphp
                @if ($k == 1)
                    <div class="addnewelement" style="padding-top:7px;">
                @endif
                <div class="row location_main" style="padding : {{ $k > 0 ? '10px 0px' : '' }}">
                    <div class="col-md-6">
                        <div class="">
                            <div style="position:relative" class="autocomplete_ui_parent">
                                @if ($k == 0)
                                    <label>Job Location *</label>
                                @endif
                                <input autocomplete="off" type="text" name="employer_post_location_state[]"
                                    required class="form-control employer_post_location_state autocomplete_actual_id"
                                    value="{{ $stateName }}" placeholder="Add State">
                                <input type="hidden" class="autocomplete_id employer_post_location_state_id"
                                    name="employer_post_location_state_id[]" value="{{ $stateId }}">
                                <div class="autocomplete-items" style="display:none"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-{{ $k > 0 ? 5 : 6 }}">
                        <div class="">
                            <div style="position:relative" class="autocomplete_ui_parent">
                                @if ($k == 0)
                                    <label style="visibility: hidden">City *</label>
                                @endif
                                <input autocomplete="off" type="text" name="employer_post_location_city[]"
                                    required class="form-control employer_post_location_city autocomplete_actual_id"
                                    value="{{ $cityName }}" placeholder="Add City">
                                <input type="hidden" class="autocomplete_id employer_post_location_city_id"
                                    name="employer_post_location_city_id[]" value="{{ $cityId }}">
                                <div class="autocomplete-items" style="display:none"></div>
                            </div>
                        </div>
                    </div>

                    @if ($k > 0)
                        <div class="col-md-1">
                            <div style="cursor: pointer;
                                background: red;
                                border-radius: 50%;
                                position: absolute;
                                top: 8px;
                                left: 10px;
                                color: #fff;
                                padding: 2px 6px;
                                font-size: 11px;"
                                class="removelocationelement">X
                            </div>
                        </div>
                    @endif

                </div>
                @if ($k + 1 == count($allState))
                @endif
            @endforeach
        @else
            <div class="row location_main">
                <div class="col-md-6">
                    <div class="">
                        <div style="position:relative" class="autocomplete_ui_parent">
                            <label>Job Location *</label>
                            <input autocomplete="off" type="text" name="employer_post_location_state[]" required
                                class="form-control employer_post_location_state autocomplete_actual_id"
                                value="" placeholder="Add State">
                            <input type="hidden" class="autocomplete_id employer_post_location_state_id"
                                name="employer_post_location_state_id[]" value="">
                            <div class="autocomplete-items" style="display:none"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="">
                        <div style="position:relative" class="autocomplete_ui_parent">
                            <label style="visibility: hidden">City *</label>
                            <input autocomplete="off" type="text" name="employer_post_location_city[]" required
                                readonly class="form-control employer_post_location_city autocomplete_actual_id"
                                value="" placeholder="Add City">
                            <input type="hidden" class="autocomplete_id employer_post_location_city_id"
                                name="employer_post_location_city_id[]" value="">
                            <div class="autocomplete-items" style="display:none"></div>
                            {{-- <div class="selected_cities">
                                            @if (isset($jobPost) && count($cityNameArray))
                                                <ul class="selected_items">
                                                    @foreach ($cityNameArray as $k => $cityList)
                                                        <li>
                                                            {{ $cityList }}
                                                            <img class="pointer clear_city" style="cursor:pointer"
                                                                data-index="{{ $k }}" data-id="{{ $cityIdArray[$k] }}"
                                                                src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/cancel.svg') }}">

                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="addnewelement"></div>
        @endif

        <div class="add_moreemployer" style="text-align: left;padding:10px 0px;">
            <span
                style="color: #1D56BB;cursor:pointer;position:unset;font-size:14px;display: {{ isset($jobPost) && count($allState) == 3 ? 'none' : 'block' }}">Add
                More</span>
        </div>
    </div>

    <div class="background">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Industry type *</label>
                    <select class="form-control" name="employer_post_industry_type"
                        aria-label="Default select example" required
                        onchange="showOther(this.value,'employer_post_industry_type')">
                        <option value="">Select</option>
                        @foreach (getActiveRecord('industry') as $industry)
                            <option value="{{ $industry->industry_id }}"
                                {{ isset($jobPost) && $jobPost[0]->employer_post_industry_type == $industry->industry_id ? 'selected' : '' }}>
                                {{ $industry->industry_name }}</option>
                        @endforeach
                        <option value="0"
                            {{ isset($jobPost) && $jobPost[0]->employer_post_industry_type == 0 ? 'selected' : '' }}>
                            Other
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Department *</label>
                    <select class="form-control" name="employer_post_department" aria-label="Default select example"
                        required onchange="showOther(this.value,'employer_post_department')">
                        <option value="">Select</option>
                        @foreach (getActiveRecord('department') as $department)
                            <option value="{{ $department->department_id }}"
                                {{ isset($jobPost) && $jobPost[0]->employer_post_department == $department->department_id ? 'selected' : '' }}>
                                {{ $department->department_name }}</option>
                        @endforeach
                        <option value="0"
                            {{ isset($jobPost) && $jobPost[0]->employer_post_department == 0 ? 'selected' : '' }}>Other
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row employer_post_industry_type"
            style="display: {{ isset($jobPost) && $jobPost[0]->employer_post_industry_name != '' ? 'block' : 'none' }}">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Industry Name *</label>
                    <input autocomplete="off" type="text" id="" placeholder="Add Industry name"
                        name="employer_post_industry_name" class="form-control"
                        value="{{ isset($jobPost) ? $jobPost[0]->employer_post_industry_name : '' }}" />
                </div>
            </div>
        </div>

        <div class="row employer_post_department"
            style="display: {{ isset($jobPost) && $jobPost[0]->employer_post_industry_name != '' ? 'block' : 'none' }}">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Department Name *</label>
                    <input autocomplete="off" type="text" id="" placeholder="Add Industry name"
                        name="employer_post_department_name" class="form-control"
                        value="{{ isset($jobPost) ? $jobPost[0]->employer_post_department_name : '' }}" />
                </div>
            </div>
        </div>


        @php
            if (isset($jobPost)) {
                $designationInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getDesignationById($jobPost[0]->employer_post_designation);

                $designationName = count($designationInfo) ? $designationInfo[0]->designation_name : $jobPost[0]->employer_post_designation;
            }
        @endphp
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="company_designation">
                        Job Role / Designation *</label>
                    <div style="position:relative" class="autocomplete_ui_parent">
                        <input autocomplete="off" type="text" placeholder="Add Designation"
                            name="employer_post_designation"
                            class="form-control autocomplete_actual_id user_employment_current_designation employer_post_designation"
                            required value="{{ isset($jobPost) ? $designationName : '' }}" />
                        <input type="hidden" name="current_designation_id" class="autocomplete_id"
                            value="{{ isset($jobPost) ? $jobPost[0]->employer_post_designation : '' }}">
                        <div class="autocomplete-items" style="display:none">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Number of Vacancies *</label>
                    <input autocomplete="off" type="number" id="" placeholder="Add Number of Vacancies"
                        name="employer_post_vacancies" class="form-control" required
                        value="{{ isset($jobPost) ? $jobPost[0]->employer_post_vacancies : '' }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="background" style="padding-bottom:10px">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="form-check">
                        <input class="form-check-input employer_post_walkin" type="checkbox" value="1"
                            name="employer_post_walkin"
                            {{ isset($jobPost) && $jobPost[0]->employer_post_walkin == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexCheckDefault">
                            Add Walk-in Details (Optional)
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row walkin_details"
            style="display: {{ isset($jobPost) && $jobPost[0]->employer_post_walkin == 1 ? 'flex' : 'none' }};padding-top:10px;">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Date *</label>
                    <div class="d-flex">
                        <input type="date" name="employer_post_walkin_date" placeholder="Date"
                            class="form-control" date-format="DD MMMM YYYY"
                            value="{{ isset($jobPost) ? $jobPost[0]->employer_post_walkin_date : '' }}">
                    </div>
                </div>

            </div>

            <div class="col-md-8">
                <div class="form-group" style="position: relative;">
                    <div class="row">
                        <div class="col-md-5">
                            <label>Time *</label>
                            <div class="d-flex">
                                <input type="time" name="employer_post_walkin_time_from" placeholder="Time"
                                    class="form-control"
                                    value="{{ isset($jobPost) && $jobPost[0]->employer_post_walkin_time_from != '' ? $jobPost[0]->employer_post_walkin_time_from : '10:00' }}">
                            </div>
                        </div>
                        <div class="col-md-1" style="position: relative">
                            <p class="to" style="position: absolute; top: 31px; left: 10px;">To</p>
                        </div>
                        <div class="col-md-5">
                            <label style="visibility: hidden">Time *</label>
                            <div class="d-flex">
                                <input type="time" name="employer_post_walkin_time_to" placeholder="Time"
                                    class="form-control"
                                    value="{{ isset($jobPost) && $jobPost[0]->employer_post_walkin_time_to != '' ? $jobPost[0]->employer_post_walkin_time_to : '17:00' }}">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <div class="address" style="display: flex;justify-content:space-between">
                        <label>Address *</label>
                        <span><input type="checkbox" class="use_address" />Use Current Address</span>
                    </div>
                    <textarea autocomplete="off" name="employer_post_walkin_address" placeholder="Add address"
                        class="form-control employer_post_walkin_address">{{ isset($jobPost) ? $jobPost[0]->employer_post_walkin_address : '' }}</textarea>
                </div>
            </div>
        </div>

    </div>

    <div class="background" style="padding-bottom:10px">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="form-check">
                        <input class="form-check-input employer_post_external" type="checkbox" value="1"
                            name="employer_post_external"
                            {{ isset($jobPost) && $jobPost[0]->employer_post_external == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexCheckDefault">
                            Add External Apply Link (Optional)
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row apply_link"
            style="display: {{ isset($jobPost) && $jobPost[0]->employer_post_external == 1 ? 'block' : 'none' }}; padding-top:10px;">
            <div class="col-md-12">
                <div class="form-group">
                    <input autocomplete="off" type="url" name="employer_post_apply_link"
                        value="{{ isset($jobPost) ? $jobPost[0]->employer_post_apply_link : old('employer_post_apply_link') }}"
                        class="form-control" placeholder="Enter Apply URL">
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="employer_post_save_status" value="1">
    <input type="hidden" name="customid" value="{{ request()->get('id') != '' ? request()->get('id') : '' }}">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button style="display:none" id="employer_post_submit" type="submit">Save</button>
                <button id="employer_post_save" type="button" class="btn btn-primary">Publish</button>
                <button id="employer_post_save_publish" type="button" class="btn btn-primary">Save and
                    Preview</button>
            </div>
        </div>
    </div>

</form>

<script>
    let expanded = false;



    const handleSelect = () => {
        let checkboxes = document.getElementById("checkboxes");
        // checkboxes.style.display = "block";
        let selectedItems = document.getElementsByClassName("employer_education");
        $('.employer_post_qualification').attr('required', true)
        $(".employer_education").each(function() {
            if ($(this).is(":checked")) {
                $('.employer_post_qualification').attr('required', false)
            }
        })
    }

    function showCheckboxes() {
        let checkboxes = document.getElementById("checkboxes");
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
    }

    let previousLength = 0;

    const handleInput = (event) => {
        const bullet = "\u2022";
        const newLength = event.target.value.length;
        const characterCode = event.target.value.substr(-1).charCodeAt(0);

        if (newLength > previousLength) {
            if (characterCode === 10) {
                event.target.value = `${event.target.value}${bullet} `;
            } else if (newLength === 1) {
                event.target.value = `${bullet} ${event.target.value}`;
            }
        }

        previousLength = newLength;
    }
</script>
