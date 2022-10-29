<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Helper\CommonHelperController;

class SpecializationController extends Controller
{
    public function ViewSpecialization()
    {
        $specialization = CommonHelperController::getSpecialization();
        return view('admin.specialization.viewspecialization', compact('specialization'));
    }

    public function ManageSpecialization()
    {
        return view('admin.specialization.actionspecialization', ['action' => 'add']);
    }

    public function ActionSpecialization($option, $id)
    {
        $actionId = decryption($id);
        $data = CommonHelperController::getSpecialization($actionId);
        if (count($data) == 0) return redirect()->route('specialization')->withInput();

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'education_specialization', 'education_specialization_id');
            $notify = notification($delete);
            return redirect()->route('specialization')->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.specialization.actionspecialization', ['action' => $option, 'data' => $data]);
    }

    public function SaveSpecializationDetails(Request $request)
    {
        $formData =  $request->except(['_token', 'education_specialization_id']);
        if ($request->input('education_specialization_id') == '') {
            $saveData = insertQuery('education_specialization', $formData);
        } else {
            $actionId = decryption($request->input('education_specialization_id'));
            $saveData = updateQuery('education_specialization', 'education_specialization_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('specialization')->with($notify['type'], $notify['msg']);
    }
}
