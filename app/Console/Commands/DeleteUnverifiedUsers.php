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
            ->whereNull('email_verified_at')
            ->where('created_at', '<', now()->subDays(10))
            ->delete();

        $this->comment("Deleted {$count} unverified users.");

        $this->info('All done!');
    }
}
