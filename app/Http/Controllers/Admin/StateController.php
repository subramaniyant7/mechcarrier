<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Helper\CommonHelperController;

class StateController extends Controller
{
    public function ViewState()
    {
        $state = CommonHelperController::getState();
        return view('admin.location.state.viewstate', compact('state'));
    }

    public function ManageState()
    {
        return view('admin.location.state.actionstate', ['action' => 'add']);
    }

    public function ActionState($option, $id)
    {
        $actionId = decryption($id);
        $stateData = CommonHelperController::getState($actionId);
        if (count($stateData) == 0) return redirect()->route('state')->withInput();

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'state', 'state_id');
            $notify = notification($delete);
            return redirect()->route('state')->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.location.state.actionstate', ['action' => $option, 'data' => $stateData]);
    }

    public function SaveStateDetails(Request $request)
    {
        $formData =  $request->except(['_token', 'state_id']);
        if ($request->input('state_id') == '') {
            $saveData = insertQuery('state', $formData);
        } else {
            $actionId = decryption($request->input('state_id'));
            $saveData = updateQuery('state', 'state_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('state')->with($notify['type'], $notify['msg']);
    }
}
