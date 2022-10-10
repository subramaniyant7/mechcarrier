<style>
    .custombtn {
        display: block;
    }
</style>
<div style="margin-top:1em"></div>
@if ($type != 'add')
    <span class="chevron-up"><img
            src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/chevronup.svg') }}" /></span>
@endif
<form action="#" id="action_education">
    @if ($type != 'add')
        <div class="row">
            <div class="col-md-12 delete">
                <a href="{{ route('deleteeducation', ['id' => encryption($data[0]->user_education_id)]) }}">Delete</a>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <label>Education *</label>
            <select class="form-control" name="user_education_primary_id" aria-label="Default select example" required>
                <option selected value="">Select Education</option>
                @foreach (education() as $k => $education)
                    <option value="{{ $k + 1 }}"
                        {{ count($data) && $data[0]->user_education_primary_id == $k + 1 ? 'selected' : '' }}>
                        {{ $education }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label>Course / board *</label>
            <select class="form-control" name="user_education_course_id" aria-label="Default select example" required>
                <option selected value="">Select Course</option>
                @foreach (courses() as $k => $education)
                    <option value="{{ $k + 1 }}"
                        {{ count($data) && $data[0]->user_education_course_id == $k + 1 ? 'selected' : '' }}>
                        {{ $education }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label>Specialization *</label>
            <select class="form-control" name="user_education_specialization" aria-label="Default select example"
                required>
                <option selected value="">Select Specialization</option>
                @foreach (specialization() as $k => $education)
                    <option value="{{ $k + 1 }}"
                        {{ count($data) && $data[0]->user_education_specialization == $k + 1 ? 'selected' : '' }}>
                        {{ $education }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label>University/Institute *</label>
            <select class="form-control" name="user_education_university" aria-label="Default select example" required>
                <option selected value="">Select University/Institute</option>
                @foreach (university() as $k => $education)
                    <option value="{{ $k + 1 }}"
                        {{ count($data) && $data[0]->user_education_university == $k + 1 ? 'selected' : '' }}>
                        {{ $education }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-checkbox">
            <p>Course type *</p>
            <div class="d-flex">
                <div class="form-check">
                    <input class="form-check-input" name="user_education_course_type" required type="checkbox"
                        value="1" id="flexCheckDefault"
                        {{ count($data) && $data[0]->user_education_course_type == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        Full time
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="user_education_course_type" required type="checkbox"
                        value="2" id="flexCheckDefault"
                        {{ count($data) && $data[0]->user_education_course_type == 2 ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        Part time
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="user_education_course_type" required type="checkbox"
                        value="3" id="flexCheckDefault"
                        {{ count($data) && $data[0]->user_education_course_type == 3 ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        Distance learning
                    </label>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <label>Passing Out Year *</label>
            <select class="form-control" name="user_education_passed_year" aria-label="Default select example" required>
                <option selected value="">Select Passing Out Year</option>
                @foreach (Year() as $k => $year)
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
            <select class="form-control" name="user_education_grade" aria-label="Default select example" required>
                <option selected value="">Add marks / grade</option>
                @foreach (grade() as $k => $education)
                    <option value="{{ $k + 1 }}"
                        {{ count($data) && $data[0]->user_education_grade == $k + 1 ? 'selected' : '' }}>
                        {{ $education }}</option>
                @endforeach
            </select>
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
    let currentCompany = $("input[type=checkbox][name=user_education_course_type]");
    currentCompany.on("click", function() {
        let checkedState = this.checked
        let current = this;
        currentCompany.each(function() {
            if (current != this) {
                this.checked = !checkedState;
                $(this).removeAttr('required')
            } else {
                $(this).attr('required', 'required')
            }

        });
    });
</script>
