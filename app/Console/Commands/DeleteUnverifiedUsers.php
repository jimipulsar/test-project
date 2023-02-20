<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DeleteUnverifiedUsers extends Command
{
    protected $signature = 'dear:delete-old-unverified-users';

    public function handle()
    {
        $this->info('Deleting old unverified users...');

        $count = User::query()
            ->whereNotNull('last_login_at')
            ->where('last_login_at', '<', now()->subMinutes(2))
            ->delete();

        $this->comment("Deleted {$count} unverified users.");

        $this->info('All done!');
    }
}
