<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DB;

class EmployerProfileValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $employer = DB::table('employer_details')->where('employer_detail_id', $request->session()->get('employer_id'))->get();
        if (count($employer) && $employer[0]->employer_profile_completed == 1) {
            return $next($request);
        }
        return redirect()->route('employercompany')->with('error', 'Please complete the company details');
    }
}
