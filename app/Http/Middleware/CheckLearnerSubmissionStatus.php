<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLearnerSubmissionStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Check if Application Form is submitted
        if (!$user->hasSubmittedApplicationForm()) {
            return redirect()->route('backend.required.tasks');
        }

        // Check if Profile Photo is uploaded
        if (!$user->hasUploadedProfilePhoto()) {
            return redirect()->route('backend.required.tasks');
        }

        // Check if Document Uploads are submitted
        if (!$user->hasUploadedDocuments()) {
            return redirect()->route('backend.required.tasks');
        }

        // Check if User Certification is submitted
        if (!$user->hasUserCertification()) {

            $learner = auth()->user();
            $cohorts = $learner->cohorts()
                ->whereHas('course', function ($query) {
                    $query->whereNotNull('qualification_type');
                })
                ->with(['course']) // Load the course with its associated tasks
                ->get();

            if($cohorts->count()){
                return redirect()->route('backend.required.tasks');
            }

        }

        // Store a flag in the session to indicate middleware passed
       // session(['middleware_passed' => true]);

        return $next($request);
    }
}
