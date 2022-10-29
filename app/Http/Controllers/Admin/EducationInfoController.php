<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Helper\CommonHelperController;

class EducationInfoController extends Controller
{
    public function ViewEducation()
    {
        $education = CommonHelperController::getEducation();
        return view('admin.education.vieweducation', compact('education'));
    }

    public function ManageEducation()
    {
        return view('admin.education.actioneducation', ['action' => 'add']);
    }

    public function ActionEducation($option, $id)
    {
        $actionId = decryption($id);
        $educationData = CommonHelperController::getEducation($actionId);
        if (count($educationData) == 0) return redirect()->route('education')->withInput();

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'education_info', 'education_id');
            $notify = notification($delete);
            return redirect()->route('education')->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.education.actioneducation', ['action' => $option, 'data' => $educationData]);
    }

    public function SaveEducationDetails(Request $request)
    {
        $formData =  $request->except(['_token', 'education_id']);
        if ($request->input('education_id') == '') {
            $saveData = insertQuery('education_info', $formData);
        } else {
            $actionId = decryption($request->input('education_id'));
            $saveData = updateQuery('education_info', 'education_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('education')->with($notify['type'], $notify['msg']);
    }
}
