<?php

namespace App\Console\Commands;

use App\Models\ArchivedUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DeleteNotLoggedUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dear:last-login';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User not logged in the last 24 hours';

    public function handle()
    {
        $this->info('Deleting user not logged in the last 24 hours...');
        $current_timestamp = Carbon::now()->toDateTimeString();

        //If an user is not logged in the last 24 hours
        $lastActivity = User::query()
            ->whereNotNull('last_login_at')
            ->where('last_login_at', '<=', now()->subHours(24))
            ->first();

        if ($lastActivity) {
            ArchivedUser::create([
                'name' => $lastActivity->name,
                'email' => $lastActivity->email,
                'password' => Hash::make($lastActivity->password),
                'created_at' => $current_timestamp,
                'updated_at' => $current_timestamp
            ]);
            $lastActivity->delete();
        }

        //If an user is never logged in
        $neverLoggedIn = User::query()
            ->whereNull('last_login_at')
            ->orderBy('created_at', 'desc')
            ->first();
        $usersNeverLogged = User::query()
            ->whereNull('last_login_at')
            ->orderBy('created_at', 'desc')
            ->get();
        if ($neverLoggedIn) {
            foreach ($usersNeverLogged as $userNot) {
                ArchivedUser::create([
                    'name' => $userNot->name,
                    'email' => $userNot->email,
                    'password' => Hash::make($userNot->password),
                    'created_at' => $current_timestamp,
                    'updated_at' => $current_timestamp
                ]);
                $userNot->delete();

            }
        }

        Log::info('Cron Job is running');
        $this->comment("Deleted {$lastActivity} not logged in the last 24 hours.");

        $this->info('All done!');
    }
}
