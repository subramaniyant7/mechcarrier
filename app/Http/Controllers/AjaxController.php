<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function CompanyHtmlRender(Request $request){
        $type = $request->input('type');
        if($type == '') return response()->json(['status' => false]);
        $viewType = $type == 'manual' ? 'admin.websitecontent.companymapping.manualrender' : 'admin.websitecontent.companymapping.companyrender' ;
        $getView = view($viewType)->render();
        return response()->json(['view' => $getView,'status'=> true]);
    }
}
