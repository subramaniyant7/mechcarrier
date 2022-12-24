<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Helper\CommonHelperController;

class EmploymentTypeController extends Controller
{
    public function ViewEmploymentType()
    {
        $employmentType = CommonHelperController::getEmploymentType();
        return view('admin.employmenttype.viewemploymenttype', compact('employmentType'));
    }

    public function ManageEmploymentType()
    {
        return view('admin.employmenttype.actionemploymenttype', ['action' => 'add']);
    }

    public function ActionEmploymentType($option, $id)
    {
        $actionId = decryption($id);
        $data = CommonHelperController::getEmploymentType($actionId);
        if (count($data) == 0) return redirect()->route('viewemploymenttype')->withInput();

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'employmenttype', 'employmenttype_id');
            $notify = notification($delete);
            return redirect()->route('viewemploymenttype')->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.employmenttype.actionemploymenttype', ['action' => $option, 'data' => $data]);
    }

    public function SaveEmploymentType(Request $request)
    {
        $formData =  $request->except(['_token', 'employmenttype_id']);
        if ($request->input('employmenttype_id') == '') {
            $saveData = insertQuery('employmenttype', $formData);
        } else {
            $actionId = decryption($request->input('employmenttype_id'));
            $saveData = updateQuery('employmenttype', 'employmenttype_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('viewemploymenttype')->with($notify['type'], $notify['msg']);
    }
}
