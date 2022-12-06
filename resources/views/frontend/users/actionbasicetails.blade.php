<style>
    .basicbtn {
        display: block;
    }
</style>

<form class="basic-detail-form" action="#" id="basic-details-form">
    <div class="row">
        <div class="col-md-6">
            <h4>Total Experience *</h4>
            <div class="d-flex">
                <select class="form-control" name="user_total_experience_year" aria-label="Default select example"
                    required>
                    <option selected value="">Year</option>
                    @foreach (SalaryLakhs() as $k => $year)
                        <option value="{{ $k + 1 }}"
                            {{ count($data) && $data[0]->user_total_experience_year == $k + 1 ? 'selected' : '' }}>
                            {{ $year }} {{ $k > 1 ? 'Years' : 'Year' }}</option>
                    @endforeach
                </select>
                <select class="form-control" name="user_total_experience_month" aria-label="Default select example"
                    required>
                    <option selected value="">Month</option>
                    @foreach (ExperienceMonths() as $k => $month)
                        <option value="{{ $k + 1 }}"
                            {{ count($data) && $data[0]->user_total_experience_month == $k + 1 ? 'selected' : '' }}>
                            {{ $month }} {{ $k > 1 ? 'Months' : 'Month' }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h4>Current Annual Salary *</h4>
            <div class="d-flex">
                <select class="form-control" name="user_current_salary_year" aria-label="Default select example"
                    required>
                    <option selected value="">Lakh</option>
                    @foreach (SalaryLakhs() as $l => $lakh)
                        <option value="{{ $l + 1 }}"
                            {{ count($data) && $data[0]->user_current_salary_year == $l + 1 ? 'selected' : '' }}>
                            {{ $lakh }} Lakh{{ $l > 1 ? 's' : '' }}</option>
                    @endforeach
                </select>
                <select class="form-control" name="user_current_salary_month" aria-label="Default select example"
                    required>
                    <option selected value="">Thousand </option>
                    @foreach (SalaryThousands() as $k => $thousand)
                        <option value="{{ $k + 1 }}"
                            {{ count($data) && $data[0]->user_current_salary_month == $k + 1 ? 'selected' : '' }}>
                            {{ $thousand }} {{ $k > 1 ? 'Thousands' : 'Thousand' }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h4>Notice Period *</h4>
            <div class="d-flex">
                <select class="form-control" name="user_notice_period" aria-label="Default select example"
                    required>
                    <option selected value="">Select Notice Period</option>
                    @foreach (noticePeriod() as $l => $noticePeriod)
                        <option value="{{ $l + 1 }}"
                            {{ count($data) && $data[0]->user_notice_period == $l + 1 ? 'selected' : '' }}>
                            {{ $noticePeriod }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <input type="hidden" name="user_profile_id" value="{{ count($data) ? $data[0]->user_profile_id : '' }}">
    <div class="row">
        <div class="col-md-12">
            <div class="form-buttons basicbtn">
                <button type="button" class="btn btn-cancel cancel_basic_details">Cancel</button>
                <button type="submit" class="btn btn-save">Save</button>
            </div>
        </div>
    </div>
</form>
