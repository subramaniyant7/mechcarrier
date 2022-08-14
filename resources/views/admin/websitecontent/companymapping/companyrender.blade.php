<div class="form-group row  mb-4">
    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Company Name<span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <select class="form-select" name="company_actual_id" required>
            <option value="">Select Company</option>
            @foreach(companyTemp() as $k=> $company)
                <option value="{{$k+1}}" {{ isset($data) && $data[0]->company_actual_id == $k+1 ? 'selected' : '' }}>{{$company}}</option>
            @endforeach
        </select>
    </div>
</div>
