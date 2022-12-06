<style>
    .custombtn {
        display: block;
    }

    /*the container must be positioned relative:*/
    .autocomplete {
        position: relative;
        display: inline-block;
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
        background-color: #e9e9e9;
    }

    .autocomplete-items {
        border: 1px solid #d4d4d4;
        border-top: none;
        height: 100px;
        overflow: auto;
        position: absolute;
        z-index: 1;
        width: 100%;
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        text-align: left;
    }
</style>

@if ($type != 'add')
    <span class="chevron-up"><img
            src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/chevronup.svg') }}" /></span>
@endif
<form action="#" id="action_employment">
    <div class="row">
        @if ($type != 'add')
            <div class="col-md-12 delete">
                <a href="{{ route('deleteemployment', ['id' => encryption($data[0]->user_employment_id)]) }}">Delete</a>
            </div>
        @endif
        <div class="col-md-6 form-checkbox">
            <p>Is this your current employment?</p>
            <div class="d-flex">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1"
                        name="user_employment_current_company" {{ $type == 'add' ? 'required' : '' }}
                        {{ count($data) && $data[0]->user_employment_current_company == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        Yes
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="2"
                        name="user_employment_current_company" {{ $type == 'add' ? 'required' : '' }}
                        {{ count($data) && $data[0]->user_employment_current_company == 2 ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        No
                    </label>
                </div>
            </div>

        </div>
        <div class="col-md-6 form-checkbox">
            <p>Employment Type</p>
            <div class="d-flex">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="user_employment_type"
                        {{ $type == 'add' ? 'required' : '' }}
                        {{ count($data) && $data[0]->user_employment_type == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        Full-time
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="2" name="user_employment_type"
                        {{ $type == 'add' ? 'required' : '' }}
                        {{ count($data) && $data[0]->user_employment_type == 2 ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        Part-time
                    </label>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label>Industry type *</label>
            <select class="form-control" name="user_employment_industry_type" aria-label="Default select example"
                required onchange="showOther(this.value,'user_employment_industry_type')">
                <option value="">Select</option>
                @foreach (getActiveRecord('industry') as $industry)
                    <option value="{{ $industry->industry_id }}"
                        {{ count($data) && $data[0]->user_employment_industry_type == $industry->industry_id ? 'selected' : '' }}>
                        {{ $industry->industry_name }}</option>
                @endforeach
                <option value="0"
                    {{ count($data) && $data[0]->user_employment_industry_type == 0 ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="col-md-6">
            <label>Department *</label>
            <select class="form-control" name="user_employment_department" aria-label="Default select example" required
                onchange="showOther(this.value,'user_employment_department')">
                <option value="">Select</option>
                @foreach (getActiveRecord('department') as $department)
                    <option value="{{ $department->department_id }}"
                        {{ count($data) && $data[0]->user_employment_department == $department->department_id ? 'selected' : '' }}>
                        {{ $department->department_name }}</option>
                @endforeach
                <option value="0"
                    {{ count($data) && $data[0]->user_employment_department == 0 ? 'selected' : '' }}>Other</option>
            </select>
        </div>
    </div>

    <div class="row user_employment_industry_type"
        style="display: {{ count($data) && $data[0]->user_employment_industry_type_other != '' ? 'block' : 'none' }}">
        <div class="col-md-12">
            <label>Industry Name *</label>
            <input type="text" id="" placeholder="Add Industry name"
                name="user_employment_industry_type_other" class="form-control"
                {{ count($data) && $data[0]->user_employment_industry_type_other != '' ? 'required' : '' }}
                value="{{ count($data) ? $data[0]->user_employment_industry_type_other : '' }}" />
        </div>
    </div>

    <div class="row user_employment_department"
        style="display: {{ count($data) && $data[0]->user_employment_department_other != '' ? 'block' : 'none' }}">
        <div class="col-md-12">
            <label>Department Name *</label>
            <input type="text" id="" placeholder="Add Department name"
                name="user_employment_department_other" class="form-control"
                {{ count($data) && $data[0]->user_employment_department_other != '' ? 'required' : '' }}
                value="{{ count($data) ? $data[0]->user_employment_department_other : '' }}" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <label
                class="company_name">{{ count($data) && $data[0]->user_employment_current_company == 1 ? 'Current' : '' }}
                Company Name *</label>
            @php
                $companyName = '';
                if (count($data)) {
                    $getCompany = \App\Http\Controllers\Frontend\Helper\HelperController::getCompanyById($data[0]->user_employment_current_companyname);
                    if (count($getCompany)) {
                        $companyName = $getCompany[0]->company_detail_name;
                    } else {
                        $companyName = $data[0]->user_employment_current_companyname;
                    }
                }
            @endphp
            <div style="position:relative" class="autocomplete_ui_parent">
                <input type="text" id="current_company1" placeholder="Add company name"
                    name="user_employment_current_companyname"
                    class="form-control autocomplete_actual_id user_employment_current_companyname" required
                    value="{{ $companyName }}" />
                <input type="hidden" name="current_company_id" class="autocomplete_id"
                    value="{{ count($data) ? $data[0]->user_employment_current_companyname : '' }}">
                <div class="autocomplete-items" style="display:none">
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-12">
            <label
                class="company_designation">{{ count($data) && $data[0]->user_employment_current_company == 1 ? 'Current' : '' }}
                Designation *</label>
            @php
                $designation = '';
                if (count($data)) {
                    $getDesignation = \App\Http\Controllers\Frontend\Helper\HelperController::getDesignationById($data[0]->user_employment_current_designation);
                    if (count($getDesignation)) {
                        $designation = $getDesignation[0]->designation_name;
                    } else {
                        $designation = $data[0]->user_employment_current_designation;
                    }
                }
            @endphp
            <div style="position:relative" class="autocomplete_ui_parent">
                <input type="text" placeholder="Add Designation" name="user_employment_current_designation"
                    class="form-control autocomplete_actual_id user_employment_current_designation" required
                    value="{{ $designation }}" />
                <input type="hidden" name="current_designation_id" class="autocomplete_id"
                    value="{{ count($data) ? $data[0]->user_employment_current_designation : '' }}">
                <div class="autocomplete-items" style="display:none">
                </div>
            </div>
            {{-- <select class="form-control" name="user_employment_current_designation"
                aria-label="Default select example" required
                onchange="showOther(this.value,'user_employment_current_designation')">
                <option selected value="">Add designation</option>
                @foreach (getActiveRecord('designation') as $designation)
                    <option value="{{ $designation->designation_id }}"
                        {{ count($data) && $data[0]->user_employment_current_designation == $designation->designation_id ? 'selected' : '' }}>
                        {{ $designation->designation_name }}</option>
                @endforeach
                <option value="0"
                    {{ count($data) && $data[0]->user_employment_current_designation == 0 ? 'selected' : '' }}>Other
                </option>
            </select> --}}
        </div>
    </div>

    <div class="row user_employment_current_designation"
        style="display: {{ count($data) && $data[0]->user_employment_current_designation_other != '' ? 'block' : 'none' }}">
        <div class="col-md-12">
            <label>Designation Name *</label>
            <input type="text" id="" placeholder="Add Designation name"
                name="user_employment_current_designation_other" class="form-control"
                {{ count($data) && $data[0]->user_employment_current_designation_other != '' ? 'required' : '' }}
                value="{{ count($data) ? $data[0]->user_employment_current_designation_other : '' }}" />
        </div>
    </div>
    @php
        $years = Year();
        usort($years, function ($a, $b) {
            if ($a == $b) {
                return 0;
            }
            return $a > $b ? -1 : 1;
        });
    @endphp
    <div class="row form-selectbox">
        <div class="col-md-6">
            <label>Joining Date *</label>
            <div class="d-flex">
                <select class="form-control" name="user_employment_joining_year" aria-label="Default select example"
                    required>
                    <option selected value="">Year</option>
                    @foreach ($years as $k => $year)
                        <option value="{{ $k + 1 }}"
                            {{ count($data) && $data[0]->user_employment_joining_year == $k + 1 ? 'selected' : '' }}>
                            {{ $year }}</option>
                    @endforeach
                </select>
                <select class="form-control" name="user_employment_joining_month" aria-label="Default select example"
                    required>
                    <option selected value="">Month</option>
                    @foreach (Months() as $k => $month)
                        <option value="{{ $k + 1 }}"
                            {{ count($data) && $data[0]->user_employment_joining_month == $k + 1 ? 'selected' : '' }}>
                            {{ $month }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6 worktill"
            style="display : {{ count($data) && $data[0]->user_employment_current_company == 1 ? 'none' : 'block' }}">
            <label>Working till *</label>
            <div class="d-flex">

                <select class="form-control" name="user_employment_working_year" aria-label="Default select example"
                    required>
                    <option selected value="">Year</option>
                    @foreach ($years as $k => $year)
                        <option value="{{ $k + 1 }}"
                            {{ count($data) && $data[0]->user_employment_working_year == $k + 1 ? 'selected' : '' }}>
                            {{ $year }}</option>
                    @endforeach
                </select>
                <select class="form-control" name="user_employment_working_month" aria-label="Default select example"
                    required>
                    <option selected value="">Month</option>
                    @foreach (restrictedMonths() as $k => $month)
                        <option value="{{ $k + 1 }}"
                            {{ count($data) && $data[0]->user_employment_working_month == $k + 1 ? 'selected' : '' }}>
                            {{ $month }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row form-selectbox one-select">
        <div class="col-md-6">
            <label>Annual Salary *</label>
            <div class="d-flex">
                <select class="form-control" name="user_employment_current_salary_lakh"
                    aria-label="Default select example" required>
                    <option selected value="">0 Lakh</option>
                    @foreach (SalaryLakhs() as $l => $lakh)
                        <option value="{{ $l + 1 }}"
                            {{ count($data) && $data[0]->user_employment_current_salary_lakh == $l + 1 ? 'selected' : '' }}>
                            {{ $lakh }} Lakh{{ $l > 0 ? 's' : '' }}</option>
                    @endforeach
                </select>
                <select class="form-control" name="user_employment_current_salary_thousand"
                    aria-label="Default select example" required>
                    <option selected value="">0 Thousand </option>
                    @foreach (SalaryThousands() as $k => $thousand)
                        <option value="{{ $k + 1 }}"
                            {{ count($data) && $data[0]->user_employment_current_salary_thousand == $k + 1 ? 'selected' : '' }}>
                            {{ $thousand }} Thousand</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6 notice_period">
            <label>Notice Period *</label>
            <div class="d-flex">
                <select class="form-control" name="user_employment_notice_period" aria-label="Default select example"
                    required>
                    <option selected value="">Select notice period</option>
                    @foreach (noticePeriod() as $k => $noticePeriod)
                        <option value="{{ $k + 1 }}"
                            {{ count($data) && $data[0]->user_employment_notice_period == $k + 1 ? 'selected' : '' }}>
                            {{ $noticePeriod }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <label>Job Profile (optional)</label>
            <textarea style="margin-top:1px;" name="user_employment_description" rows="7" cols="30" placeholder="">{{ count($data) ? $data[0]->user_employment_description : '' }}</textarea>
        </div>
        <div class="col-md-12">
            <div class="form-buttons custombtn">
                <button type="button" class="btn btn-cancel cancel_employment">Cancel</button>
                <button type="submit" class="btn btn-save">Save</button>
            </div>
        </div>
    </div>

    <input type="hidden" name="user_employment_id"
        value="{{ count($data) ? encryption($data[0]->user_employment_id) : '' }}">

</form>


<script>
    $(document).on('click', "input[type=checkbox][name=user_employment_current_company]", function() {
        let checkedState = this.checked
        let current = this;
        if (this.value == 1) {
            $("select[name=user_employment_working_year]").removeAttr('required');
            $("select[name=user_employment_working_month]").removeAttr('required');
            $("select[name=user_employment_notice_period]").attr('required');
            $('.worktill').hide();
            $('.notice_period').show();
            $('.company_name').html('Current Company Name');
            $('.company_designation').html('Current Designation');
        }
        if (this.value == 2) {
            $("select[name=user_employment_working_year]").attr('required', 'required');
            $("select[name=user_employment_working_month]").attr('required', 'required');
            $("select[name=user_employment_notice_period]").removeAttr('required', 'required');
            $('.worktill').show();
            $('.notice_period').hide();
            $('.company_name').html('Company Name');
            $('.company_designation').html('Company Designation');
        }
        $("input[type=checkbox][name=user_employment_current_company]").each(function() {
            if (current != this) {
                this.checked = !checkedState;
                $(this).removeAttr('required')
                $(this).removeAttr('checked')
            } else {
                $(this).attr('required', 'required')
            }

        });
    });

    let employmentType = $("input[type=checkbox][name=user_employment_type]");
    $(document).on('click', "input[type=checkbox][name=user_employment_type]", function() {
        let checkedState = this.checked
        let current = this;
        $("input[type=checkbox][name=user_employment_type]").each(function() {
            if (current != this) {
                this.checked = !checkedState;
                $(this).removeAttr('required')
                $(this).removeAttr('checked')
            } else {
                $(this).attr('required', 'required')
            }
        });
    });

    const showOther = (val, className) => {
        if (val == 0) {
            $('.' + className).show();
            $('.' + className).find('input').attr('required', 'required');
        } else {
            $('.' + className).hide();
            $('.' + className).find('input').removeAttr('required');
        }
    }
</script>
