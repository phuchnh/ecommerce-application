<?php


namespace App\Http\Controllers\Cpanel;


use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends CpanelBaseController
{
    public function __invoke(Request $request)
    {
        $this->setPageTitle('Dashboard');
        return Inertia::render('Dashboard');
    }
}
