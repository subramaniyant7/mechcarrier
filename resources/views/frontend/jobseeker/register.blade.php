@extends('frontend.layout')
@section('title', 'Jobseeker Register')
@section('content')
    <main>
        <div class="login jobseeker-register jobseeker-login">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Let’s get Started, <br/> tell us about yourself </h1>
                        <div class="help-assistance">
                            <p>It only takes a couples of minutes to get started</p>
                        </div>

                        <div class="user-image">
                            <embed src="{{ URL::asset(FRONTEND.'/assets/images/registerimage.svg')}}" type="image/svg+xml" />
                        </div>

                        <div class="key-points">
                            <ul>
                                <li>One click apply using MechCareer profile</li>
                                <li>Get relevant job recommendations</li>
                                <li>Showcase profile to top comapnies and consultabts</li>
                                <li>Know application status on applied jobs</li>
                            </ul>
                        </div>
                        <div class="help-assistance mt-20">
                            <p>For technical assitance please call to +91-8329556560</p>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="login-form bg-gray">
                            <div class="title">
                                <h1>Register</h1>
                                <p>If you already have an account register</p>
                                <p>You can <a href="{{route('jobseekerlogin')}}" >Login here !</a></p>
                            </div>
                            <div class="socialmedia-login">
                                <div class="d-flex">
                                    <div class="google-login">
                                        <button type="submit" class="socialmedia-login-button">
                                            <span><embed src="{{ URL::asset(FRONTEND.'/assets/images/googleicon.svg') }}" type="image/svg+xml" /> </span>   Register with Google
                                        </button>
                                    </div>
                                    <div class="linkedin-login">
                                        <button type="submit" class="socialmedia-login-button">
                                            <span><embed src="{{ URL::asset(FRONTEND.'/assets/images/linkedinicon.svg')}}" type="image/svg+xml" /> </span>   Register with LinkedIn
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-text">
                                <p>or</p>
                            </div>
                            <form autocomplete="off">

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form1Example1">User Name<span>*</span></label>
                                    <div class="d-flex">
                                        <input type="text" id="form1Example1" placeholder="First Name" class="form-control" />
                                        <input type="text" id="form1Example1" placeholder="Last Name" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form1Example1">Email <span>*</span></label>
                                    <input type="email" id="form1Example1" placeholder="Enter your email address" class="form-control" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form1Example1">Mobile Number <span>*</span></label>
                                    <input type="number" id="form1Example1" placeholder="Enter yourMobile Number" class="form-control" />
                                </div>

                                <div class="form-outline password mb-4">
                                    <label class="form-label" for="form1Example2">Password <span>*</span>
                                    </label>
                                    <input type="password" id="form1Example2" placeholder="Enter your password" class="form-control"
                                           autocomplete="new-password"/>
                                    <span>
                                        <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.56348 3.90109L9.76236 5.94407L9.77283 5.83706C9.77283 4.76367 8.83395 3.89136 7.67866 3.89136L7.56348 3.90109Z" fill="#ABABAB"/>
                                            <path d="M7.67814 2.59432C9.60473 2.59432 11.1684 4.04713 11.1684 5.83718C11.1684 6.25551 11.0776 6.65438 10.9206 7.02081L12.9623 8.91788C14.0164 8.10068 14.847 7.04352 15.3601 5.83718C14.149 2.98997 11.1719 0.9729 7.67817 0.9729C6.7009 0.9729 5.76555 1.13503 4.89648 1.42689L6.40425 2.82455C6.7986 2.68187 7.2279 2.59432 7.67814 2.59432Z" fill="#ABABAB"/>
                                            <path d="M0.698028 0.826922L2.28956 2.30565L2.60717 2.60076C1.45541 3.43741 0.54447 4.54971 0 5.8371C1.20762 8.68429 4.18823 10.7013 7.67844 10.7013C8.76041 10.7013 9.79349 10.5068 10.7393 10.1533L11.036 10.4289L13.0708 12.3228L13.9608 11.4991L1.58803 0L0.698028 0.826922ZM4.5582 4.41026L5.63667 5.4123C5.60526 5.55175 5.58432 5.69117 5.58432 5.8371C5.58432 6.91049 6.52317 7.7828 7.67844 7.7828C7.83549 7.7828 7.98558 7.76334 8.13217 7.73415L9.21064 8.73619C8.74643 8.95022 8.22991 9.07994 7.67844 9.07994C5.75185 9.07994 4.18823 7.62714 4.18823 5.8371C4.18823 5.32474 4.32785 4.84479 4.5582 4.41026Z" fill="#ABABAB"/>
                                            </svg>


                                    </span>
                                </div>

                                <div class="form-outline password mb-4">
                                    <label class="form-label" for="form1Example2">ConfirmPassword <span>*</span>
                                    </label>
                                    <input type="password" id="form1Example2" placeholder="RE-Enter your password" class="form-control" />
                                    <span>
                                        <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.56348 3.90109L9.76236 5.94407L9.77283 5.83706C9.77283 4.76367 8.83395 3.89136 7.67866 3.89136L7.56348 3.90109Z" fill="#ABABAB"/>
                                            <path d="M7.67814 2.59432C9.60473 2.59432 11.1684 4.04713 11.1684 5.83718C11.1684 6.25551 11.0776 6.65438 10.9206 7.02081L12.9623 8.91788C14.0164 8.10068 14.847 7.04352 15.3601 5.83718C14.149 2.98997 11.1719 0.9729 7.67817 0.9729C6.7009 0.9729 5.76555 1.13503 4.89648 1.42689L6.40425 2.82455C6.7986 2.68187 7.2279 2.59432 7.67814 2.59432Z" fill="#ABABAB"/>
                                            <path d="M0.698028 0.826922L2.28956 2.30565L2.60717 2.60076C1.45541 3.43741 0.54447 4.54971 0 5.8371C1.20762 8.68429 4.18823 10.7013 7.67844 10.7013C8.76041 10.7013 9.79349 10.5068 10.7393 10.1533L11.036 10.4289L13.0708 12.3228L13.9608 11.4991L1.58803 0L0.698028 0.826922ZM4.5582 4.41026L5.63667 5.4123C5.60526 5.55175 5.58432 5.69117 5.58432 5.8371C5.58432 6.91049 6.52317 7.7828 7.67844 7.7828C7.83549 7.7828 7.98558 7.76334 8.13217 7.73415L9.21064 8.73619C8.74643 8.95022 8.22991 9.07994 7.67844 9.07994C5.75185 9.07994 4.18823 7.62714 4.18823 5.8371C4.18823 5.32474 4.32785 4.84479 4.5582 4.41026Z" fill="#ABABAB"/>
                                            </svg>


                                    </span>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="error-msg">
                                            <span> Error : Passward not match</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="termsandconditions">
                                            <span> terms and conditions</span>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </main>
@stop
