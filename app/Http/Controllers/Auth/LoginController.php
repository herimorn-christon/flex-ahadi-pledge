<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Role;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Override the authenticated method to handle the user's language and role redirection.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Store the selected language in the session
        $locale = $request->session()->get('locale');
        if (!empty($locale)) {
            App::setLocale($locale);
        }

        // Redirect based on user role
        if ($user->hasRole('admin') || !$user->hasRole('member')) {
            return redirect('admin/dashboard')->with('status', 'Welcome to Admin Dashboard');
        } elseif ($user->hasRole('member')) {
            return redirect('member/dashboard')->with('status', 'Login Successful');
        } else {
            return redirect('/');
        }
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Get the logout response for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function loggedOut(Request $request)
    {
        $locale = $request->session()->get('locale');
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->put('locale', $locale);

        return redirect('/');
    }
}
