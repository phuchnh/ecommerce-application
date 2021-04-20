<?php


namespace App\Http\Controllers\Cpanel\Auth;


use App\Http\Controllers\Cpanel\CpanelBaseController;
use App\Http\Controllers\Cpanel\Requests\LoginRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoginController extends CpanelBaseController
{
    public function create(Request $request)
    {
        $this->setPageTitle('Login');
        return Inertia::render('Auth/Login');
    }

    /**
     * @param  LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(
            route('cpanel.dashboard')
        );
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('cpanel.login');
    }
}
