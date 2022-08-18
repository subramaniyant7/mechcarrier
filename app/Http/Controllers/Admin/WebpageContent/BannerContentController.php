<?php

namespace App\Http\Controllers\Admin\WebpageContent;

use App\Http\Controllers\Admin\Helper\CommonHelperController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerContentController extends Controller
{
    public function GetBannerContent(Request $request)
    {
        $bannerInfo = CommonHelperController::getBannerData();
        return view('admin.websitecontent.bannercontent', compact('bannerInfo'));
    }

    public function SaveBannerContent(Request $request)
    {
        $formData = $request->except('_token', 'banner_id','edit_bannerimage','edit_companyimage');
        if ($formData['banner_title'] == '' || $formData['banner_description'] == '') {
            return back()->with('error', 'Please enter all mandatory fields');
        }

        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $destinationPath = public_path('uploads/homepage');
            $fileName = $file->getClientOriginalName();
            $fileExtension = explode('.', $fileName);

            if (
                strtolower(end($fileExtension)) != 'png' && strtolower(end($fileExtension)) != 'jpeg' &&  strtolower(end($fileExtension)) != 'jpg'
                && strtolower(end($fileExtension)) != 'webp'
            ) {
                return redirect()->back()->withInput()->with('error', 'Please upload the valid image!');
            }
            $file->move($destinationPath, $fileName);
            $formData['banner_image'] = $fileName;
        } else {
            $formData['banner_image'] =  $request->input('edit_bannerimage');
        }

        if ($request->hasFile('company_logo')) {
            $file = $request->file('company_logo');
            $destinationPath = public_path('uploads/homepage');
            $fileName = $file->getClientOriginalName();
            $fileExtension = explode('.', $fileName);

            if (
                strtolower(end($fileExtension)) != 'png' && strtolower(end($fileExtension)) != 'jpeg' &&  strtolower(end($fileExtension)) != 'jpg'
                && strtolower(end($fileExtension)) != 'webp'
            ) {
                return redirect()->back()->withInput()->with('error', 'Please upload the valid image!');
            }
            $file->move($destinationPath, $fileName);
            $formData['company_logo'] = $fileName;
        } else {
            $formData['company_logo'] =  $request->input('edit_companyimage');
        }

        if( $formData['banner_image'] == '' ||  $formData['company_logo'] == ''){
            return back()->withInput()->with('error', 'Please upload the image!');
        }

        // echo '<pre>';
        // print_r($formData);
        // exit;

        if ($request->input('banner_id') == '') {
            $saveData = insertQuery('banner_content', $formData);
        } else {
            $actionId = decryption($request->input('banner_id'));
            $saveData = updateQuery('banner_content', 'banner_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect(ADMINURL . '/banner_content')->with($notify['type'], $notify['msg']);
    }
}
