<?php

namespace App\Console\Commands;

use App\Models\ArchivedUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DeleteUnverifiedUsers extends Command
{
    protected $signature = 'dear:last-login';

    public function handle()
    {
        $this->info('Deleting user not logged in since 24 hours...');
        $current_timestamp = Carbon::now()->toDateTimeString();

        $count = User::query()
            ->whereNotNull('last_login_at')
            ->where('last_login_at', '<', now()->subMinutes(1))
            ->first();
        Log::info('Cron is working fine!');

        ArchivedUser::create([
            'name' => $count->name,
            'email' => $count->email,
            'password' => Hash::make($count->password),
            'created_at' => $current_timestamp,
            'updated_at' => $current_timestamp
        ]);
        $count->delete();
        $this->comment("Deleted {$count} not logged in since 24 hours.");

        $this->info('All done!');
    }
}
