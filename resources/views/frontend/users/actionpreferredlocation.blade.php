<style>
    .basicbtn {
        display: block;
    }
</style>

@php
    $preferredState = $preferredCity = '';
    $total = 1;
    $stateId = $cityId = [];
    if ($type == 'edit') {
        $stateId = explode(',', $data[0]->user_preferred_state);
        $total = count($stateId);
        $cityId = explode(',', $data[0]->user_preferred_city);
    }
@endphp
<form class="preferred-location-form" action="#" id="preferred-location-form">
    @for ($l = 0; $l < $total; $l++)
        @php
            if ($type == 'edit') {
                $stateInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getStateById($stateId[$l]);
                if (count($stateInfo)) {
                    $preferredState = $stateInfo[0]->state_name;
                }

                $cityInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getCityInfo($cityId[$l]);
                if (count($cityInfo)) {
                    $preferredCity = $cityInfo[0]->city_name;
                }
            }
        @endphp

        @if ($l == 0)
            <div class="preferred_main">
                <div class="row">
                    <div class="col-md-4">
                        <div class="d-flex">
                            <div style="position:relative" class="autocomplete_ui_parent">
                                <input type="text" placeholder="Select Preferred State" name="user_preferred_state[]"
                                    class="form-control autocomplete_actual_id user_preferred_state" required
                                    value="{{ $preferredState }}" />
                                <input type="hidden" name="preferred_state_id[]"
                                    class="autocomplete_id preferred_state_id"
                                    value="{{ count($data) ? $stateId[$l] : '' }}">
                                <div class="autocomplete-items" style="display:none">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="position:relative" class="autocomplete_ui_parent">
                            <input type="text" placeholder="Select Preferred City" name="user_preferred_city[]"
                                class="form-control autocomplete_actual_id user_preferred_city" required
                                value="{{ $preferredCity }}" />
                            <input type="hidden" name="preferred_city_id[]" class="autocomplete_id preferred_city_id"
                                value="{{ count($data) ? $cityId[$l] : '' }}">
                            <div class="autocomplete-items" style="display:none">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($l == 1 || $total == 1)<div class="addnewelement"> @endif
            @if ($l > 0)
                <div class="preferred_main">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex">
                                <div style="position:relative" class="autocomplete_ui_parent">
                                    <input type="text" placeholder="Select Preferred State"
                                        name="user_preferred_state[]"
                                        class="form-control autocomplete_actual_id user_preferred_state" required
                                        value="{{ $preferredState }}" />
                                    <input type="hidden" name="preferred_state_id[]"
                                        class="autocomplete_id preferred_state_id"
                                        value="{{ count($data) ? $stateId[$l] : '' }}">
                                    <div class="autocomplete-items" style="display:none">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div style="position:relative" class="autocomplete_ui_parent">
                                <input type="text" placeholder="Select Preferred City" name="user_preferred_city[]"
                                    class="form-control autocomplete_actual_id user_preferred_city" required
                                    value="{{ $preferredCity }}" />
                                <input type="hidden" name="preferred_city_id[]"
                                    class="autocomplete_id preferred_city_id"
                                    value="{{ count($data) ? $cityId[$l] : '' }}">
                                <div class="autocomplete-items" style="display:none">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div style="text-align: left;padding-top:7px;cursor:pointer;" class="removeelement">Remove
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @if ($l+1 == $total || $total == 1)  </div> @endif
    @endfor

    <div class="add_more"
        style="text-align: left;display:{{ $total > 2 ? 'none' : 'block' }}"><span style="color: #1D56BB;cursor:pointer;position:unset;font-size:16px;">Add More</span>
    </div>
    <input type="hidden" name="user_profile_id[]" value="{{ count($data) ? $data[0]->user_profile_id : '' }}">
    <div class="row">
        <div class="col-md-12">
            <div class="form-buttons basicbtn">
                <button type="button" class="btn btn-cancel cancel_preferred_location">Cancel</button>
                <button type="submit" class="btn btn-save">Save</button>
            </div>
        </div>
    </div>
</form>

