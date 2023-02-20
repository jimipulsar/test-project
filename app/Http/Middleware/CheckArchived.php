<?php

namespace App\Http\Middleware;

use App\Models\AdminLogin;
use App\Models\ArchivedUser;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CheckArchived
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

//        if (date('Y-m-d H:i:s') < auth()->user()->created_at) {
//            $blocked_days = now()->diffInDays(auth()->user()->created_at);
//
//        }

        $minutesAgo = Carbon::now()->subMinutes(1);
        if (auth()->check() && (auth()->user()->created_at <= $minutesAgo)) {
            $archivedUser = AdminLogin::where('email', '=', auth()->user()->email)->orderBy('created_at', 'desc')->first();
            if ($archivedUser != null) {

                ArchivedUser::create([
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                    'password' => Hash::make(auth()->user()->password)
                ]);
                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return redirect()->route('login')->with('warning', 'Your Account is archived. Please contact administrator');
            }
        }

        return $next($request);

    }

}
