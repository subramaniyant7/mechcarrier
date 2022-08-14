<?php

namespace App\Http\Controllers\Admin\WebpageContent;

use App\Http\Controllers\Admin\Helper\CommonHelperController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomePageTrainingCenterController extends Controller
{
    public function GetTrainingCenters(){
        $centers = CommonHelperController::getHomeTrainingCenter();
        return view('admin.websitecontent.trainingcenter.viewtrainingcenter',compact('centers'));
    }

    public function ManageTrainingCenter()
    {
        return view('admin.websitecontent.trainingcenter.actiontrainingcenter',['action' => 'add']);
    }

    public function ActionTrainingCenter($option, $id)
    {
        $actionId = decryption($id);
        $adminData = CommonHelperController::getHomeTrainingCenter($actionId);
        if (count($adminData) == 0) return redirect(ADMINURL . '/view_home_training_center');

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'home_training_center', 'training_center_id');
            $notify = notification($delete);
            return redirect(ADMINURL . '/view_home_training_center')->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.websitecontent.trainingcenter.actiontrainingcenter', ['action' => $option, 'data' => $adminData]);
    }

    public function SaveTrainingCenter(Request $request)
    {
        $formData =  $request->except(['_token', 'training_center_id']);
        $validatePosition = false;
        if($request->input('training_center_id') != ''){
            $actionId = decryption($request->input('training_center_id'));
            $trainingData = CommonHelperController::getHomeTrainingCenter($actionId);
            if($trainingData[0]->training_center_position != $formData['training_center_position']) $validatePosition = true;
        }
        if($request->input('training_center_id') == '' || $validatePosition) {
            $positionAvailable = CommonHelperController::getHomeTrainingCenterByPosition($formData['training_center_position']);
            if (count($positionAvailable)) return back()->with('error', 'Position already allocated');
        }
        if ($request->input('training_center_id') == '') {
            $saveData = insertQuery('home_training_center', $formData);
        } else {
            $actionId = decryption($request->input('training_center_id'));
            $saveData = updateQuery('home_training_center', 'training_center_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect(ADMINURL . '/view_home_training_center')->with($notify['type'], $notify['msg']);
    }

    // Specific Training Title Content
    public function ViewSpecificTraning($id)
    {
        if($id != '') {
            $trainingId = decryption($id);
            $trainingData = CommonHelperController::getHomeTrainingCenter($trainingId);
            if (!count($trainingData)) return redirect()->route('viewtrainingcenter')->with('error', 'Invalid Action');
            $trainingDetails = CommonHelperController::getHomeTrainingCenterByTrainingCenterId($trainingId);
            return view('admin.websitecontent.trainingcenter.viewspecifictrainingcenter', compact('trainingData', 'trainingDetails'));
        }
        return redirect()->route('viewtrainingcenter')-with('error','Invalid Action');
    }

    public function ManageTrainingCenterContent($id)
    {
        if($id != '') {
            return view('admin.websitecontent.trainingcenter.actionspecifictrainingcenter', ['action' => 'add']);
        }
        return redirect()->route('viewtrainingcenter')-with('error','Invalid Action');
    }

    public function ActionTrainingCenterContent($centerid, $option, $id)
    {
        $actionId = decryption($id);
        $trainingData = CommonHelperController::getHomeTrainingCenterDetails($actionId);
        if (count($trainingData) == 0) return redirect()->route('viewspecifictrainingcentercontent',['id' =>$id]);

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'home_training_center_details', 'training_center_detail_id');
            $notify = notification($delete);
            return back()->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.websitecontent.trainingcenter.actionspecifictrainingcenter', ['action' => $option, 'data' => $trainingData]);
    }

    public function SaveTrainingCenterContent(Request $request)
    {
        $formData =  $request->except(['_token', 'training_center_detail_id','training_center_id','edit_image']);
        $validatePosition = false;
        if($request->input('training_center_detail_id') != ''){
            $actionId = decryption($request->input('training_center_detail_id'));
            $trainingData = CommonHelperController::getHomeTrainingCenterDetails($actionId);
            if($trainingData[0]->training_center_details_position != $formData['training_center_details_position']) $validatePosition = true;
        }
        $formData['training_center_id'] = decryption($request->input('training_center_id'));
        if($request->input('training_center_detail_id') == '' || $validatePosition){
            $positionAvailable = CommonHelperController::getHomeTrainingCenterContentByPosition($formData['training_center_details_position'],$formData['training_center_id']);
            if (count($positionAvailable)) return back()->with('error', 'Position already allocated');
        }
        if ($request->hasFile('training_center_details_image')) {
            $file = $request->file('training_center_details_image');
            $destinationPath = public_path('uploads/hometrainingcenter/contentdetails');
            $fileName = $file->getClientOriginalName();
            $fileExtension = explode('.', $fileName);

            if (strtolower(end($fileExtension)) != 'png' && strtolower(end($fileExtension)) != 'jpeg' &&  strtolower(end($fileExtension)) != 'jpg'
                && strtolower(end($fileExtension)) != 'webp') {
                return redirect()->back()->withInput()->with('error', 'Please upload the valid image!');
            }
            $file->move($destinationPath, $fileName);
            $formData['training_center_details_image'] = $fileName;
        } else {
            $formData['training_center_details_image'] =  $request->input('edit_image');
        }



        if ($request->input('training_center_detail_id') == '') {
            $saveData = insertQuery('home_training_center_details', $formData);
        } else {
            $actionId = decryption($request->input('training_center_detail_id'));
            $saveData = updateQuery('home_training_center_details', 'training_center_detail_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('viewspecifictrainingcentercontent',['id' => $request->input('training_center_id')])->with($notify['type'], $notify['msg']);
    }
}
