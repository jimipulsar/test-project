<?php

namespace App\Http\Controllers\Auth;

use App\Events\AdminLoginHistory;
use App\Events\CustomerLoginHistory;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

//    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web')->except('logout');
    }

    public function login()
    {
        if (auth()->user()) {
            return redirect()->route('dashboard');
        }
        return view('auth.admin.login');
    }
//    public function getLogin()
//    {
//
//        return view('pages.popup');
//    }

    public function showLoginForm()
    {

        return view('auth.admin.login');

    }

    /**
     * @throws ValidationException
     */

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->guard('web')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $admin = auth()->guard('web')->user();
            event(new AdminLoginHistory($admin));
            return redirect()->route('dashboard')->with('success', 'Authentication successful!');

        } else {
            return $this->sendFailedLoginResponse($request);
        }


    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    public function username()
    {
        return 'email';
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
//        Session::flush();

        return redirect()->route('login')->with('success', 'You logged out with success');

    }

    protected function loggedOut(Request $request)
    {
        //
    }
}
