@extends('frontend.layout')
@section('title', 'Email Verification Success')
@section('content')
    <main>
        <div class="email-registration email-success">
            <div class="container bg-bluelight">
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ URL::asset(FRONTEND . '/assets/images/home/verificationmailicon.svg') }}" />
                        <h1>Your email address has been verified</h1>
                        <h2> <span>Thank you for your support now you can proceed for next step</span></h2>
                        <br /><br />
                        <form action="{{ route('mobileverification') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_identity" value="{{$userId}}">
                            <button type="submit" class="btn btn-primary">submit</button> <br />
                        </form>
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
