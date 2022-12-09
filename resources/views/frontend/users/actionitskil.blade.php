<style>
    .custombtn {
        display: block;
    }
</style>
@if ($type != 'add')
    <span class="chevron-up"><img
            src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/chevronup.svg') }}" /></span>
@endif
<form action="#" id="action_itskill" class="mt-10">
    @if ($type != 'add')
        <div class="row">
            <div class="col-md-12 delete">
                <a href="{{ route('deleteitskill', ['id' => encryption($data[0]->user_itskil_id)]) }}">Delete</a>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <label>Software / skill Name *</label>
            <input type="text" placeholder="Add software / skill name" class="form-control" name="user_itskil_skil_name"
                required value="{{ count($data) ? $data[0]->user_itskil_skil_name : '' }}">
        </div>
    </div>
    <div class="row form-selectbox">
        <div class="col-md-6">
            <label>Experience *</label>
            <div class="d-flex">
                <select class="form-control" name="user_itskil_experience_year" required
                    aria-label="Default select example">
                    <option selected="" value="">Year</option>
                    @foreach (experience() as $k => $experience)
                        <option value="{{ $k + 1 }}"
                            {{ count($data) && $data[0]->user_itskil_experience_year == $k + 1 ? 'selected' : '' }}>
                            {{ $experience }}
                        </option>
                    @endforeach
                </select>
                <select class="form-control" name="user_itskil_experience_month" required
                    aria-label="Default select example">
                    <option selected="" value="">Month</option>
                    @foreach (Months() as $k => $month)
                        <option value="{{ $k + 1 }}"
                            {{ count($data) && $data[0]->user_itskil_experience_month == $k + 1 ? 'selected' : '' }}>
                            {{ $month }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-buttons custombtn">
                <button type="button" class="btn btn-cancel cancel_itskill">Cancel</button>
                <button type="submit" class="btn btn-save">Save</button>
            </div>
        </div>
    </div>

    <input type="hidden" name="user_itskil_id" value="{{ count($data) ? encryption($data[0]->user_itskil_id) : '' }}">
</form>
