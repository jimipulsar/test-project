<?php

namespace App\Listeners;

use App\Events\AdminLastLogin;
use App\Events\AdminLoginHistory;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class AdminLastLoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return bool
     */
    public function handle(AdminLastLogin $event)
    {
        $current_timestamp = Carbon::now()->toDateTimeString();

        if (isset($event->admin)) {
            $adminInfo = $event->admin;
        }
        if (isset($adminInfo)) {
            return DB::table('users')->where('id', '=', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->update(
                    [
                        'last_login_at' => $current_timestamp,
                    ]
                );
        }
    }
}
