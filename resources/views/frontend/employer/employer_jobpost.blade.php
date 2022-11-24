@extends('frontend.employer.layout')
@section('title', 'Employer Job Post')
@section('content')

    <main>
        <div class="job-post">
            <div class="container job-post-title">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Create new job post <br /> or refile from history
                        </h1>
                    </div>
                    <div class="col-md-3">
                        <div class="user-progress-bar">
                            <div class="user-progress">
                                <div class="circle-wrap">
                                    <div class="circle">
                                        <div class="mask full">
                                            <div class="fill"></div>
                                        </div>
                                        <div class="mask half">
                                            <div class="fill"></div>
                                        </div>
                                        <div class="inside-circle"> 2/3 </div>
                                    </div>
                                </div>
                                <p>Job post quota - <span>add quota</span> </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <img src="{{ URL::asset(FRONTEND . '/assets/images/jobpost.svg') }}" />
                    </div>
                </div>
                <hr />
            </div>
            <div class="container job-post-main">
                <div class="row">
                    <div class="col-md-7">
                        @include('admin.notification')
                        <div class="form" id="rendered_form">
                            @include('frontend.employer.employerpost_form')
                        </div>
                    </div>
                    <div class="col-md-5">
                        <h3>Job Post / Saved history</h3>
                        <div class="similar-jobs">
                            <div class="form">
                                <form>
                                    <div class="form-group">
                                        <input type="text" placeholder="Search from history" class="form-control" />
                                    </div>
                                </form>
                            </div>
                            @forelse ($employerPost as $employerPostList)
                                @php
                                    $cities = explode(',', $employerPostList->employer_post_location_city);
                                    $employerEmail = $cityName = '';
                                    foreach ($cities as $k => $city) {
                                        $location = \App\Http\Controllers\Frontend\Helper\HelperController::getActiveCityInfo($city);
                                        if (count($location)) {
                                            $cityName .= $location[0]->city_name . (count($cities) != $k + 1 ? ',' : '');
                                        }
                                    }
                                    $postDate = strtotime($employerPostList->created_at);
                                    $employerDetails = \App\Http\Controllers\Frontend\Helper\HelperController::getEmployerInfoById($employerPostList->employer_post_employee_id);
                                    if (count($employerDetails)) {
                                        $employerEmail = $employerDetails[0]->employer_email;
                                    }
                                @endphp
                                <div class="similar-jobs-card">
                                    <div class="similar-job-card-title">
                                        <h4>{{ $employerPostList->employer_post_headline }}</h4>
                                        <div class="similar-job-card-info">
                                            <p><span><img
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/briefccaseicon.svg') }}">
                                                </span>{{ experienceGap()[$employerPostList->employer_post_experience - 1] }}
                                                Years
                                            </p>
                                            <p class="cityname"><span><img
                                                        src="{{ URL::asset(FRONTEND . '/assets/images/mappinicon.svg') }}">
                                                </span>{{ $cityName }}</p>
                                            <p><span><img src="{{ URL::asset(FRONTEND . '/assets/images/rupeeicon.svg') }}">
                                                </span>{{ $employerPostList->employer_post_salary_range_from_lakhs }} -
                                                {{ $employerPostList->employer_post_salary_range_to_lakhs }} Lakhs</p>
                                        </div>
                                        <div class="job-card-apply">
                                            <h4 style="width:65%;"> Key skill : <span
                                                    class="keyskill">{{ $employerPostList->employer_post_key_skils }}</span>
                                            </h4>


                                            <div class="job-card-button">
                                                <button type="button"
                                                    data-post="{{ encryption($employerPostList->employer_post_id) }}"
                                                    class="btn btn-primary form_prefil">Prefill</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <span class="job-post-mail">post on {{ date('d M Y', $postDate) }} by
                                    Email : {{ $employerEmail }}</span>
                            @empty
                                <div> No Post / Saved Jobs found</div>
                            @endforelse


                            @if (count($employerPost))
                                <div class="pagination">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pg-blue justify-content-center">
                                            <li class="page-item disabled">
                                                <a class="page-link" tabindex="-1"><span><img
                                                            src="{{ URL::asset(FRONTEND . '/assets/images/arrowleft.svg') }}" /></span>
                                                    Previous</a>
                                            </li>
                                            <li class="page-item"><a class="page-link">1</a></li>
                                            <li class="page-item"><a class="page-link">2</a></li>
                                            <li class="page-item active"><a class="page-link">3</a></li>
                                            <li class="page-item"><a class="page-link">4</a></li>
                                            <li class="page-item"><a class="page-link">5</a></li>
                                            <li class="page-item"><a class="page-link">....</a></li>
                                            <li class="page-item">
                                                <a class="page-link">Next <span><img
                                                            src="{{ URL::asset(FRONTEND . '/assets/images/arrowleft.svg') }}" /></span></a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@stop
