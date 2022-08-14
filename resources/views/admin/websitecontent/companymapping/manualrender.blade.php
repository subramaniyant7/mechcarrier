<div class="form-group row  mb-4">
    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Company Name<span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <input type="text" class="form-control form-control" name="company_name" placeholder="Name" required
               value="{{ isset($data) ? $data[0]->company_name : old('company_name') }}"
        >
    </div>
</div>

<div class="form-group row  mb-4">
    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Company Image<span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <input type="file" class="form-control form-control" name="company_image" {{ isset($data) && $data[0]->company_image != '' ? '' : 'required' }}
               value="{{ isset($data) ? $data[0]->company_image : old('company_image') }}"
        >
        @if(isset($data) && $data[0]->company_image != '')
            <span><img style="width: 100%;height: 200px;margin-top: 1em;" src="{{ URL::asset('uploads/company_mapping/'.$data[0]->company_image)}}"></span>
        @endif
    </div>
</div>

<div class="form-group row  mb-4">
    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Job Count<span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <input type="number" class="form-control form-control" name="company_jobcount" placeholder="Count" required
               value="{{ isset($data) ? $data[0]->company_jobcount : old('company_jobcount') }}"
        >
    </div>
</div>
