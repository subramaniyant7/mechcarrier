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
                required>
                <option value="">Select</option>
                @foreach (getActiveRecord('industry') as $industry)
                    <option value="{{ $industry->industry_id }}"
                        {{ count($data) && $data[0]->user_employment_industry_type == $industry->industry_id ? 'selected' : '' }}>
                        {{ $industry->industry_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label>Department *</label>
            <select class="form-control" name="user_employment_department" aria-label="Default select example" required>
                <option value="">Select</option>
                @foreach (getActiveRecord('department') as $department)
                    <option value="{{ $department->department_id }}"
                        {{ count($data) && $data[0]->user_employment_department == $department->department_id ? 'selected' : '' }}>
                        {{ $department->department_name }}</option>
                @endforeach
            </select>
        </div>
    </div>



    <div class="row">
        <div class="col-md-12">
            <label>Current Company Name *</label>
            <div style="position:relative">
                <input type="text" id="" placeholder="Add company name"
                    name="user_employment_current_companyname" class="form-control user_employment_current_companyname"
                    required value=" {{ count($data) ? $data[0]->user_employment_current_companyname : '' }}" />

                <div class="autocomplete-items" style="display:none">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <label>Current Designation *</label>
            <select class="form-control" name="user_employment_current_designation" aria-label="Default select example"
                required>
                <option selected value="">Add designation</option>
                @foreach (getActiveRecord('designation') as $designation)
                    <option value="{{ $designation->designation_id }}"
                        {{ count($data) && $data[0]->user_employment_current_designation == $designation->designation_id ? 'selected' : '' }}>
                        {{ $designation->designation_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row form-selectbox">
        <div class="col-md-6">
            <label>Joining Date *</label>
            <div class="d-flex">
                <select class="form-control" name="user_employment_joining_year" aria-label="Default select example"
                    required>
                    <option selected value="">Year</option>
                    @foreach (Year() as $k => $year)
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
                    @foreach (Year() as $k => $year)
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
            <label>Current Annual Salary *</label>
            <div class="d-flex">
                <select class="form-control" name="user_employment_current_salary_lakh"
                    aria-label="Default select example" required>
                    <option selected value="">0 Lakh</option>
                    <option value="1"
                        {{ count($data) && $data[0]->user_employment_current_salary_lakh == 1 ? 'selected' : '' }}>
                        1
                        Lakh</option>
                    <option value="2"
                        {{ count($data) && $data[0]->user_employment_current_salary_lakh == 2 ? 'selected' : '' }}>
                        2
                        Lakh</option>
                    <option value="3"
                        {{ count($data) && $data[0]->user_employment_current_salary_lakh == 3 ? 'selected' : '' }}>
                        3
                        Lakh</option>
                </select>
                <select class="form-control" name="user_employment_current_salary_thousand"
                    aria-label="Default select example" required>
                    <option selected value="">0 Thousand </option>
                    <option value="1"
                        {{ count($data) && $data[0]->user_employment_current_salary_thousand == 1 ? 'selected' : '' }}>
                        5 Thousand</option>
                    <option value="2"
                        {{ count($data) && $data[0]->user_employment_current_salary_thousand == 2 ? 'selected' : '' }}>
                        10 Thousand</option>
                    <option value="3"
                        {{ count($data) && $data[0]->user_employment_current_salary_thousand == 3 ? 'selected' : '' }}>
                        15 Thousand</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
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
            <label>Job Profile</label>
            <textarea name="user_employment_description" rows="7" cols="30" placeholder="" required>{{ count($data) ? $data[0]->user_employment_description : '' }}</textarea>
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
    // $(document).on("click", "input[type=checkbox][name=user_employment_current_company]", function(e) {
    //     console.log($(this));
    //     let this1 = this;
    //     let mandatory = true;
    //     $("input[type=checkbox][name=user_employment_current_company]").each(function() {
    //         // if ($(this).prop('checked') == true) {
    //         //     console.log('checked');
    //         //     mandatory = false;
    //         // }else if(mandatory){
    //         //     console.log('not checked');
    //         // }
    //         if(this1 != $(this)) $(this).prop('checked', false);
    //         if(this1 == $(this)) $(this).prop('checked', true);
    //     });
    // });

    let currentCompany = $("input[type=checkbox][name=user_employment_current_company]");
    currentCompany.on("click", function() {
        let checkedState = this.checked
        let current = this;
        if (this.value == 1) {
            $("select[name=user_employment_working_year]").removeAttr('required');
            $("select[name=user_employment_working_month]").removeAttr('required');
            $('.worktill').hide();
        }
        if (this.value == 2) {
            $("select[name=user_employment_working_year]").attr('required', 'required');
            $("select[name=user_employment_working_month]").attr('required', 'required');
            $('.worktill').show();
        }
        currentCompany.each(function() {
            if (current != this) {
                this.checked = !checkedState;
                $(this).removeAttr('required')
            } else {
                $(this).attr('required', 'required')
            }

        });
    });

    let employmentType = $("input[type=checkbox][name=user_employment_type]");
    employmentType.on("click", function() {
        let checkedState = this.checked
        let current = this;
        employmentType.each(function() {
            if (current != this) {
                this.checked = !checkedState;
                $(this).removeAttr('required')
            } else {
                $(this).attr('required', 'required')
            }
        });
    });
</script>
