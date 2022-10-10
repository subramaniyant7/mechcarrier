<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Helper\CommonHelperController;

class DepartmentController extends Controller
{
    public function ViewDepartment()
    {
        $department = CommonHelperController::getDepartment();
        return view('admin.department.viewdepartment', compact('department'));
    }

    public function ManageDepartment()
    {
        return view('admin.department.actiondepartment', ['action' => 'add']);
    }

    public function ActionDepartment($option, $id)
    {
        $actionId = decryption($id);
        $departmentData = CommonHelperController::getDepartment($actionId);
        if (count($departmentData) == 0) return redirect(ADMINURL . '/view_department')->withInput();

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'department', 'department_id');
            $notify = notification($delete);
            return redirect(ADMINURL . '/view_department')->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.department.actiondepartment', ['action' => $option, 'data' => $departmentData]);
    }

    public function SaveDepartment(Request $request)
    {
        $formData =  $request->except(['_token', 'department_id']);
        if ($request->input('department_id') == '') {
            $saveData = insertQuery('department', $formData);
        } else {
            $actionId = decryption($request->input('department_id'));
            $saveData = updateQuery('department', 'department_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('viewdepartment')->with($notify['type'], $notify['msg']);
    }
}
