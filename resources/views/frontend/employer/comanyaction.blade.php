@extends('frontend.employer.layout')
@section('title', 'Employer Company')
<style>
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
@section('content')

    <main>
        <div class="employers-registration-confirmation">
            <div class="container">
                <div class="row">

                    <div class="col-md-7">
                        @include('admin.notification')
                        <div class="title">
                            <h1>Add / Edit company details</h1>
                            <p>It only takes a couples of minutes to get started</p>
                        </div>
                        <div class="form">
                            <form autocomplete="off" action="{{ route('saveemployercompany') }}" method="POST"
                                enctype='multipart/form-data'>
                                @csrf
                                <div class="form-group">
                                    <label>Company Name*</label>
                                    <input type="text" class="form-control bg"
                                        placeholder="ISOPARA Engineering Services Pvt Ltd" style="cursor: not-allowed"
                                        disabled name="employer_company_name"
                                        value="{{ count($data) ? $data[0]->employer_company_name : '' }}" />
                                </div>
                                <div class="form-group">
                                    <label>Official Email*</label>
                                    <input type="email" class="form-control bg" style="cursor: not-allowed" disabled
                                        placeholder="hr@isopara.com" name="employer_email"
                                        value="{{ count($data) ? $data[0]->employer_email : '' }}" />
                                </div>
                                <div class="form-group">
                                    <label>Mobile Number*</label>
                                    <input type="number" class="form-control" placeholder="Add mobile number"
                                        name="employer_mobile" value="{{ count($data) ? $data[0]->employer_mobile : '' }}"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label>Contact Person Name*</label>
                                    <input type="text" class="form-control" placeholder="Add contact person name"
                                        name="employer_company_name"
                                        value="{{ count($data) ? $data[0]->employer_company_name : '' }}" required />
                                </div>
                                <div class="form-group">
                                    <label>Contact Person Name*</label>
                                    <input type="text" class="form-control" placeholder="Add contact person name"
                                        name="employer_contact_person"
                                        value="{{ count($data) ? $data[0]->employer_contact_person : '' }}" required />
                                </div>
                                <div class="form-group">
                                    <label>CIN or GST Number(Optional)</label>
                                    <input type="text" class="form-control" placeholder="Add CIN / GST"
                                        name="employer_gst" value="{{ count($data) ? $data[0]->employer_gst : '' }}" />
                                </div>
                                <div class="form-group form-outline mb-4 d-flex company-type">
                                    <div class="col">
                                        <label class="form-label" for="form1Example1">Company Type
                                            <span>*</span></label>
                                        <div class="form-button">
                                            <button id="company_name" class="company" type="button" onclick="companyType(1)"
                                                style="border : {{ count($data) && $data[0]->employer_company_type == 1 ? '2px solid' : 'solid 1px rgb(40, 40, 40, 0.6)' }}"><span>
                                                    <embed
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/companytypeicon.svg') }}"
                                                        type="image/svg+xml">
                                                </span> Company</button>

                                            <button id="consultancy_name" class="consultancy" type="button" onclick="companyType(2)"
                                                style="border : {{ count($data) && $data[0]->employer_company_type == 2 ? '2px solid' : 'solid 1px rgb(40, 40, 40, 0.6)' }}"><span>
                                                    <embed
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/consultancytypeicon.svg') }}"
                                                        type="image/svg+xml">
                                                </span> Consultancy</button>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="employer_company_type" id="employer_company_type"
                                    value="{{ count($data) ? $data[0]->employer_company_type : '' }}"
                                    class="form-control" />

                                <div class="form-group relative">
                                    <label>Company Address*</label>
                                    <textarea name="employer_address" rows="5" minlength="10" maxlength="300"
                                        placeholder="Add current company / Consultancy addrees" class="form-control" required>{{ count($data) ? $data[0]->employer_address : '' }}</textarea>
                                    <div class="counter" id="the-count">
                                        <span id="current">0</span>
                                        <span id="maximum">/ 300</span>
                                    </div>

                                </div>
                                @php
                                    $employerLocation = '';
                                    if (count($data) && $data[0]->employer_location != '') {
                                        $getCityInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getCityInfo($data[0]->employer_location);
                                        if (count($getCityInfo)) {
                                            $employerLocation = $getCityInfo[0]->city_name;
                                        } else {
                                            $employerLocation = $data[0]->employer_location;
                                        }
                                    }
                                @endphp
                                <div class="form-group d-flex">
                                    <div class="form-outline">
                                        <label>Location*</label>
                                        <div style="position:relative" class="autocomplete_ui_parent">
                                            <input type="text" placeholder="Select Current Location"
                                                name="employer_location"
                                                class="form-control autocomplete_actual_id employer_location" required
                                                value="{{ $employerLocation }}" />
                                            <input type="hidden" name="employer_location_hidden" class="autocomplete_id"
                                                value="{{ count($data) ? $data[0]->employer_location : '' }}">
                                            <div class="autocomplete-items" style="display:none">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-outline">
                                        <label>Pincode*</label>
                                        <input type="number" name="employer_pincode" class="form-control"
                                            placeholder="Add pincode" required minlength="6" maxlength="6"
                                            value="{{ count($data) ? $data[0]->employer_pincode : '' }}" />
                                    </div>
                                </div>
                                <div class="form-group relative">
                                    <label>About Company*</label>
                                    <textarea name="employer_about_company" rows="5" minlength="10" maxlength="500"
                                        placeholder="Add about company" class="form-control" required>{{ count($data) ? $data[0]->employer_about_company : '' }}</textarea>
                                    <div class="counter" id="the-count1">
                                        <span id="current1">0</span>
                                        <span id="maximum1">/ 500</span>
                                    </div>
                                </div>
                                <div class="form-group file-select">
                                    <label>Company Logo (2x4) :</label>
                                    <div class="input-group">
                                        <label for="upload-photo">.jpg .png .svg</label>
                                        <input type="file" class="form-control" name="employer_company_logo"
                                            aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                        <button class="btn btn-outline-secondary" type="button">
                                            <span><img src="{{ URL::asset(FRONTEND . '/assets/images/attach.svg') }}" />
                                            </span> Attach</button>
                                    </div>
                                    @if (isset($data) && $data[0]->employer_company_logo != '')
                                        <span><img style="width: 100%;height: 200px;margin-top: 1em;"
                                                src="{{ URL::asset('uploads/employer/company/' . $data[0]->employer_company_logo) }}"></span>
                                    @endif
                                </div>
                                <input type="hidden" name="edit_image"
                                    value="{{ isset($data) ? $data[0]->employer_company_logo : '' }}">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"> Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                        <img src="{{ URL::asset(FRONTEND . '/assets/images/employersregistration.svg') }}" />
                        <img src="{{ URL::asset(FRONTEND . '/assets/images/employersregistration1.svg') }}" />
                        <img src="{{ URL::asset(FRONTEND . '/assets/images/employersregistration2.svg') }}" />
                    </div>
                </div>
            </div>
        </div>
    </main>

@stop

<script>
    const companyType = (value) => {
        let s = document.getElementById('employer_company_type');
        s.value = value;
        document.getElementById("company_name").style.border = "solid 1px rgb(40, 40, 40, 0.6)";
        document.getElementById("consultancy_name").style.border = "solid 1px rgb(40, 40, 40, 0.6)";
        if(value == 1){
            document.getElementById("company_name").style.border = "2px solid";
        }

        if(value == 2){
            document.getElementById("consultancy_name").style.border = "2px solid";
        }

    }
</script>
