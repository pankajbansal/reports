<?php

// app/Http/Controllers/ReportController.php

namespace App\Http\Controllers;

use App\Models\User;

use App\Jobs\GenerateWeeklyReport;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function generateReportForUser($userId)
    {
        // Get the user
        $user = User::find($userId);

        if ($user) {
            // Prepare data for the report
            $data = [
                'user' => $user,
                'activity' => $user->userActivities()->weeklyReport()->get() // Example activity stats
            ];
            
            // Load the view and generate the PDF
            $pdf = \PDF::loadView('reports.weekly', $data);

            // Save the PDF to the storage path
            $filePath = storage_path('app/reports/' . $user->id . '-weekly-report.pdf');
            $pdf->save($filePath);

            // Return a response with the generated file path or send an email
            return response()->json(['message' => 'Report generated successfully.', 'file_path' => $filePath]);
        }

        return response()->json(['message' => 'User not found.'], 404);
    }

    public function testQueue($userId)
    {
        $user = User::find($userId);
        GenerateWeeklyReport::dispatch($user);

        return response()->json(['message' => 'Job dispatched successfully!']);
    }
}
