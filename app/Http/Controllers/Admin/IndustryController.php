<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Helper\CommonHelperController;

class IndustryController extends Controller
{
    public function ViewIndustry()
    {
        $industry = CommonHelperController::getIndustry();
        return view('admin.industry.viewindustry', compact('industry'));
    }

    public function ManageIndustry()
    {
        return view('admin.industry.actionindustry', ['action' => 'add']);
    }

    public function ActionIndustry($option, $id)
    {
        $actionId = decryption($id);
        $industryData = CommonHelperController::getIndustry($actionId);
        if (count($industryData) == 0) return redirect(ADMINURL . '/view_industry')->withInput();

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'industry', 'industry_id');
            $notify = notification($delete);
            return redirect(ADMINURL . '/view_industry')->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.industry.actionindustry', ['action' => $option, 'data' => $industryData]);
    }

    public function SaveIndustry(Request $request)
    {
        $formData =  $request->except(['_token', 'industry_id']);
        if ($request->input('industry_id') == '') {
            $saveData = insertQuery('industry', $formData);
        } else {
            $actionId = decryption($request->input('industry_id'));
            $saveData = updateQuery('industry', 'industry_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('viewindustry')->with($notify['type'], $notify['msg']);
    }
}
