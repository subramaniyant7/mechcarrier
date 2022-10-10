<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Helper\CommonHelperController;

class DesignationController extends Controller
{
    public function ViewDesignation()
    {
        $designation = CommonHelperController::getDesignation();
        return view('admin.designation.viewdesignation', compact('designation'));
    }

    public function ManageDesignation()
    {
        return view('admin.designation.actiondesignation', ['action' => 'add']);
    }

    public function ActionDesignation($option, $id)
    {
        $actionId = decryption($id);
        $departmentData = CommonHelperController::getDesignation($actionId);
        if (count($departmentData) == 0) return redirect(ADMINURL . '/view_designation')->withInput();

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'designation', 'designation_id');
            $notify = notification($delete);
            return redirect(ADMINURL . '/view_designation')->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.designation.actiondesignation', ['action' => $option, 'data' => $departmentData]);
    }

    public function SaveDesignation(Request $request)
    {
        $formData =  $request->except(['_token', 'designation_id']);
        if ($request->input('designation_id') == '') {
            $saveData = insertQuery('designation', $formData);
        } else {
            $actionId = decryption($request->input('designation_id'));
            $saveData = updateQuery('designation', 'designation_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('viewdesignation')->with($notify['type'], $notify['msg']);
    }
}
