<div class="row languages parentlanguage">
    <div class="col-md-3">
        <label>Languages </label>
        <br />
        <input type="hidden" name="user_language_id[]" value="">
        <select class="form-control" name="user_language_primary_id[]" required aria-label="Default select example">
            <option selected="" value="">Add</option>
            @foreach (getActiveRecord('languages') as $language)
                <option value="{{ $language->language_id }}">
                    {{ $language->language_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label>Proficiency </label>
        <br />
        <select class="form-control" name="user_language_proficiency[]" required aria-label="Default select example">
            <option selected="" value="">Select</option>
            @foreach (languageStrength() as $k => $languageStrength)
                <option value="{{ $k + 1 }}">
                    {{ $languageStrength }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-1">
        <label>Read </label>
        <br />
        <div class="form-check">
            <input type="hidden" class="user_language_read_value" name="user_language_read_value[]" value="2">
            <input class="form-check-input enable user_language_read" data-id="user_language_read_value"
                name="user_language_read[]" type="checkbox" value="1">
        </div>
    </div>
    {{-- <div class="col-md-1 form-checkbox">
        <p>Read</p>
        <div class="d-flex">
            <div class="form-check">
                <input type="hidden" class="user_language_read_value" name="user_language_read_value[]" value="2">
                <input class="form-check-input enable user_language_read" data-id="user_language_read_value"
                    name="user_language_read[]" type="checkbox" value="1">
            </div>
        </div>
    </div> --}}
    <div class="col-md-1">
        <label>Write</label>
        <div class="form-check">
            <input type="hidden" class="user_language_write_value" name="user_language_write_value[]" value="2">
            <input class="form-check-input enable user_language_write" data-id="user_language_write_value"
                name="user_language_write[]" type="checkbox" value="1">
        </div>
    </div>
    <div class="col-md-1">
        <label>Speak</label>
        <div class="form-check">
            <input type="hidden" class="user_language_speak_value" name="user_language_speak_value[]" value="2">
            <input class="form-check-input enable user_language_speak" data-id="user_language_speak_value"
                name="user_language_speak[]" type="checkbox" value="1">
        </div>
    </div>
    <div class="col-md-2">
        <div class="delete_language" style="cursor:pointer">
            <span> Remove</span>
        </div>
    </div>
</div>
