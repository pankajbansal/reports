<?php

// app/Jobs/GenerateWeeklyReport.php

namespace App\Jobs;

use App\Models\User;
use App\Models\UserReport;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class GenerateWeeklyReport implements ShouldQueue{
    use Dispatchable, Queueable;

    protected $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function handle(){
        $filePath = $this->generateReport($this->user);
        
        // Save the generated report to the database
        $report = UserReport::create([
            'user_id' => $this->user->id,
            'file_path' => $filePath,
            'status' => 'completed',
        ]);

        // Send email with the report or generate download link
        $this->sendReport($this->user, $filePath);
    }

    private function generateReport(User $user){
        $data = [
            'user' => $user,
            'activity' => $user->activities()->weeklyReport(), // Example mock data
        ];

        $pdf = PDF::loadView('reports.weekly', $data);
        $filePath = storage_path('app/reports/' . $user->id . '-weekly-report.pdf');
        $pdf->save($filePath);

        return $filePath;
    }

    private function sendReport(User $user, $filePath){
        Mail::to($user->email)->send(new WeeklyReportMail($filePath));
    }

}
