<?php

namespace App\Http\Controllers\CRM;

use Illuminate\Http\Request;
use App\Models\Qualification;
use App\Http\Controllers\Controller;
use App\Models\UserPostQualification;
use App\Http\Requests\Crm\UserPostQualificationRequest;

class UserPostQualificationController extends Controller
{
    public function store(UserPostQualificationRequest $request)
    {
        $qualification = UserPostQualification::updateOrCreate(
            [
                'user_id' => $request->user_id,
                'cohort_id' => $request->cohort_id ?? null,
            ],
            [
                'qualification_status' => $request->qualification_status,
                'date_of_last_expiry' => $request->date_of_last_expiry,
                'registration_date' => $request->registration_date,
            ]
        );

        return response()->json(['success' => true, 'qualification' => $qualification]);
    }
}
