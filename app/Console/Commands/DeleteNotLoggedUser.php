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

        $count = User::query()
            ->whereNotNull('last_login_at')
            ->where('last_login_at', '<', now()->subHours(24))
            ->first();

        if($count) {
            ArchivedUser::create([
                'name' => $count->name,
                'email' => $count->email,
                'password' => Hash::make($count->password),
                'created_at' => $current_timestamp,
                'updated_at' => $current_timestamp
            ]);
            $count->delete();
        }
        Log::info('Cron Job is running');
        $this->comment("Deleted {$count} not logged in the last 24 hours.");

        $this->info('All done!');
    }
}
