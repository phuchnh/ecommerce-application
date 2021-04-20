<?php

namespace App\Http\Controllers\Cpanel;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends CpanelBaseController
{
    /**
     * @param  Request  $request
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Setting', [
            'setting' => config('options')
        ]);
    }

    public function store(Request $request)
    {

    }
}
