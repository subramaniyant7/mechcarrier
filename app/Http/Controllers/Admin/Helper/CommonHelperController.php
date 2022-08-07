<?php

namespace App\Http\Controllers\Admin\Helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

    static function getAdminData($id = '')
    {
        $admin = DB::table('admin');
        if ($id != '')  $admin->where('admin_id', $id);
        return $admin->get();
    }

    static function getAdminDetailsExceptLoggedIn()
    {
        return DB::table("admin")->where('admin_id', '!=', Session::get('admin_id'))->get();
    }

    static function getSocialMediaLinks()
    {
        return DB::table("social_media_links")->get();
    }

}
