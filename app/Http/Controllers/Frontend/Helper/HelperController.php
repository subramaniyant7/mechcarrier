<?php

namespace App\Http\Controllers\Frontend\Helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HelperController extends Controller
{
    static function GetHomeTrainingCenter(){
       return DB::table("home_training_center")->where('status', 1)->orderBy('training_center_id', 'desc')->get();
    }

    static function GetHomeTrainingCenterContent($centerid){
        return DB::table("home_training_center_details")->where([['training_center_id',$centerid],['status', 1]])->orderBy('training_center_detail_id', 'desc')->get();
    }
}
