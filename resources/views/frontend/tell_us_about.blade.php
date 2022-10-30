@extends('frontend.layout')
@section('title', 'Tell Us About You')
@section('content')

    <main>
        <div class="email-registration number-verification mobile-numberverification-successful">
            <div class="container bg-bluelight">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Tell us about you !</h1>
                        <form>
                            <p class="mt-40">Have you experience ? *</p>
                            <div class="form-group form-check">
                                <p>
                                    <input type="radio" id="test1" name="radio-group" checked>
                                    <label for="test1">Yes</label>
                                </p>
                                <p>
                                    <input type="radio" id="test2" name="radio-group">
                                    <label for="test2">No</label>
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Highest Qualification *</label>
                                <input type="text" class="form-control" placeholder="Select qualification" />
                            </div>
                            <div class="form-group">
                                <label>Current Designation *</label>
                                <input type="text" class="form-control" placeholder="Add designation" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"> Submit & Go to Dashbord</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>

@stop
