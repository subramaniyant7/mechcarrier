@extends('frontend.layout')

@section('content')
    <main>
        <div class="email-registration number-verification">
            <div class="container bg-bluelight">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Welcome firstname</h4>

                        <h1>Mobile number verification</h1>
                        <h2>Please verify your mobile number : Enter OTP send to <span>mobile_number</span></h2>
                        <div class="d-flex">
                            <div class="email-registration-form">
                                <form>
                                    <input type="email" class="form-control" />
                                    <a href="#">Resend </a>
                                </form>
                            </div>
                        </div>
                        <div class="error-message">
                            <p>Verification fail, please try again </p>
                        </div>
                        <button type="submit" class="btn btn-primary">submit</button> <br/>
                        <div class="number-d-flex">
                            <a href="#">Skip Now</a>
                            <a href="#">Change Mobile Number</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="technical-assistance">
                            <p>For technical assitance please call to +91-8329556560</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

@stop
