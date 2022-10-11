<style>
    .custombtn {
        display: block;
    }
</style>
<span class="chevron-up"><img src="{{ URL::asset(FRONTEND . '/assets/images/profilecreation/chevronup.svg') }}" /></span>
<form action="#" id="action_personaldetails_data">
    <div class="row">
        <div class="col-md-12 delete">
            <a href="#">Delete</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label>Gender </label>
            <select class="form-control" aria-label="Default select example" name="user_gender" required>
                <option selected="" value="">Select gender</option>
                @foreach (Gender() as $k => $gender)
                    <option value="{{ $k + 1 }}"
                        {{ count($userInfo) && $userInfo[0]->user_gender == $k + 1 ? 'selected' : '' }}>
                        {{ $gender }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label>Marital Status </label>
            <select class="form-control" name="user_marital_status" required aria-label="Default select example">
                <option selected="" value="">Select status</option>
                @foreach (Maritual() as $k => $maritual)
                    <option value="{{ $k + 1 }}"
                        {{ count($userInfo) && $userInfo[0]->user_marital_status == $k + 1 ? 'selected' : '' }}>
                        {{ $maritual }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row dob">
        <div class="col-md-6">
            <label>Date of Birth</label>
            <div class="d-flex">
                <input type="date" name="user_dob" required placeholder="Date of Birth" class="form-control"
                    value="{{ count($userInfo) ? $userInfo[0]->user_dob : '' }}">
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label>Permanent Address</label>
            <input type="text" placeholder="Add permanent address" class="form-control" name="user_permanent_address"
                required value="{{ count($userInfo) ? $userInfo[0]->user_permanent_address : '' }}">
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label>Permanent Address Pin</label>
            <input type="text" name="user_permanent_address_pin" required placeholder="Add PIN code"
                class="form-control" value="{{ count($userInfo) ? $userInfo[0]->user_permanent_address_pin : '' }}">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>Work Permit for Other Countries</label>
            <select class="form-control" name="user_work_permit" aria-label="Default select example">
                <option selected="">Select countries ( max 5 )</option>
                @foreach (Country() as $k => $country)
                    <option value="{{ $k + 1 }}"
                        {{ count($userInfo) && $userInfo[0]->user_work_permit == $k + 1 ? 'selected' : '' }}>
                        {{ $country }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>


    @foreach ($data as $language)
        <div class="row languages parentlanguage">
            <div class="col-md-3">
                <label>Languages </label>
                <br />
                <input type="hidden" name="user_language_id[]" value="{{ $language->user_language_id }}">
                <select class="form-control" name="user_language_primary_id[]" required
                    aria-label="Default select example">
                    <option selected="" value="">Add</option>
                    @foreach (language() as $k => $language1)
                        <option value="{{ $k + 1 }}"
                            {{ $language->user_language_primary_id == $k + 1 ? 'selected' : '' }}>
                            {{ $language1 }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Proficiency </label>
                <br />
                <select class="form-control" name="user_language_proficiency[]" required
                    aria-label="Default select example">
                    <option selected="" value="">Select</option>
                    @foreach (languageStrength() as $k => $languageStrength)
                        <option value="{{ $k + 1 }}"
                            {{ $language->user_language_proficiency == $k + 1 ? 'selected' : '' }}>
                            {{ $languageStrength }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 form-checkbox">
                <p>Read</p>
                <div class="d-flex">
                    <div class="form-check">
                        <input type="hidden" class="user_language_read_value" name="user_language_read_value[]" value="{{$language->user_language_read}}">
                        <input class="form-check-input enable user_language_read" data-id="user_language_read_value"
                            name="user_language_read[]" type="checkbox" value="1"
                            {{ $language->user_language_read == 1 ? 'checked' : '' }}>
                    </div>
                </div>
            </div>
            <div class="col-md-2 form-checkbox">
                <p>Write</p>
                <div class="d-flex">
                    <div class="form-check">
                        <input type="hidden" class="user_language_write_value" name="user_language_write_value[]" value="{{$language->user_language_write}}">
                        <input class="form-check-input enable user_language_write" data-id="user_language_write_value"
                            name="user_language_write[]" type="checkbox" value="1"
                            {{ $language->user_language_write == 1 ? 'checked' : '' }}>
                    </div>
                </div>
            </div>
            <div class="col-md-2 form-checkbox">
                <p>Speak</p>
                <div class="d-flex">
                    <div class="form-check">
                        <input type="hidden" class="user_language_speak_value" name="user_language_speak_value[]" value="{{$language->user_language_speak}}">
                        <input class="form-check-input enable user_language_speak" data-id="user_language_speak_value"
                            name="user_language_speak[]" type="checkbox" value="1"
                            {{ $language->user_language_speak == 1 ? 'checked' : '' }}>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @if (!count($data))
        <div class="row languages">
            <div class="col-md-3">
                <label>Languages </label>
                <br />
                <input type="hidden" name="user_language_id[]" value="">
                <select class="form-control" name="user_language_primary_id[]" required
                    aria-label="Default select example">
                    <option selected="" value="">Add</option>
                    @foreach (language() as $k => $language)
                        <option value="{{ $k + 1 }}">
                            {{ $language }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Proficiency </label>
                <br />
                <select class="form-control" name="user_language_proficiency[]" required
                    aria-label="Default select example">
                    <option selected="" value="">Select</option>
                    @foreach (languageStrength() as $k => $languageStrength)
                        <option value="{{ $k + 1 }}">
                            {{ $languageStrength }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 form-checkbox">
                <p>Read</p>
                <div class="d-flex">
                    <div class="form-check">
                        <input type="hidden" class="user_language_read_value" name="user_language_read_value[]" value="2">
                        <input class="form-check-input enable user_language_read" data-id="user_language_read_value"
                             name="user_language_read[]" type="checkbox" value="1">
                    </div>
                </div>
            </div>
            <div class="col-md-2 form-checkbox">
                <p>Write</p>
                <div class="d-flex">
                    <div class="form-check">
                        <input type="hidden" class="user_language_write_value" name="user_language_write_value[]" value="2">
                        <input class="form-check-input enable user_language_write" data-id="user_language_write_value"
                         name="user_language_write[]" type="checkbox" value="1">
                    </div>
                </div>
            </div>
            <div class="col-md-2 form-checkbox">
                <p>Speak</p>
                <div class="d-flex">
                    <div class="form-check">
                        <input type="hidden" class="user_language_speak_value" name="user_language_speak_value[]" value="2">
                        <input class="form-check-input enable user_language_speak" data-id="user_language_speak_value"
                            name="user_language_speak[]" type="checkbox" value="1">
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="new_lan_html"></div>
    <div class="row add-another">
        <div class="col-md-12">
            <a href="javascript:void(0)" class="new_language">Add Another Language</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-buttons custombtn">
                <button type="button" class="btn btn-cancel cancel_personaldetails">Cancel</button>
                <button type="submit" class="btn btn-save">Save</button>
            </div>
        </div>
    </div>

</form>


<script>
    let currentCompany = $(".enable");
    currentCompany.on("click", function() {
        let dataId = $(this).attr('data-id');
        let parent = $(this).parents('.parentlanguage');
        if ($(this).prop('checked')) {
            $(this).parent().find('.'+dataId).val(1);
        }else{
            console.log($(this).closest('.'+dataId));
            $(this).parent().find('.'+dataId).val(2);
        }

        //     console.log('parent', parent)
        //     if (dataId == 'user_language_read') {
        //         parent.find('.user_language_write').removeAttr('required');
        //         parent.find('.user_language_speak').removeAttr('required');
        //     }

        //     if (dataId == 'user_language_write') {
        //         parent.find('.user_language_read').removeAttr('required');
        //         parent.find('.user_language_speak').removeAttr('required');
        //     }

        //     if (dataId == 'user_language_speak') {
        //         parent.find('.user_language_write').removeAttr('required');
        //         parent.find('.user_language_read').removeAttr('required');
        //     }
        // } else {
        //     console.log(parent.find('.user_language_read'))
        //     if (!(parent.find('.user_language_read').attr('checked')) && !(parent.find('.user_language_read').attr('checked')) && !(parent.find('.user_language_read').attr('checked'))) {
        //         parent.find('.user_language_read').attr('required', 'required');
        //         parent.find('.user_language_write').attr('required', 'required');
        //         parent.find('.user_language_speak').attr('required', 'required');
        //     }else{
        //         $(this).removeAttr('required');
        //     }
        // }
        // console.log($(this).attr('data-id'));
        // console.log($(this).prop('checked'));
    });
</script>
