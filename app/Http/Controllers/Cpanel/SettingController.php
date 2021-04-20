<?php

namespace App\Http\Controllers\Cpanel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SettingController extends CpanelBaseController
{
    /**
     * @param  Request  $request
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        $this->setPageTitle('Setting');

        return Inertia::render('Setting', [
            'setting' => config('options')
        ]);
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        option($request->get('general'));

        return Redirect::route('cpanel.setting')->with('message', 'Setting updated.');
    }
}
