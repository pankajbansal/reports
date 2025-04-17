<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Jobs\WeeklyReportMail;


class SendWeeklyReports extends Command
{
    protected $signature = 'reports:send-weekly';

    protected $description = 'Send weekly reports to users';

    public function handle()
    {
        $activeUsers = User::where('status', 'active')->get();
        foreach($activeUsers as $user){
            if ($user) {
                WeeklyReportMail::dispatch($user);
                $this->info('Weekly report dispatched!');
            } else {
                $this->error('User not found.');
            }
        }
        
    }
}
