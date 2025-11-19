<?php

namespace App\Console\Commands;

use App\Libraries\ScormApiService;
use App\Models\Cohort;
use App\Models\LearnerCertificate;
use App\Models\License;
use App\Models\TaskSubmission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Tcpdf\Fpdi;


class GenerateCompletedCertificates extends Command
{
    protected $signature = 'certificates:generate';
    protected $description = 'Generate certificates for completed e-learning courses';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get task submissions for only user_id 41 where task_id is null
        $taskSubmissions = TaskSubmission::whereNull('task_id')
          //  ->where('user_id', 67)
            ->where('status', '!=', 'Approved')
            ->get();

        foreach ($taskSubmissions as $taskSubmission) {
            try {
                $learner = User::find($taskSubmission->user_id);
                $cohort = Cohort::find($taskSubmission->cohort_id);


                 // Skip if user or cohort not found
                if (!$learner || !$cohort) {
                    Log::channel('cron')->error("User or Cohort not found for TaskSubmission ID: {$taskSubmission->id}");
                    continue;
                }

                // Skip if certificate already exists for this specific license
                if (LearnerCertificate::where('user_id', $learner->id)
                    ->where('cohort_id', $taskSubmission->cohort_id)
                    ->where('license_id', $taskSubmission->license_id)
                    ->exists()) {
                    Log::channel('cron')->info("Certificate already exists for User: {$learner->name}, License: {$taskSubmission->license_id}");
                    continue;
                }

                $scormApiService = new ScormApiService();
                $course_info = $scormApiService->getRegistrationDetails(
                    $taskSubmission->scorm_registration_id,
                );

                if(isset($course_info)) {

                    $activity_completion = $course_info['activityDetails']['activityCompletion'] ?? 'N/A';

                    if($activity_completion === 'COMPLETED') {

                        $learnerName = $learner->name . ' ' . $learner->last_name;
                        $courseName = $cohort->course->name ?? 'Unknown Course';
                        $courseLicense = License::find($taskSubmission->license_id); // Get the specific license

                        if (!$courseLicense) {
                            Log::channel('cron')->error("License not found for ID: {$taskSubmission->license_id}");
                            continue;
                        }

                        $issueDate = Carbon::now()->format('d/m/Y');

                        // ACT Awarness
//                        if($taskSubmission->license_id == 1){
//
//                            // Initialize PDF
//                            $pdf = new Fpdi();
//                            $pdf->AddPage();
//                            $pdf->setSourceFile(public_path('act_awareness-template.pdf'));
//                            $templateId = $pdf->importPage(1);
//                            $pdf->useTemplate($templateId, 0, 0, 210);
//
//                            // Fill content
//                            $pdf->SetFont('Helvetica', '', 12);
//                            $currentY = 78;
//
//
//                            $pdf->SetFont('Helvetica', 'B', 18);
//                            $pdf->SetXY(0, $currentY);
//                            $pdf->Cell(0, 10, $learnerName, 0, 1, 'C');
//                            $currentY += 15;
//
//                            // Add some space before dates
//                            $currentY += 72;
//                            // Issue Date (centered)
//                            $pdf->SetFont('Helvetica', '', 12);
//                            $pdf->SetXY(48, $currentY);
//                            $pdf->Cell(0, 8,  $issueDate, 0, 1, 'C');
//
//                            // Save PDF
//                            $fileName = 'certificate_act_awarness' . uniqid() . '.pdf';
//                            $userDir = 'learners/' . str_replace(' ', '_', strtolower($learnerName));
//                            $filePath = $userDir . '/' . $fileName;
//
//                            // Ensure directory exists
//                            Storage::disk('public')->makeDirectory($userDir);
//
//                            // Save PDF
//                            $pdf->Output(storage_path('app/public/' . $filePath), 'F');
//
//                            // Create certificate record
//                            LearnerCertificate::create([
//                                'user_id' => $learner->id,
//                                'cohort_id' => $cohort->id,
//                                'license_id' => $courseLicense->id,
//                                'certificate_path' => $filePath,
//                                'created_at' => now(),
//                            ]);
//
//                            // Update task status
//                            $taskSubmission->update(['status' => 'Approved']);
//
//                            Log::channel('cron')->info("Successfully generated certificate for {$learnerName} - {$courseName}");
//
//                        } elseif($taskSubmission->license_id == 2) { // ACT Security
//
//                            // Initialize PDF
//                            $pdf = new Fpdi();
//                            $pdf->AddPage();
//                            $pdf->setSourceFile(public_path('act_security-template.pdf'));
//                            $templateId = $pdf->importPage(1);
//                            $pdf->useTemplate($templateId, 0, 0, 210);
//
//                            $pdf->SetFont('Helvetica', 'B', 18);
//                            $pdf->SetXY(0, 98); // Adjust Y position as needed
//                            $pdf->Cell(0, 10, $learnerName, 0, 1, 'C');
//
//
//                            $pdf->SetFont('Helvetica', '', 12);
//                            $pdf->SetXY(66, 198.5); // Adjust X and Y positions based on template
//                            $pdf->Cell(0, 8, $issueDate, 0, 1, 'L');
//
//                            // Save PDF
//                            $fileName = 'certificate_act_security' . uniqid() . '.pdf';
//                            $userDir = 'learners/' . str_replace(' ', '_', strtolower($learnerName));
//                            $filePath = $userDir . '/' . $fileName;
//
//                            // Ensure directory exists
//                            Storage::disk('public')->makeDirectory($userDir);
//
//                            // Save PDF
//                            $pdf->Output(storage_path('app/public/' . $filePath), 'F');
//
//                            // Create certificate record
//                            LearnerCertificate::create([
//                                'user_id' => $learner->id,
//                                'cohort_id' => $cohort->id,
//                                'license_id' => $courseLicense->id,
//                                'certificate_path' => $filePath,
//                                'created_at' => now(),
//                            ]);
//
//                            // Update task status
//                            $taskSubmission->update(['status' => 'Approved']);
//
//                            Log::channel('cron')->info("Successfully generated certificate for {$learnerName} - {$courseName}");
//
//                        } else {

                            // Initialize PDF
                            $pdf = new Fpdi();
                            $pdf->AddPage();
                            $pdf->setSourceFile(public_path('certificate-template.pdf'));
                            $templateId = $pdf->importPage(1);
                            $pdf->useTemplate($templateId, 0, 0, 210);

                            // Fill content
                            $pdf->SetFont('Helvetica', '', 12);
                            $currentY = 110;

                            // Certification text
                            $pdf->SetFont('Helvetica', 'I', 12);
                            $pdf->SetXY(0, $currentY);
                            $pdf->Cell(0, 8, "This certification is presented to", 0, 1, 'C');
                            $currentY += 12;

                            // Learner name
                            $pdf->SetFont('Helvetica', 'B', 18);
                            $pdf->SetXY(0, $currentY);
                            $pdf->Cell(0, 10, $learnerName, 0, 1, 'C');
                            $currentY += 15;

                            // Completion text
                            $pdf->SetFont('Helvetica', 'I', 12);
                            $pdf->SetXY(0, $currentY);
                            $pdf->Cell(0, 8, "has successfully completed the following course:", 0, 1, 'C');
                            $currentY += 12;

                            // Course name (with special handling for long names)
                            $pdf->SetFont('Helvetica', 'B', 16);

                            if ($courseName == "Level 1 Health and Safety Awareness within Construction Environment") {
                                // First line
                                $pdf->SetXY(0, $currentY);
                                $pdf->Cell(0, 10, "Level 1 Health and Safety Awareness", 0, 1, 'C');
                                $currentY += 10;
                                // Second line
                                $pdf->SetXY(0, $currentY);
                                $pdf->Cell(0, 10, "within Construction Environment", 0, 1, 'C');
                                $currentY += 15;
                            } else {
                                $pdf->SetXY(0, $currentY);
                                $pdf->Cell(0, 10, $courseName, 0, 1, 'C');
                                $currentY += 15;
                            }

                            // Get course modules from SCORM
                            $scormApiService = new ScormApiService();
                            $courseData = $scormApiService->getCourse($courseLicense->course_id);
                            $modules = [];

                            if (isset($courseData['rootActivity']) && isset($courseData['rootActivity']['children'])) {
                                $modules = array_map(function ($child) {
                                    return $child['title'];
                                }, $courseData['rootActivity']['children']);
                            }

                            // Modules section header
                            $pdf->SetFont('Helvetica', '', 12);
                            $pdf->SetXY(0, $currentY);
                            $pdf->Cell(0, 8, "A pass was achieved in the following modules:", 0, 1, 'C');
                            $currentY += 10;

                            // Modules list
                            $pdf->SetFont('Helvetica', '', 13);
                            $maxWidth = 120;
                            $centerX = (210 - $maxWidth) / 2;

                            foreach ($modules as $module) {
                                $pdf->SetXY($centerX, $currentY);
                                $pdf->Cell($maxWidth, 6, "• " . $module, 0, 1, 'L');
                                $currentY += 7;
                            }

                            // Issue date
                            $currentY += 5;
                            $pdf->SetFont('Helvetica', '', 12);
                            $pdf->SetXY(0, $currentY);
                            $pdf->Cell(0, 8, "Issue Date: " . $issueDate, 0, 1, 'C');

                            // Save PDF
                            $fileName = 'certificate_general_' . uniqid() . '.pdf';
                            $userDir = 'learners/' . str_replace(' ', '_', strtolower($learnerName));
                            $filePath = $userDir . '/' . $fileName;

                            // Ensure directory exists
                            Storage::disk('public')->makeDirectory($userDir);

                            // Save PDF
                            $pdf->Output(storage_path('app/public/' . $filePath), 'F');

                            // Create certificate record
                            LearnerCertificate::create([
                                'user_id' => $learner->id,
                                'cohort_id' => $cohort->id,
                                'license_id' => $courseLicense->id,
                                'certificate_path' => $filePath,
                                'created_at' => now(),
                            ]);

                            // Update task status
                            $taskSubmission->update(['status' => 'Approved']);

                            Log::channel('cron')->info("Successfully generated certificate for {$learnerName} - {$courseName}");

                      //  }

                    }

                }

            } catch (\Throwable  $e) {

//                Log::channel('cron')->error("Cron Job Top-level Error: " . $e->getMessage(), [
//                    'trace' => $e->getTraceAsString()
//                ]);

//                Log::channel('cron')->error("Failed to generate certificate for TaskSubmission ID: {$taskSubmission->id} - " . $e->getMessage());
//                Log::channel('cron')->error("Certificate generation failed", [
//                    'task_submission_id' => $taskSubmission->id,
//                    'error' => $e->getMessage(),
//                    'trace' => $e->getTraceAsString()
//                ]);

                continue;
            }
        }
    }

}
