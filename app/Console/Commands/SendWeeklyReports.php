<?php

// app/Console/Commands/SendWeeklyReports.php

namespace App\Console\Commands;

use App\Models\User;
use App\Jobs\GenerateWeeklyReport;
use Illuminate\Console\Command;

class SendWeeklyReports extends Command
{
    protected $signature = 'reports:send-weekly';

    public function handle()
    {
        User::where('status', 'active')->each(function (User $user) {
            GenerateWeeklyReport::dispatch($user);
        });
    }
}
