<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Helper\CommonHelperController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CountryController extends Controller
{
    public function ViewCountry()
    {
        $country = CommonHelperController::getCountry();
        return view('admin.location.country.viewcountry', compact('country'));
    }

    public function ManageCountry()
    {
        return view('admin.location.country.actioncountry', ['action' => 'add']);
    }

    public function ActionCountry($option, $id)
    {
        $actionId = decryption($id);
        $countryData = CommonHelperController::getCountry($actionId);
        if (count($countryData) == 0) return redirect()->route('country')->withInput();

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'country', 'country_id');
            $notify = notification($delete);
            return redirect()->route('country')->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.location.country.actioncountry', ['action' => $option, 'data' => $countryData]);
    }

    public function SaveCountryDetails(Request $request)
    {
        $formData =  $request->except(['_token', 'country_id']);
        if ($request->input('country_id') == '') {
            $saveData = insertQuery('country', $formData);
        } else {
            $actionId = decryption($request->input('country_id'));
            $saveData = updateQuery('country', 'country_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('country')->with($notify['type'], $notify['msg']);
    }
}
