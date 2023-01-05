@extends('frontend.employer.layout')
@section('title', 'Employer - Home')
@section('content')

    <main>
        @php
            $bannerContent = getActiveRecord('banner_content');
            $title = $description = $bgImage = $companyName = $logo = '';
            if (count($bannerContent)) {
                $title = $bannerContent[0]->employer_banner_title;
                $description = $bannerContent[0]->employer_banner_description != '' ? explode(',', $bannerContent[0]->employer_banner_description) : [];
                $bgImage = $bannerContent[0]->employer_banner_image;
            }
        @endphp
        <div class="mech-banner"
            style="background-image: url({{ URL::asset('uploads/homepage/employer/' . $bgImage) }});background-color: #071021;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 style="width: 40%;margin-bottom: 20px;">
                            {{ $title }}
                        </h1>
                        <a href="{{ route('employerlogin') }}"
                            style="padding: 12px 30px;border-radius: 8px;color:#1D56BB;background: #FFFFFF;">Post Free
                            Job</a>
                        <div class="banner-links">
                            <ul>
                                @foreach ($description as $desc)
                                    <li>{{ $desc }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="why-mech-career">
            <div class="why-mech-career-title">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1> Why Mech<span>Career</span></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="why-mech-career-main">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="why-mech-card">
                                <img src="{{ URL::asset(FRONTEND . '/assets/images/whymech1.svg') }}" />
                                <p>Free 1 Job post / Month</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-mech-card">
                                <img src="{{ URL::asset(FRONTEND . '/assets/images/whymech2.svg') }}" />
                                <p>Free 50 Resume database / Month</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-mech-card">
                                <img src="{{ URL::asset(FRONTEND . '/assets/images/whymech3.svg') }}" />
                                <p>Ready screening candidate </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="why-mech-card">
                                <img src="{{ URL::asset(FRONTEND . '/assets/images/whymech4.svg') }}" />
                                <p>Graphical representation</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-mech-card">
                                <img src="{{ URL::asset(FRONTEND . '/assets/images/whymech5.svg') }}" />
                                <p>College student database</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-mech-card">
                                <img src="{{ URL::asset(FRONTEND . '/assets/images/whymech6.svg') }}" />
                                <p>Quality candidate and high exp.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>

@stop
