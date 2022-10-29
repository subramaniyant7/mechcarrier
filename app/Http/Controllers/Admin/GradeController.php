<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Helper\CommonHelperController;

class GradeController extends Controller
{
    public function ViewGrade()
    {
        $grade = CommonHelperController::getGrade();
        return view('admin.grade.viewgrade', compact('grade'));
    }

    public function ManageGrade()
    {
        return view('admin.grade.actiongrade', ['action' => 'add']);
    }

    public function ActionGrade($option, $id)
    {
        $actionId = decryption($id);
        $data = CommonHelperController::getGrade($actionId);
        if (count($data) == 0) return redirect()->route('grade')->withInput();

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'education_grade', 'education_grade_id');
            $notify = notification($delete);
            return redirect()->route('grade')->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.grade.actiongrade', ['action' => $option, 'data' => $data]);
    }

    public function SaveGradeDetails(Request $request)
    {
        $formData =  $request->except(['_token', 'education_grade_id']);
        if ($request->input('education_grade_id') == '') {
            $saveData = insertQuery('education_grade', $formData);
        } else {
            $actionId = decryption($request->input('education_grade_id'));
            $saveData = updateQuery('education_grade', 'education_grade_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('grade')->with($notify['type'], $notify['msg']);
    }
}
