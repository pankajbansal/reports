<?php

// app/Http/Controllers/ReportController.php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade as Pdf;

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
            $pdf = Pdf::loadView('reports.weekly', $data);

            // Save the PDF to the storage path
            $filePath = storage_path('app/reports/' . $user->id . '-weekly-report.pdf');
            $pdf->save($filePath);

            // Return a response with the generated file path or send an email
            return response()->json(['message' => 'Report generated successfully.', 'file_path' => $filePath]);
        }

        return response()->json(['message' => 'User not found.'], 404);
    }
}
