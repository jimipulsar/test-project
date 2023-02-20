<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Events\AdminLoginHistory;
use App\Http\Controllers\Controller;
use App\Models\AdminLogin;
use App\Models\ArchivedUser;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;


class AdminController extends Controller
{
//    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('logout');


    }

    public function archivedUsers()
    {
        $archivedUsers = ArchivedUser::orderBy('id', 'DESC')->paginate(15);
        return view('auth.admin.archived-users', [
            'archivedUsers' => $archivedUsers
        ]);

    }

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
        return redirect()->route('login');
    }

    public function adminLogout()
    {
        auth()->guard('web')->logout();
        return redirect()->route('login')->with('success', 'You logged out with success');
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

    public function dashboard()
    {
        if (auth()->guard('web')->check()) {
            $notifications = DB::table('notifications')->orderBy('created_at', 'DESC')->get();
            $users = DB::table('users')->orderBy('created_at', 'DESC')->get();
            $products = DB::table('products')->count();
            $userLogin = DB::table('admin_login_history')->orderBy('created_at', 'desc')->first();
            $minutesAgo = Carbon::now()->subMinutes(2)->diffForHumans();
            $current_timestamp = Carbon::now()->toDateTimeString();
//            $userArchived = array();
//            $userAuth = auth()->user()->toArray();
//            $userAuthPassword = auth()->user()->getAuthPassword();
//
////            dd($userAuth);
//            if ($userLogin->created_at > $minutesAgo) {
////                AdminLogin::create();
//                ArchivedUser::create([
//                    'name' => $userAuth['name'],
//                    'email' => $userAuth['email'],
//                    'password' => $userAuthPassword,
//                    'created_at' => $current_timestamp,
//                    'updated_at' => $current_timestamp
//                ]);
//                $minutesAgo = Carbon::now()->subMinutes(2)->diffForHumans();
////                dd($userLogin);
//            }

            return view('auth.admin.dashboard', [
                'users' => $users,
                'products' => $products,
                'notifications' => $notifications,
            ]);
        } else {
            return redirect()->route('index');
        }

    }

}
