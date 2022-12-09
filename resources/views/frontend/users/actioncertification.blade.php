<style>
    .custombtn {
        display: block;
    }
</style>
@if ($type != 'add')
    <span class="chevron-up"><img
            src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/chevronup.svg') }}" /></span>
@endif
<form action="#" id="action_certification" class="mb-10" style="margin-top: {{ $type === 'add' ? '15px' : '0' }}">
    @if ($type != 'add')
        <div class="row">
            <div class="col-md-12 delete">
                <a
                    href="{{ route('deletecertification', ['id' => encryption($data[0]->user_certification_id)]) }}">Delete</a>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 parent">
            <label>Certification Name *</label>
            <input type="text" placeholder="Add certification name" class="form-control"
                name="user_certification_name" required
                value="{{ count($data) ? $data[0]->user_certification_name : '' }}" minlength="1" maxlength="50">
            <span class="text_limit" style="right: 24px;bottom: 0;display: block;"> {{ count($data) ? strlen($data[0]->user_certification_name) : 0}}/50 </span>
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
            <label>Duration of Certification *</label>
            <div class="d-flex">
                <select class="form-control" name="user_certification_duration_year" required
                    aria-label="Default select example">
                    <option selected="" value="">Year</option>
                    @foreach (Months() as $k => $year)
                        <option value="{{ $k + 1 }}"
                            {{ count($data) && $data[0]->user_certification_duration_year == $k + 1 ? 'selected' : '' }}>
                            {{ $year }}</option>
                    @endforeach
                </select>
                <select class="form-control" name="user_certification_duration_month" required
                    aria-label="Default select example">
                    <option selected="" value="">Month</option>
                    @foreach (Months() as $k => $month)
                        <option value="{{ $k + 1 }}"
                            {{ count($data) && $data[0]->user_certification_duration_month == $k + 1 ? 'selected' : '' }}>
                            {{ $month }}
                        </option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="col-md-6">
            <label>Completed Year - Month *</label>
            <div class="d-flex">
                <select class="form-control" name="user_certification_validity_year_to" required
                    aria-label="Default select example">
                    <option selected="" value="">Year</option>
                    @foreach ($years as $k => $year)
                        <option value="{{ $k + 1 }}"
                            {{ count($data) && $data[0]->user_certification_validity_year_to == $k + 1 ? 'selected' : '' }}>
                            {{ $year }}</option>
                    @endforeach
                </select>
                <select class="form-control" name="user_certification_validity_month_to" required
                    aria-label="Default select example">
                    <option selected="" value="">Month</option>
                    @foreach (Months1() as $k => $month)
                        <option value="{{ $k + 1 }}"
                            {{ count($data) && $data[0]->user_certification_validity_month_to == $k + 1 ? 'selected' : '' }}>
                            {{ $month }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-buttons custombtn">
                <button type="button" class="btn btn-cancel cancel_certification">Cancel</button>
                <button type="submit" class="btn btn-save">Save</button>
            </div>
        </div>
    </div>

    <input type="hidden" name="user_certification_id"
        value="{{ count($data) ? encryption($data[0]->user_certification_id) : '' }}">
</form>
