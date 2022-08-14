<?php

namespace App\Http\Controllers\Admin\WebpageContent;

use App\Http\Controllers\Admin\Helper\CommonHelperController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerContentController extends Controller
{
   public function GetBannerContent(Request $request){
       $bannerInfo = CommonHelperController::getBannerData();
       return view('admin.websitecontent.bannercontent', compact('bannerInfo'));
   }

   public function SaveBannerContent(Request $request){
       $formData = $request->except('_token','banner_id');
       if($formData['banner_title'] == '' || $formData['banner_description'] == ''){
           return back()->with('error','Please enter all mandatory fields');
       }

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
