<style>
    .basicbtn {
        display: block;
    }
</style>

@php
    $currentCountry = $currentCity = '';
    if ($type == 'edit') {
        $stateInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getStateById($data[0]->user_current_state);
        if (count($stateInfo)) {
            $currentCountry = $stateInfo[0]->state_name;
        }

        $cityInfo = \App\Http\Controllers\Frontend\Helper\HelperController::getCityInfo($data[0]->user_current_city);
        if (count($cityInfo)) {
            $currentCity = $cityInfo[0]->city_name;
        }
    }
@endphp
<form class="current-location-form" action="#" id="current-location-form">
    <div class="row">
        <div class="col-md-6">
            <div class="d-flex">
                <div style="position:relative" class="autocomplete_ui_parent">
                    <input type="text" placeholder="Select Current Country" name="user_current_state"
                        class="form-control autocomplete_actual_id user_current_state" required
                        value="{{ $currentCountry }}" />
                    <input type="hidden" name="current_state_id" class="autocomplete_id"
                        value="{{ count($data) ? $data[0]->user_current_state : '' }}">
                    <div class="autocomplete-items" style="display:none">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div style="position:relative" class="autocomplete_ui_parent">
                <input type="text" placeholder="Select Current City" name="user_current_city"
                    class="form-control autocomplete_actual_id user_current_city" required
                    value="{{ $currentCity }}" />
                <input type="hidden" name="current_city_id" class="autocomplete_id"
                    value="{{ count($data) ? $data[0]->user_current_city : '' }}">
                <div class="autocomplete-items" style="display:none">
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="user_profile_id" value="{{ count($data) ? $data[0]->user_profile_id : '' }}">
    <div class="row">
        <div class="col-md-12">
            <div class="form-buttons basicbtn">
                <button type="button" class="btn btn-cancel cancel_current_location">Cancel</button>
                <button type="submit" class="btn btn-save">Save</button>
            </div>
        </div>
    </div>
</form>
