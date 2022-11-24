<form id="employer_post" action="{{ route('saveemployerjobpost') }}" methos="POST">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="form-outline">
                <label>Job Post Headline *</label>
                <input type="text" class="form-control" name="employer_post_headline" required
                    placeholder="Add title which describe job role "
                    value="{{ isset($jobPost) ? $jobPost[0]->employer_post_headline : old('employer_post_headline') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <div class="form-outline">
                    <label>Employment Type *</label>
                    <select class="form-control" name="employer_post_employement_type" required>
                        <option selected="" value="">Select</option>
                        @foreach (employmentType() as $k => $employmentType)
                            <option value="{{ $k + 1 }}"
                                {{ isset($jobPost) && $jobPost[0]->employer_post_employement_type == $k + 1 ? 'selected' : '' }}>
                                {{ $employmentType }}
                            </option>
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
                    placeholder="Describe activities in this job role " class="form-control">{{ isset($jobPost) ? $jobPost[0]->employer_post_description : old('employer_post_description') }}</textarea>
                <div class="counter" id="the-count" style="font-weight: normal;">
                    <span id="current"
                        style="color: rgb(102, 102, 102);">{{ isset($jobPost) ? strlen($jobPost[0]->employer_post_description) : 0 }}</span>
                    <span id="maximum" style="color: rgb(102, 102, 102);">/ 1000</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-outline">
                <label>Key Skill *</label>
                <input type="text" required name="employer_post_key_skils" class="form-control"
                    value="{{ isset($jobPost) ? $jobPost[0]->employer_post_key_skils : old('employer_post_key_skils') }}"
                    placeholder="Add minimum 5 for better targeting candidates ( max 100 charactors )">
            </div>
        </div>
    </div>

    @php
        $educationInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getEducationInfo();
    @endphp
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-outline">
                    <label>Educational Qualification *</label>
                    <select class="form-control" name="employer_post_qualification" required>
                        <option selected="" value=""> Add Qualification</option>
                        @foreach ($educationInfo as $education)
                            <option value="{{ $education->education_id }}"
                                {{ isset($jobPost) && $jobPost[0]->employer_post_qualification == $education->education_id ? 'selected' : '' }}>
                                {{ $education->education_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-outline">
                    <label>Experience *</label>
                    <select class="form-control" name="employer_post_experience" required>
                        <option selected="" value=""> Add Experience</option>
                        @foreach (experienceGap() as $k => $experience)
                            <option value="{{ $k + 1 }}"
                                {{ isset($jobPost) && $jobPost[0]->employer_post_experience == $k + 1 ? 'selected' : '' }}>
                                {{ $experience }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 d-flex">
            <p>Salary range *</p>
        </div>
        <div class="col-md-9">
            <div class="form-group" style="margin-bottom:0;">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="employer_post_hidesalary"
                        {{ isset($jobPost) && $jobPost[0]->employer_post_hidesalary == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        Hide from candidates
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
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
        <div class="col-md-1">
            <p>To</p>
        </div>
        <div class="col-md-2">
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
    </div>
    @php
        $stateName = $cityName = '';
        $cityNameArray = $cityIdArray = [];
        if (isset($jobPost)) {
            $stateInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getStateById($jobPost[0]->employer_post_location_state);
            if (count($stateInfo)) {
                $stateName = $stateInfo[0]->state_name;
                $cityIdArray = explode(',', $jobPost[0]->employer_post_location_city);
                foreach ($cityIdArray as $k => $citysplitlist) {
                    $cityInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getCityById($citysplitlist);
                    if (count($cityInfo)) {
                        array_push($cityNameArray, $cityInfo[0]->city_name);
                    }
                }
                $cityName = implode(',', $cityNameArray);
            }
        }
    @endphp
    <input type="hidden" disabled class="city_text" value={{ $cityName }}>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div style="position:relative" class="autocomplete_ui_parent">
                    <label>Job Location State *</label>
                    <input type="text" name="employer_post_location_state" required
                        class="form-control employer_post_location_state autocomplete_actual_id"
                        value="{{ $stateName }}" placeholder="Add job location state ">
                    <input type="hidden" class="autocomplete_id" name="employer_post_location_state_id"
                        value="{{ isset($jobPost) ? $jobPost[0]->employer_post_location_state : '' }}">
                    <div class="autocomplete-items" style="display:none"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div style="position:relative" class="autocomplete_ui_parent">
                    <label>Job Location City *</label>
                    <input type="text" name="employer_post_location_city"
                        {{ isset($jobPost) && $jobPost[0]->employer_post_location_city != '' ? '' : 'required' }}
                        {{ isset($jobPost) && $jobPost[0]->employer_post_location_state != '' ? '' : 'readonly' }}
                        class="form-control employer_post_location_city autocomplete_actual_id" value=""
                        placeholder="Add job location city ( maximum 3 ) ">
                    <input type="hidden" class="autocomplete_id" name="employer_post_location_city_id"
                        value="{{ isset($jobPost) ? $jobPost[0]->employer_post_location_city : '' }}">
                    <div class="autocomplete-items" style="display:none"></div>
                    <div class="selected_cities">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Add walkin details ( if need )</label>
                <input type="text" name="employer_post_walkin_details"
                    value="{{ isset($jobPost) ? $jobPost[0]->employer_post_walkin_details : old('employer_post_walkin_details') }}"
                    class="form-control" placeholder="Add date, time and address">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input employer_post_external" type="checkbox" value="1"
                        name="employer_post_external"
                        {{ isset($jobPost) && $jobPost[0]->employer_post_external == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        External Apply
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row apply_link" style="display: {{ isset($jobPost) && $jobPost[0]->employer_post_external == 1 ? 'block' : 'none' }};">
        <div class="col-md-12">
            <div class="form-group">
                <label>Apply Link *</label>
                <input type="url" name="employer_post_apply_link"
                    value="{{ isset($jobPost) ? $jobPost[0]->employer_post_apply_link : old('employer_post_apply_link') }}"
                    class="form-control" placeholder="Enter Apply URL">
            </div>
        </div>
    </div>
    <input type="hidden" name="employer_post_save_status" value="1">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button style="display:none" id="employer_post_submit" type="submit">Save</button>
                <button id="employer_post_save" type="button" class="btn btn-primary">Save</button>
                <button id="employer_post_save_publish" type="button" class="btn btn-primary">Save and
                    publish</button>
            </div>
        </div>
    </div>

</form>
