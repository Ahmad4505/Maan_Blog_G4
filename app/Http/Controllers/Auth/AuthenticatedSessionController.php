<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();//نوع من انواع الحمايه يتم انشاء سيشن جديد لما يتغير اليوزر من كست لاثونتيكيت

        return redirect()->intended(RouteServiceProvider::HOME); //محاوله الدخول للصفحة المحمية
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    // Guard : web ,api
    // Auth::user() ====>Auth::guard('api)->user()====> Auth::guard('editor)->user()
    // Auth::id()====>Auth::guard('api)->id()====> Auth::guard('editor)->id()
    // Auth::attempt(['email'=>$email,'password'=>$password],$remember)التاكد من ان اليوزر في عمليه اللوجن صحيح
    // Auth::check
    // Auth::login($user)
    // Auth::logout
}
