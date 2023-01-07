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
                                                </span>{{ isset(SalaryLakhs()[$employerPostList->employer_post_experience_from - 1]) ? SalaryLakhs()[$employerPostList->employer_post_experience_from - 1] : '' }}-
                                                {{ isset(SalaryLakhs()[$employerPostList->employer_post_experience_to - 1]) ? SalaryLakhs()[$employerPostList->employer_post_experience_to - 1] : '' }}
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
                                                @if ($employerPostList->employer_post_save_status == 1)
                                                    <a style="padding: 6px 30px;
                                                        margin: 0;
                                                        font-size: 14px;
                                                        line-height: 1.5;"
                                                        href="{{ route('employerjobpost') . '?mode=edit&id=' . encryption($employerPostList->employer_post_id) }}"
                                                        data-post="{{ encryption($employerPostList->employer_post_id) }}"
                                                        class="btn btn-primary">Edit</a>
                                                @elseif ($employerPostList->employer_post_save_status == 2)
                                                    <button type="button"
                                                        data-post="{{ encryption($employerPostList->employer_post_id) }}"
                                                        class="btn btn-primary form_prefil">Prefill</button>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <span
                                    class="job-post-mail">{{ $employerPostList->employer_post_save_status == 1 ? 'saved' : 'posted' }}
                                    on {{ date('d M Y', $postDate) }} by
                                    Email : {{ $employerEmail }}</span>

                            @empty
                                <div> No Post / Saved Jobs found</div>
                            @endforelse


                            @if ($totalPagination > 1 && $currentpage <= $totalPagination)
                                <div class="pagination">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination pg-blue justify-content-center">
                                            <li class="page-item">
                                                <a {{ $currentpage == 1 ? 'disabled' : '' }}
                                                    style="cursor : {{ $currentpage == 1 ? 'not-allowed' : 'pointer' }}"
                                                    class="page-link"
                                                    href="{{ route('employerjobpost') . '?page=' . $currentpage - 1 }}">
                                                    <span>
                                                        <img
                                                            src="{{ URL::asset(FRONTEND . '/assets/images/arrowleft.svg') }}" />
                                                    </span>
                                                    Previous
                                                </a>
                                            </li>
                                            @for ($l = 1; $l <= $totalPagination; $l++)
                                                <li class="page-item {{ $currentpage == $l ? 'active' : '' }}">
                                                    <a href="{{ route('employerjobpost') . '?page=' . $l }}"
                                                        class="page-link">{{ $l }}</a>
                                                </li>
                                            @endfor


                                            <li class="page-item">
                                                <a {{ $currentpage == $totalPagination ? 'disabled' : '' }}
                                                    style="cursor : {{ $currentpage == $totalPagination ? 'not-allowed' : 'pointer' }}"
                                                    class="page-link"
                                                    href="{{ route('employerjobpost') . '?page=' . $currentpage + 1 }}">Next
                                                    <span><img
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
