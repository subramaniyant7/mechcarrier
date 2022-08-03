<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Exception;

class FrontendController extends Controller
{
    public function SocialMedia($social){
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback($social){
        try {
            $userSocial = Socialite::driver($social)->user();
            echo '<pre>';
            print_r($userSocial);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
