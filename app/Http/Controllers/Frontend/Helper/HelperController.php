<?php

namespace App\Http\Controllers\Frontend\Helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HelperController extends Controller
{
    static function GetHomeTrainingCenter()
    {
        return DB::table("home_training_center")->where('status', 1)->orderBy('training_center_id', 'desc')->get();
    }

    static function GetHomeTrainingCenterContent($centerid)
    {
        return DB::table("home_training_center_details")->where([['training_center_id', $centerid], ['status', 1]])->orderBy('training_center_detail_id', 'desc')->get();
    }

    static function isUserExistByEmail($email)
    {
        return DB::table("user_details")->where('user_email', $email)->get();
    }

    static function isUserExistByPhone($phone)
    {
        return DB::table("user_details")->where('user_phonenumber', $phone)->get();
    }

    static function isUserExistByEmailPhone($email, $phone)
    {
        return DB::table("user_details")->where([['user_email', $email], ['user_phonenumber', $phone]])->get();
    }

    static function getUserInfo($id = '')
    {
        $user = DB::table('user_details');
        if ($id != '')  $user->where('user_id', $id);
        return $user->get();
    }

    static function emailOTPExistByUserId($id)
    {
        return DB::table('user_email_otp')->where('user_id', $id)->get();
    }

    static function emailOTPVerify($id,$otp)
    {
        return DB::table('user_email_otp')->where([['user_id', $id],['user_otp', $otp]])->get();
    }

    static function mobileOTPVerify($id,$otp)
    {
        return DB::table('user_mobile_otp')->where([['user_id', $id],['user_otp', $otp]])->get();
    }

    static function mobileOTPExistByUserId($id)
    {
        return DB::table('user_mobile_otp')->where('user_id', $id)->get();
    }
}
