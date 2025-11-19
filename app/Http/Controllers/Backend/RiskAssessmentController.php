<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Cohort;
use App\Models\RiskAssessment;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Http\Request;

class RiskAssessmentController extends Controller
{
    public function index()
    {
        $riskAssessments = RiskAssessment::with(['cohort', 'venue', 'trainer'])->latest()->paginate(10);
        return view('backend.risk_assessments.index', compact('riskAssessments'));
    }

    public function create(Request $request)
    {
        $cohortId = $request->get('cohort_id'); // <-- get it here
        $cohort = Cohort::find($cohortId);
        return view('backend.risk_assessments.create', compact('cohort'));
    }

    public function store(Request $request)
    {

        $cohort = Cohort::find($request->cohort_id);

        $data = $request->validate([
            'checklist' => 'array',
            'comments' => 'array',
            'hazards' => 'nullable|string',
            'control_measures' => 'nullable|string',
            'tutor_assessing' => 'nullable|string',
            'location_assessed' => 'nullable|string',
            'delegates' => 'nullable|string',
            'dimensions' => 'nullable|string',
            'sign_date' => 'nullable|date',
        ]);

        // Merge checklist & comments into a single structure
        $checklist = [];
        foreach ($request->checklist ?? [] as $key => $status) {
            $checklist[$key] = [
                'status' => $status,
                'comment' => $request->comments[$key] ?? null,
            ];
        }

        $tutor_signature = $request->input('tutor_signature');

        if ($tutor_signature) {
            $tutor_signature = str_replace('data:image/png;base64,', '', $tutor_signature);
            $tutor_signature = str_replace(' ', '+', $tutor_signature);
            $tutor_signature = 'data:image/png;base64,' . $tutor_signature;
        }


        RiskAssessment::create([
            'cohort_id' => $cohort->id,
            'venue_id' => $cohort->venue_id,
            'trainer_id' => $cohort->trainer_id,
            'course_name' => $cohort->course->name,
            'trainer_name' => $cohort->trainer->name,

            'tutor_assessing' => $request->tutor_assessing,
            'location_assessed' => $request->location_assessed,
            'delegates' => $request->delegates,
            'dimensions' => $request->dimensions,

            'checklist' => $checklist,
            'hazards' => $request->hazards,
            'control_measures' => $request->control_measures,
            'tutor_signature' => $tutor_signature,
            'sign_date' => $request->sign_date,
        ]);

        return redirect()->route('backend.risk-assessments.index')->with('success', 'Risk Assessment added successfully.');
    }

    public function show(RiskAssessment $riskAssessment)
    {
        $cohort = Cohort::find($riskAssessment->cohort_id);
        return view('backend.risk_assessments.show', compact('riskAssessment', 'cohort'));
    }

    public function edit(RiskAssessment $riskAssessment)
    {
        $cohorts = Cohort::all();
        $venues = Venue::pluck('venue_name', 'id');
        $trainers = User::pluck('name', 'id');
        return view('backend.risk_assessments.edit', compact('riskAssessment', 'cohorts', 'venues', 'trainers'));
    }

    public function update(Request $request, RiskAssessment $riskAssessment)
    {
        $data = $request->validate([
            'cohort_id' => 'required|exists:cohorts,id',
            'venue_id' => 'nullable|exists:venues,id',
            'trainer_id' => 'required|exists:users,id',
            'course_name' => 'required|string|max:255',
            'trainer_name' => 'required|string|max:255',
            'checklist' => 'nullable|array',
            'hazards' => 'nullable|string',
            'control_measures' => 'nullable|string',
            'tutor_signature' => 'nullable|string',
            'sign_date' => 'nullable|date',
        ]);

        $riskAssessment->update($data);

        return redirect()->route('backend.risk-assessments.index')->with('success', 'Risk Assessment updated successfully.');
    }

    public function destroy(RiskAssessment $riskAssessment)
    {
        $riskAssessment->delete();
        return redirect()->route('backend.risk-assessments.index')->with('success', 'Risk Assessment deleted successfully.');
    }
}
