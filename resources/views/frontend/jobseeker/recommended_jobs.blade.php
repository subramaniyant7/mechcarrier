<div class="recomended-jobs">
    @forelse ($data as $skilMatchJob)
        <div class="job-card">
            @php
                $employerName = $stateName = $cityName = '';
                $companyLogo = FRONTEND . '/assets/images/company_logo.svg';
                $employerInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getEmployerInfoById($skilMatchJob['employer_post_employee_id']);
                if (count($employerInfo)) {
                    $employerName = $employerInfo[0]->employer_company_name;
                    $companyLogo = $employerInfo[0]->employer_company_logo != '' ? '/uploads/employer/company/' . $employerInfo[0]->employer_company_logo : $companyLogo;
                }

                $stateInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getStateById($skilMatchJob['employer_post_location_state']);
                if (count($stateInfo)) {
                    $stateName = $stateInfo[0]->state_name;
                }
                $cityInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getCityInfo($skilMatchJob['employer_post_location_city']);
                if (count($cityInfo)) {
                    $cityName = $cityInfo[0]->city_name;
                }
            @endphp
            <div class="job-card-title">
                <div class="d-flex">
                    <h3>{{ $skilMatchJob['employer_post_headline'] }}</h3>
                    <p> {{ $employerName }}</p>
                </div>
                <img style="width:12%;height:50px;" src="{{ URL::asset($companyLogo) }}">
            </div>
            <div class="job-card-details">
                <div class="job-card-info">
                    <div class="years">
                        <p><span><img
                                    src="{{ URL::asset(FRONTEND . '/assets/images/briefccaseicon.svg') }}">
                            </span>
                            {{ SalaryLakhs()[$skilMatchJob['employer_post_experience_from'] - 1] }}-{{ SalaryLakhs()[$skilMatchJob['employer_post_experience_to'] - 1] }} Years

                        </p>
                    </div>


                    @if ($skilMatchJob['employer_post_hidesalary'] == 2)
                        <div class="salary">
                            <p><span>
                                    <img
                                        src="{{ URL::asset(FRONTEND . '/assets/images/rupeeicon.svg') }}">
                                </span>{{ SalaryLakhs()[$skilMatchJob['employer_post_salary_range_from_lakhs'] - 1] }}
                                -{{ SalaryLakhs()[$skilMatchJob['employer_post_salary_range_to_lakhs'] - 1] }}
                                Lakhs
                            </p>
                        </div>
                    @endif

                    <div class="location">
                        <p><span><img
                                    src="{{ URL::asset(FRONTEND . '/assets/images/mappinicon.svg') }}">
                            </span>{{ $stateName }}</p>
                    </div>
                </div>
                <div class="job-posted-date">
                    <h4>Posted :
                        <span>{{ date('d M Y', strtotime($skilMatchJob['created_at'])) }}</span>
                    </h4>
                </div>
            </div>
            <div class="job-card-description">
                <p class="jobpost_desc searchdescription">
                    {{ $skilMatchJob['employer_post_description'] }} </p>

                    <span>{{ strlen($skilMatchJob['employer_post_description']) > 311 ? 'more' : ''}}</span>
            </div>
            <div class="job-card-apply">
                <h4><img src="{{ URL::asset(FRONTEND . '/assets/images/filetexticon.svg') }}">
                     Key
                    skill :<span>{{ $skilMatchJob['employer_post_key_skils'] }}</span>
                </h4>
                <div class="job-card-button">
                    <button type="button" class="btn btn-primary  bg-white" style="margin-right:0.5em">Save</button>
                    <button type="button" class="btn btn-primary">Apply</button>
                </div>
            </div>
        </div>
    @empty
        <div>No Job Found</div>
    @endforelse

</div>
<div class="pagination" style="display: none;">
    <nav aria-label="Page navigation example">
        <ul class="pagination pg-blue justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" tabindex="-1">Previous</a>
            </li>
            <li class="page-item"><a class="page-link">1</a></li>
            <li class="page-item"><a class="page-link">2</a></li>
            <li class="page-item active"><a class="page-link">3</a></li>
            <li class="page-item"><a class="page-link">4</a></li>
            <li class="page-item"><a class="page-link">5</a></li>
            <li class="page-item"><a class="page-link">6</a></li>
            <li class="page-item"><a class="page-link">....</a></li>
            <li class="page-item"><a class="page-link">12</a></li>
            <li class="page-item"><a class="page-link">13</a></li>
            <li class="page-item">
                <a class="page-link">Next</a>
            </li>
        </ul>
    </nav>
</div>
