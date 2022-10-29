@extends('frontend.layout')
@section('title', 'Enter Mobile Number')
@section('content')
    <main>
        <div class="email-registration number-verification">
            <div class="container bg-bluelight">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Hello {{ $userInfo[0]->user_firstname }}</h4>
                        <h1>Please Enter Mobile Number</h1>
                        <h2>Recruitors will contact you on this number</h2>
                        <form class="mobile_number" method="POST" action="{{ route('updatemobilenumber') }}">
                            @csrf
                            <div class="d-flex">
                                <div class="email-registration-form">
                                    <div class="mobileverificationnumber">
                                        <span class="number-prefix">+91 </span>
                                        <input type="number" name="mobile_number" minlength="10" maxlength="10" required
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                            @if (session('error'))
                                <div class="error-message">
                                    <p>{{ session('error') }} </p>
                                </div>
                            @endif
                            <input type="hidden" name="user_identity" value="{{ encryption($userInfo[0]->user_id) }}">
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
