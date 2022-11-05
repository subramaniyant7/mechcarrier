<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployerController extends Controller
{

    public function EmployerLogin(){
        return view('frontend.employer.employerlogin');
    }

    public function EmployerRegister(){
        return view('frontend.employer.employerregister');
    }



    public function CompanyAction(){
        return view('frontend.employer.comanyaction');
    }
}
