<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Events\AdminLoginHistory;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function getLogin()
    {
        if (auth()->guard('web')->user()) {
            return redirect()->route('dashboard');
        }
        return view('auth.admin.login');
    }

    /**
     * @throws ValidationException
     */

    public function postLogin( Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->guard('web')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $admin = auth()->guard('web')->user();
            event(new AdminLoginHistory($admin));
            return redirect()->route('dashboard')->with('success', 'Autenticazione avvenuta!');

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
        return Auth::guard();
    }

    /**
     * Show the application logout.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect()->route('adminLogin');
    }

    public function adminLogout()
    {
        auth()->guard('web')->logout();
        return redirect()->route('adminLogin')->with('success', 'Sei uscito correttamente');
    }

    public function login()
    {

        return view('auth.admin.login');


    }


    public function pagination($items, $perPage = 5, $page = null, $options = [], $pageName = 'page')
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'pageName' => $pageName,
        ], $options);
    }
}
