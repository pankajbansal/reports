<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\UserReport;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\WeeklyReport;

use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Facades\LogActivity;

class WeeklyReportMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $filePath = $this->generateReport($this->user);
        
        // Save the generated report to the database
        $report = UserReport::create([
            'user_id' => $this->user->id,
            'file_path' => $filePath,
            'status' => 'completed',
        ]);

        // Send email with the report or generate download link
        $this->sendReport($this->user, $filePath);
        
        // Send mail using your WeeklyReport mailable
        // Mail::to($this->user->email)->send(new WeeklyReport($this->user));
    }

    private function generateReport(User $user){
        $data = [
            'user' => $user,
            'activity' => $user->userActivities()->weeklyReport()->get(), // Example mock data
        ];

        $pdf = \PDF::loadView('reports.weekly', $data);
        $filePath = storage_path('app/reports/' . $user->id . '-weekly-report.pdf');
        $pdf->save($filePath);

        return $filePath;
    }

    private function sendReport(User $user, $filePath){
        activity()->log( $user->email . ' Weekly Report Sent');
        Mail::to($user->email)->send(new WeeklyReport($filePath));
    }
}
