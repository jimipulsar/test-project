<?php

namespace App\Http\Middleware;

use App\Models\AdminLogin;
use App\Models\ArchivedUser;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        if (auth()->check()) {
            $current_timestamp = Carbon::now()->toDateTimeString();

            DB::table('users')->where('id', '=', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->update(
                    [
                        'last_login_at' => $current_timestamp,
                    ]
                );


//                return redirect()->route('login')->with('warning', 'Your Account is archived. Please contact administrator');

        }

        return $next($request);

    }

}
