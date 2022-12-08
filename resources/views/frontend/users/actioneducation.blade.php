<style>
    .custombtn {
        display: block;
    }

    /*the container must be positioned relative:*/
    .autocomplete {
        position: relative;
        display: inline-block;
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
        background-color: #e9e9e9;
    }

    .autocomplete-items {
        border: 1px solid #d4d4d4;
        border-top: none;
        height: 100px;
        overflow: auto;
        position: absolute;
        z-index: 1;
        width: 100%;
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        text-align: left;
    }
</style>
<div style="margin-top:1em"></div>
@if ($type == 'edit')
    <span class="chevron-up"><img
            src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/chevronup.svg') }}" /></span>
@endif
<form action="#" id="action_education" class="mb-10" data="{{ $educationId }}">
    @if ($type == 'edit')
        <div class="row">
            <div class="col-md-12 delete">
                <a href="{{ route('deleteeducation', ['id' => encryption($data[0]->user_education_id)]) }}">Delete</a>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <label>Education *</label>
            <select class="form-control user_education_primary_id" name="user_education_primary_id"
                aria-label="Default select example" required>
                <option selected value="">Select Education</option>
                @foreach (getActiveRecord('education_info') as $education)
                    <option value="{{ $education->education_id }}"
                        {{ count($data) && $data[0]->user_education_primary_id == $education->education_id ? 'selected' : '' }}
                        {{ $educationId != '' && $educationId == $education->education_id ? 'selected' : '' }}>
                        {{ $education->education_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @if (($educationId != '' && $educationId <= 2) ||
        ($educationId == '' && count($data) && $data[0]->user_education_primary_id <= 2))
        <div class="row">
            <div class="col-md-12">
                <label>Course / board *</label>
                <select class="form-control" name="user_education_course_id" aria-label="Default select example"
                    required>
                    <option selected value="">Select Course</option>
                    @if ($educationId != '' || count($data))
                        @php
                            $id = $educationId != '' ? $educationId : (count($data) && $data[0]->user_education_primary_id ? $data[0]->user_education_primary_id : '');
                            $getCourses = \App\Http\Controllers\Frontend\Helper\HelperController::getCourseByEducationId($id);
                        @endphp
                        @foreach ($getCourses as $course)
                            <option value="{{ $course->course_board_id }}"
                                {{ count($data) && $data[0]->user_education_course_id == $course->course_board_id ? 'selected' : '' }}>
                                {{ $course->course_board_name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    @endif
    @if (($educationId != '' && $educationId > 2) ||
        ($educationId == '' && count($data) && $data[0]->user_education_primary_id > 2))
        <div class="row">
            <div class="col-md-12">
                <label>Specialization *</label>
                @php
                    $specializationName = '';
                    if (count($data) && $data[0]->user_education_specialization != '') {
                        $getSpecialization = \App\Http\Controllers\Frontend\Helper\HelperController::getSpecializationInfo($data[0]->user_education_specialization);
                        if (count($getSpecialization)) {
                            $specializationName = $getSpecialization[0]->education_specialization_name;
                        } else {
                            $specializationName = $data[0]->user_education_specialization;
                        }
                    }
                @endphp
                <div style="position:relative" class="autocomplete_ui_parent">
                    <input type="text" placeholder="Add Specialization" name="user_education_specialization"
                        class="form-control autocomplete_actual_id user_education_specialization" required
                        value="{{ $specializationName }}" />
                    <input type="hidden" name="current_specialization" class="autocomplete_id"
                        value="{{ count($data) ? $data[0]->user_education_specialization : '' }}">
                    <div class="autocomplete-items" style="display:none">
                    </div>
                </div>

                {{-- <select class="form-control" name="user_education_specialization" aria-label="Default select" required>
                    <option selected value="">Select Specialization</option>
                    @if ($educationId != '' || count($data))
                        @php
                            $id = $educationId != '' ? $educationId : (count($data) && $data[0]->user_education_primary_id ? $data[0]->user_education_primary_id : '');
                            $getSpecialization = \App\Http\Controllers\Frontend\Helper\HelperController::getSpecializationByEducationId($id);
                        @endphp
                        @foreach ($getSpecialization as $specialization)
                            <option value="{{ $specialization->education_specialization_id }}"
                                {{ count($data) && $data[0]->user_education_specialization == $specialization->education_specialization_id ? 'selected' : '' }}>
                                {{ $specialization->education_specialization_name }}</option>
                        @endforeach
                    @endif
                </select> --}}
            </div>
        </div>
    @endif
    @if (($educationId != '' && $educationId > 2) ||
        ($educationId == '' && count($data) && $data[0]->user_education_primary_id > 2))
        <div class="row">
            <div class="col-md-12">
                <label>University/Institute *</label>
                @php
                    $universityName = '';
                    if (count($data) && $data[0]->user_education_university != '') {
                        $getUniversity = \App\Http\Controllers\Frontend\Helper\HelperController::getUniversityInfo($data[0]->user_education_university);
                        if (count($getUniversity)) {
                            $universityName = $getUniversity[0]->education_university_name;
                        } else {
                            $universityName = $data[0]->user_education_university;
                        }
                    }
                @endphp
                <div style="position:relative" class="autocomplete_ui_parent">
                    <input type="text" placeholder="Add University/Institute" name="user_education_university"
                        class="form-control autocomplete_actual_id user_education_university" required
                        value="{{ $universityName }}" />
                    <input type="hidden" name="current_university" class="autocomplete_id"
                        value="{{ count($data) ? $data[0]->user_education_university : '' }}">
                    <div class="autocomplete-items" style="display:none">
                    </div>
                </div>
                {{-- <select class="form-control" name="user_education_university" aria-label="Default select" required>
                    <option selected value="">Select University/Institute</option>
                    @if ($educationId != '' || count($data))
                        @php
                            $id = $educationId != '' ? $educationId : (count($data) && $data[0]->user_education_primary_id ? $data[0]->user_education_primary_id : '');
                            $getUniversity = \App\Http\Controllers\Frontend\Helper\HelperController::getUniversityByEducationId($id);
                        @endphp
                        @foreach ($getUniversity as $university)
                            <option value="{{ $university->education_university_id }}"
                                {{ count($data) && $data[0]->user_education_university == $university->education_university_id ? 'selected' : '' }}>
                                {{ $university->education_university_name }}</option>
                        @endforeach
                    @endif
                </select> --}}
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 form-checkbox">
            <p>Course type *</p>
            <div class="d-flex">
                <div class="form-check">
                    <input class="form-check-input" name="user_education_course_type"
                        {{ $type == 'add' ? 'required' : '' }} type="checkbox" value="1" id="flexCheckDefault"
                        {{ count($data) && $data[0]->user_education_course_type == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        Full time
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="user_education_course_type"
                        {{ $type == 'add' ? 'required' : '' }} type="checkbox" value="2" id="flexCheckDefault"
                        {{ count($data) && $data[0]->user_education_course_type == 2 ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        Part time
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="user_education_course_type"
                        {{ $type == 'add' ? 'required' : '' }} type="checkbox" value="3" id="flexCheckDefault"
                        {{ count($data) && $data[0]->user_education_course_type == 3 ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        Distance learning
                    </label>
                </div>
            </div>
        </div>

    </div>
    @php
        $years = Year();
        usort($years, function ($a, $b) {
            if ($a == $b) {
                return 0;
            }
            return $a > $b ? -1 : 1;
        });
    @endphp
    <div class="row">
        <div class="col-md-6">
            <label>Passing Out Year *</label>
            <select class="form-control" name="user_education_passed_year" aria-label="Default select example" required>
                <option selected value="">Select Passing Out Year</option>
                @foreach ($years as $k => $year)
                    <option value="{{ $k + 1 }}"
                        {{ count($data) && $data[0]->user_education_passed_year == $k + 1 ? 'selected' : '' }}>
                        {{ $year }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label>Marks / Grade</label>
            <select class="form-control user_education_grade" name="user_education_grade"
                aria-label="Default select example" required>
                <option selected value="">Add marks / grade</option>
                @foreach (educationGrades() as $k => $grades)
                    <option value="{{ $k + 1 }}" {{ count($data) && $data[0]->user_education_grade == $k + 1 ? 'selected' : '' }}>{{ $grades }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row showmarks"
        style="display: {{ count($data) && $data[0]->user_education_grade < 4 ? 'block' : 'none' }}">
        <div class="col-md-12">
            <label>Marks *</label>
            <input type="number" step="0.1" placeholder="Enter Marks" class="form-control" name="user_education_mark"
                {{ count($data) && $data[0]->user_education_grade != 4 ? 'required' : '' }}
                value="{{ count($data) ? $data[0]->user_education_mark : '' }}">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-buttons custombtn">
                <button type="button" class="btn btn-cancel cancel_education">Cancel</button>
                <button type="submit" class="btn btn-save">Save</button>
            </div>
        </div>
    </div>

    <input type="hidden" name="user_education_id"
        value="{{ count($data) ? encryption($data[0]->user_education_id) : '' }}">
</form>

<script>
    $(document).on('click', "input[type=checkbox][name=user_education_course_type]", function() {
        let checkedState = this.checked
        let current = this;
        $("input[type=checkbox][name=user_education_course_type]").each(function() {
            if (current != this) {
                this.checked = !checkedState;
                $(this).removeAttr('required')
                $(this).removeAttr('checked')
            } else {
                $(this).attr('required', 'required')
            }
        });
    })
</script>
