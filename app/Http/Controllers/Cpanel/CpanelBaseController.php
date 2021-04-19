<?php


namespace App\Http\Controllers\Cpanel;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CpanelBaseController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('cpanel');
    }
}
