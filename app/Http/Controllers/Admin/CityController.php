<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Helper\CommonHelperController;

class CityController extends Controller
{
    public function ViewCity()
    {
        $city = CommonHelperController::getCity();
        return view('admin.location.city.viewcity', compact('city'));
    }

    public function ManageCity()
    {
        return view('admin.location.city.actioncity', ['action' => 'add']);
    }

    public function ActionCity($option, $id)
    {
        $actionId = decryption($id);
        $stateData = CommonHelperController::getCity($actionId);
        if (count($stateData) == 0) return redirect()->route('city')->withInput();

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'city', 'city_id');
            $notify = notification($delete);
            return redirect()->route('city')->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.location.city.actioncity', ['action' => $option, 'data' => $stateData]);
    }

    public function SaveCityDetails(Request $request)
    {
        $formData =  $request->except(['_token', 'city_id']);
        if ($request->input('city_id') == '') {
            $saveData = insertQuery('city', $formData);
        } else {
            $actionId = decryption($request->input('city_id'));
            $saveData = updateQuery('city', 'city_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('city')->with($notify['type'], $notify['msg']);
    }
}
