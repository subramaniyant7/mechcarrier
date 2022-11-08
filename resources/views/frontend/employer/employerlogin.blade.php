@extends('frontend.employer.layout')
@section('title', 'Employer Login')

@section('content')
    <main>
        <div class="login">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1> India's 1st <span>Mechanical</span> Recruitment Solution </h1>
                        <div class="user-image">
                            <img src="{{ URL::asset(FRONTEND . '/assets/images/emplogin.svg') }}" />
                        </div>
                        <div class="help-assistance">
                            <p>For technical assitance please call to +91-8329556560</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="login-form">
                            <div class="title desktop">
                                <h1>Login</h1>
                                <p>If you don’t have an account register</p>
                                <p>You can <a href="{{ route('employerregister') }}">Register here !</a></p>
                            </div>
                            <form autocomplete="off" action="{{ route('employerloginvalidate') }}" method="POST">
                                @csrf
                                <div class="form-outline mb-4">
                                    <label class="form-label">Email <span>*</span></label>
                                    <input type="email" name="employer_email" placeholder="Enter your email address"
                                        class="form-control" required />
                                </div>

                                <div class="form-outline password mb-4">
                                    <label class="form-label">Password <span>*</span>
                                    </label>
                                    <input type="password" autocomplete="new-password" name="employer_password"
                                        placeholder="Enter your password" class="form-control view" required />
                                    <span> <img onclick="viewText(this)" src="{{ URL::asset(FRONTEND . '/assets/images/passwordshowicon.svg') }}" style="cursor:pointer" />
                                    </span>
                                </div>

                                <div class="form-outline">
                                    <div class="col d-flex">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="form1Example3" checked />
                                            <label class="form-check-label"> Remember me </label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <a href="#!">Forgot password?</a>
                                    </div>
                                </div>

                                @if (session('error'))
                                    <div class="form-outline mb-3">
                                        <div class="col">
                                            <div class="error-msg">
                                                <span> {{ session('error') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </main>


@stop

<script>
    function viewText(val) {
        let element = $(val).parent().parent().find(".view");
        if (element.attr('type') === "password") {
            element.attr('type', "text");
        } else {
            element.attr('type', "password");
        }
    }
</script>
