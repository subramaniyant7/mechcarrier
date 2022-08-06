<?php

namespace App\Http\Controllers\Admin\Helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommonHelperController extends Controller
{
    static function getAdminDetails($email, $password)
    {
        return DB::table("admin")->where([['admin_email', $email ], ['admin_password', $password]])->get();
    }

    static function getAdminByEmail($email)
    {
        return DB::table("admin")->where('admin_email', $email)->get();
    }

    static function getSocialMediaLinks()
    {
        return DB::table("social_media_links")->get();
    }

}
