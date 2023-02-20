<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Events\AdminLoginHistory;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
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

            return view('auth.admin.dashboard', [
                'users' => $users,
                'products' => $products,
                'notifications' => $notifications,
            ]);
        } else {
            return redirect()->route('index');
        }

    }

    public function searchOrder()
    {
        if (auth()->guard('web')->check()) {
            $pagination = 6;
            $notifications = DB::table('notifications')->orderBy('created_at', 'DESC')->get();
            $customers = DB::table('customers')->orderBy('created_at', 'DESC')->get();
            $products = DB::table('products')->count();

            $o = trim(\request()->input('o'));

            $query = \request()->all();
            $orders = Order::query()->where('order_number', 'LIKE', '%' . $o . '%')
                ->orWhere('billing_name', 'LIKE', '%' . $o . '%')
                ->paginate($pagination);
            $orders->appends(['search' => $o]);

            if (count($orders) > 0) {
                return view('auth.admin.dashboard')->withDetails($orders)->withQuery($o)->with([
                    'o' => $o,
                    'query' => $query,
                    'products' => $products,
                    'customers' => $customers,
                    'notifications' => $notifications,
                    'orders' => $orders,
                ]);
            } else {
                return redirect()->back()->with('danger', 'Corrispondenza non trovata');
            }
        } else {
            return redirect()->route('index');
        }
    }
}
