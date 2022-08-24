@extends('frontend.layout')
@section('title', 'Mobile OTP Verification Success')
@section('content')
    <main>
        <div class="email-registration email-success">
            <div class="container bg-bluelight">
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ URL::asset(FRONTEND.'/assets/images/home/mobileregistrationicon.svg')}}" />
                        <h1>Your Mobile number has been verified</h1>
                        <h2> <span>Thank you for your support now you can proceed for dashbord</span></h2>
                        <br/><br/>
                        <button type="submit" class="btn btn-primary">Dashboard</button> <br/>
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
