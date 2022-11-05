@extends('frontend.employer.layout')
@section('title', 'Employer Company')
@section('content')

    <main>
        <div class="employers-registration-confirmation">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="title">
                            <h1>Add / Edit company details</h1>
                            <p>It only takes a couples of minutes to get started</p>
                        </div>
                        <div class="form">
                            <form autocomplete="off">
                                <div class="form-group">
                                    <label>Company Name*</label>
                                    <input type="text" class="form-control bg"
                                        placeholder="ISOPARA Engineering Services Pvt Ltd" required />
                                </div>
                                <div class="form-group">
                                    <label>Official Email*</label>
                                    <input type="email" class="form-control bg" placeholder="hr@isopara.com"  required/>
                                </div>
                                <div class="form-group">
                                    <label>Mobile Number*</label>
                                    <input type="number" class="form-control" placeholder="Add mobile number" required />
                                </div>
                                <div class="form-group">
                                    <label>Contact Person Name*</label>
                                    <input type="text" class="form-control" placeholder="Add contact person name" required/>
                                </div>
                                <div class="form-group">
                                    <label>Contact Person Name*</label>
                                    <input type="text" class="form-control" placeholder="Add contact person name" required/>
                                </div>
                                <div class="form-group form-outline mb-4 d-flex company-type">
                                    <div class="col">
                                        <label class="form-label" for="form1Example1">Company Type
                                            <span>*</span></label>
                                        <div class="form-button">
                                            <button type="button"><span>
                                                    <embed
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/companytypeicon.svg') }}"
                                                        type="image/svg+xml">
                                                </span> Company</button>

                                            <button class="bg" type="button"><span>
                                                    <embed
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/consultancytypeicon.svg') }}"
                                                        type="image/svg+xml">
                                                </span> Consultancy</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group relative">
                                    <label>Company Address</label>
                                    <textarea name="the-textarea" id="the-textarea" rows="5" maxlength="300"
                                        placeholder="Add current company / Consultancy addrees" class="form-control" required></textarea>
                                    <div class="counter" id="the-count">
                                        <span id="current">0</span>
                                        <span id="maximum">/ 300</span>
                                    </div>

                                </div>
                                <div class="form-group d-flex">
                                    <div class="form-outline">
                                        <label>Location*</label>
                                        <select class="form-control" required>
                                            <option selected>Add Location</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="form-outline">
                                        <label>Pincode*</label>
                                        <input type="text" class="form-control" placeholder="Add pincode" required/>
                                    </div>
                                </div>
                                <div class="form-group relative">
                                    <label>About Company</label>
                                    <textarea name="the-textarea1" id="the-textarea1" rows="5" maxlength="300" placeholder="Add company profile"
                                        class="form-control"></textarea>
                                    <div class="counter" id="the-count1">
                                        <span id="current1">0</span>
                                        <span id="maximum1">/ 300</span>
                                    </div>
                                </div>
                                <div class="form-group file-select">
                                    <label>Company Logo (2x4) :</label>
                                    <div class="input-group">
                                        <label for="upload-photo">.jpg .png .svg</label>
                                        <input type="file" class="form-control" id="inputGroupFile04"
                                            aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                        <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">
                                            <span><img src="{{ URL::asset(FRONTEND . '/assets/images/attach.svg') }}" />
                                            </span> Attach</button>
                                    </div>
                                </div>
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
