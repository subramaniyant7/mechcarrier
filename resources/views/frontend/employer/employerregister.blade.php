@extends('frontend.employer.layout')
@section('title', 'Employer Register')
@section('content')
    <main>
        <div class="login">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1> India's 1st <span>Mechanical</span> Recruitment Solution </h1>
                        <div class="user-image">

                            <img src="{{ URL::asset(FRONTEND . '/assets/images/registerimage1.svg') }}" />
                        </div>
                        <br />
                        <div class="key-points">
                            <h4>Key Points</h4>
                            <ul>
                                <li>Free job post and search resume</li>
                                <li>Easy to short list profile</li>
                                <li>Quality user database</li>
                            </ul>
                        </div>
                        <div class="help-assistance">
                            <p>For technical assitance please call to +91-8329556560</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="login-form">
                            <div class="title desktop">
                                <h1>Register for Recruiter</h1>
                                <p>If you already have an account register
                                </p>
                                <p>You can <a href="{{ route('employerlogin') }}" >Login here !</a></p>
                            </div>
                            <form autocomplete="off">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form1Example1">Company Name <span>*</span></label>
                                    <input type="text" id="form1Example1" placeholder="Add Company Name"
                                        class="form-control" required/>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form1Example1">Official Email <span>*</span></label>
                                    <input type="email" id="form1Example1" placeholder="add Official Email"
                                        class="form-control" required />
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form1Example1">Mobile Number <span>*</span></label>
                                    <input type="number" id="form1Example1" placeholder="+91| Mobile Number"
                                        class="form-control" required/>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form1Example1">Contact Person Name <span>*</span></label>
                                    <input type="text" id="form1Example1" placeholder="Contact Person Name"
                                        class="form-control" required/>
                                </div>

                                <div class="form-outline mb-4 d-flex company-type">
                                    <div class="col">
                                        <label class="form-label" for="form1Example1">Company Type <span>*</span></label>
                                        <div class="form-button">
                                            <button type="button"><span>
                                                    <embed
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/companytypeicon.svg') }}"
                                                        type="image/svg+xml" />
                                                </span> Company</button>

                                            <button type="button"><span>
                                                    <embed
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/consultancytypeicon.svg') }}"
                                                        type="image/svg+xml" />
                                                </span> Consultancy</button>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <div class="col">
                                        <div class="error-msg">
                                            <span> Error : Fill all fileds</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <div class="col text-left">
                                        <div class="form-check register-privacy">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="form1Example3" checked />
                                            <label class="form-check-label" for="form1Example3"> By registering, you agree
                                                to our terms & condition & privacy policy </label>
                                        </div>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary btn-block">Continue</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </main>

@stop
