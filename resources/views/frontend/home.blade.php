@extends('frontend.layout')
@section('title', 'India’s 1st Job portal for Mechanical Engineer')
@section('description', 'Best job portal for mechanical fresher & experienced candidates. Free register & apply for a job in the mechanical industry for design, quality, production, maintenance, etc.')
@section('content')
    <main>
        @php
            $bannerContent = getActiveRecord('banner_content');
            $title = $description = $bgImage = $companyName = $logo = '';
            if (count($bannerContent)) {
                $title = $bannerContent[0]->banner_title;
                $description = $bannerContent[0]->banner_description != '' ? explode(',', $bannerContent[0]->banner_description) : [];
                $bgImage = $bannerContent[0]->banner_image;
                $companyName = $bannerContent[0]->company_name;
                $logo = $bannerContent[0]->company_logo;
            }
        @endphp
        <div class="mech-banner" style="background-image: url({{ URL::asset('uploads/homepage/' . $bgImage) }})">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <h1 style="width: 38%;">
                            {{ $title }}
                        </h1>
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


        <!--section-0-->

        <div class="mech-search">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 home-page">
                        <div class="title">
                            <h1>Find Your Dream Job Now</h1>
                            <h3>5000+ Jobs For You To Explore</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="search-form">
                            <form action="{{ route('jobsearch') }}" method="GET">
                                <div class="form-outline">
                                    <div class="d-flex" style="background:#fff;border-radius:24px;">
                                        <span><img
                                                src="{{ URL::asset(FRONTEND . '/assets/images/home/searchicon.svg') }}" /></span>
                                        <input type="text" placeholder="Enter skills/ designation/ companies"
                                            class="form-control form-skills" name="skil" required />
                                        <span class="map-icon">
                                            <img
                                                src="{{ URL::asset(FRONTEND . '/assets/images/home/mapicon.svg') }}" /></span>
                                        <span class="line-border"></span>
                                        <input type="text" name="location" placeholder="Enter Location" class="form-control" />
                                        <button type="submit" class="btn-prrimary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--secrion1-->

        <div class="why-switch-career">
            <div class="container">
                @php
                    $whyWe = getActiveRecord('whywe');
                    $titleWhyWe = getMixedContentByType('whywe');
                    $whyWeTitle = '';
                    if (count($titleWhyWe)) {
                        $whyWeTitle = $titleWhyWe[0]->mixed_content_value;
                    }
                @endphp
                <div class="row">
                    <div class="col-md-12">
                        <div class="title">
                            <h1>{{ $whyWeTitle }}</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($whyWe as $why)
                        <div class="col-md-3">
                            <div class="why-card">
                                <img style="width:100%" src="{{ URL::asset('uploads/whywe/' . $why->whywe_image) }}" />
                                <div class="item-title">
                                    <p>{{ $why->whywe_name }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!--- Section2 -->

        <div class="featured-companies">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title">
                            @php
                                $titleContent = getMixedContentByType('company_title');
                                $companyTitle = '';
                                if (count($titleContent)) {
                                    $companyTitle = $titleContent[0]->mixed_content_value;
                                }
                            @endphp
                            <h1>{{ $companyTitle }}</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @php
                        $companyMapped = getActiveRecord('company_mapping');
                        if (count($companyMapped)) {
                            $companyMapped = json_decode(json_encode($companyMapped, true));
                            usort($companyMapped, function ($a, $b) {
                                return strcmp($a->company_position, $b->company_position);
                            });
                        }
                    @endphp
                    @if (count($companyMapped))
                        @foreach ($companyMapped as $company)
                            <div class="col-md-3">
                                <div class="feature-card">
                                    <div class="featured-image">
                                        <img style="width: 100%;min-height: 100px;max-height: 100px;"
                                            src="{{ URL::asset('uploads/company_mapping/' . $company->company_image) }}" />
                                    </div>
                                    <div class="featured-title">
                                        <h4>{{ $company->company_jobcount }} Jobs Available</h4>
                                        <a href="#" target="_blank">View Jobs <span><img
                                                    src="{{ URL::asset(FRONTEND . '/assets/images/home/arrowsvgicon.svg') }}" /></span></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if (count($companyMapped) != 8)
                        @for ($i = 1; $i <= 8 - count($companyMapped); $i++)
                            <div class="col-md-3">
                                <div class="feature-card">
                                    <div class="featured-image">
                                        <img style="width: 100%;min-height: 100px;max-height: 100px;"
                                            src="{{ URL::asset(FRONTEND . '/assets/images/home/fc1.svg') }}" />
                                    </div>
                                    <div class="featured-title">
                                        <h4>8 Jobs Available</h4>
                                        <a href="#" target="_blank">View Jobs <span><img
                                                    src="{{ URL::asset(FRONTEND . '/assets/images/home/arrowsvgicon.svg') }}" /></span></a>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @endif

                </div>

                <div class="row home-button">
                    <div class="col-md-12">
                        <button type="button" class="home-button"> View all companies </button>
                    </div>
                </div>
            </div>
        </div>

        <!--section3-->


        @if (count($careerBuild) && count($main))
            <div class="enhance-your-resume">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 home-page">
                            <div class="title">
                                <h1>{{ $main[0]->home_careerbuild_main_title }}</h1>
                                <p>{{ $main[0]->home_careerbuild_main_subtitle }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="owl-carousel owl-theme">
                            @foreach ($careerBuild as $k => $careerbuild)
                                <div class="item">
                                    <div class="enhance-your-resume-card">
                                        <div class="enhance-your-resume-image">
                                            <img style="width:100%; display:inline-block;"
                                                src="{{ URL::asset('uploads/homecareerbuild/' . $careerbuild->home_careerbuild_image) }}" />
                                        </div>
                                        <div class="enhance-your-resume-card-title">
                                            <h4>{{ $careerbuild->home_careerbuild_name }}</h4>
                                            <p>{{ strlen($careerbuild->home_careerbuild_description) > 50 ? substr($careerbuild->home_careerbuild_description, 0, 50) . '...' : $careerbuild->home_careerbuild_description }}
                                            </p>
                                            <a href="{{ $careerbuild->home_careerbuild_url }}" target="_blank">Read
                                                More<span>
                                                    <img
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/home/arrowsvgicon.svg') }}" /></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row home-button">
                        <div class="col-md-12">
                            <a href="{{ $main[0]->home_careerbuild_main_url }}" target="_blank" class="home-button">
                                Explore All </a>
                        </div>
                    </div>
                </div>

            </div>
        @endif

        <!--section4-->

        @if (count($trainingCenter))
            <div class="enhance-your-resume training-partner">
                @php
                    $trainingCenter = json_decode(json_encode($trainingCenter, true), true);

                    usort($trainingCenter, function ($a, $b) {
                        return strcmp($a->training_center_position, $b->training_center_position);
                    });
                @endphp
                @foreach ($trainingCenter as $trainingCenter)
                    <div class="container" style="margin-bottom: 3em;">
                        <div class="row">
                            <div class="col-md-12 home-page">
                                <div class="title">
                                    <h1>{{ $trainingCenter['training_center_title'] }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @php
                                usort($trainingCenter['content'], function ($a, $b) {
                                    return strcmp($a['training_center_details_position'], $b['training_center_details_position']);
                                });
                            @endphp
                            @foreach ($trainingCenter['content'] as $content)
                                <div class="col-md-3">
                                    <div class="enhance-your-resume-card">
                                        <div class="enhance-your-resume-image">
                                            <img style="width:100%"
                                                src="{{ URL::asset('uploads/hometrainingcenter/contentdetails/' . $content['training_center_details_image']) }}" />
                                        </div>
                                        <div class="enhance-your-resume-card-title">
                                            <h4>{{ $content['training_center_details_name'] }}</h4>
                                            <p>{{ strlen($content['training_center_details_description']) > 50 ? substr($content['training_center_details_description'], 0, 50) . '...' : $content['training_center_details_description'] }}
                                            </p>
                                            <a href="{{ $content['training_center_details_url'] }}" target="_blank">Read
                                                More<span><img
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/home/arrowsvgicon.svg') }}" /></span></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row home-button">
                            <div class="col-md-12">
                                <a href="{{ $trainingCenter['training_center_url'] }}" target="_blank"
                                    class="home-button"> Explore All </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </main>
@stop
