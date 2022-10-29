<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Helper\CommonHelperController;

class UniversityController extends Controller
{
    public function ViewUniversity()
    {
        $university = CommonHelperController::getUniversity();
        return view('admin.university.viewuniversity', compact('university'));
    }

    public function ManageUniversity()
    {
        return view('admin.university.actionuniversity', ['action' => 'add']);
    }

    public function ActionUniversity($option, $id)
    {
        $actionId = decryption($id);
        $data = CommonHelperController::getUniversity($actionId);
        if (count($data) == 0) return redirect()->route('university')->withInput();

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'education_university', 'education_university_id');
            $notify = notification($delete);
            return redirect()->route('university')->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.university.actionuniversity', ['action' => $option, 'data' => $data]);
    }

    public function SaveUniversityDetails(Request $request)
    {
        $formData =  $request->except(['_token', 'education_university_id']);
        if ($request->input('education_university_id') == '') {
            $saveData = insertQuery('education_university', $formData);
        } else {
            $actionId = decryption($request->input('education_university_id'));
            $saveData = updateQuery('education_university', 'education_university_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('university')->with($notify['type'], $notify['msg']);
    }
}
