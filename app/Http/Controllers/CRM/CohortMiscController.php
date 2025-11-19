<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Cohort;
use App\Models\CohortMiscellounose;
use Illuminate\Http\Request;

class CohortMiscController extends Controller
{
    public function dt(Cohort $cohort)
    {
        $rows = CohortMiscellounose::where('cohort_id', $cohort->id)
            ->orderBy('id', 'asc')
            ->get(['id','nominal_code','description','cost','quantity','net_cost','vat','created_at as created_from']);

        return response()->json([
            'exclude' => (bool)($cohort->exclude_misc ?? false),
            'data'    => $rows,
        ]);
    }

    public function store(Request $request, Cohort $cohort)
    {
        $data = $request->validate([
            'nominal_code' => ['nullable','string','max:191'],
            'description'  => ['nullable','string','max:191'],
            'cost'         => ['required','numeric','min:0'],
            'quantity'     => ['required','integer','min:1'],
            'vat_rate'     => ['nullable','numeric','min:0'],
            'created_from' => ['nullable','string','max:191'],
        ]);

        $net = round(($data['cost'] ?? 0) * ($data['quantity'] ?? 1), 2);
        $rate = floatval($request->input('vat_rate', 20));
        $vat = round($net * ($rate/100), 2);

        $row = CohortMiscellounose::create([
            'cohort_id'    => $cohort->id,
            'nominal_code' => $data['nominal_code'] ?? null,
            'description'  => $data['description'] ?? null,
            'cost'         => $data['cost'],
            'quantity'     => $data['quantity'],
            'net_cost'     => $net,
            'vat'          => $vat,
        ]);

        return response()->json(['message' => 'Saved', 'row' => $row], 201);
    }

    public function update(Request $request, Cohort $cohort, CohortMiscellounose $misc)
    {
        $data = $request->validate([
            'nominal_code' => ['nullable','string','max:191'],
            'description'  => ['nullable','string','max:191'],
            'cost'         => ['required','numeric','min:0'],
            'quantity'     => ['required','integer','min:1'],
            'vat_rate'     => ['nullable','numeric','min:0'],
            'created_from' => ['nullable','string','max:191'],
        ]);

        $net = round(($data['cost'] ?? 0) * ($data['quantity'] ?? 1), 2);
        $rate = floatval($request->input('vat_rate', 20));
        $vat = round($net * ($rate/100), 2);

        $misc->update([
            'nominal_code' => $data['nominal_code'] ?? null,
            'description'  => $data['description'] ?? null,
            'cost'         => $data['cost'],
            'quantity'     => $data['quantity'],
            'net_cost'     => $net,
            'vat'          => $vat,
        ]);

        return response()->json(['message' => 'Updated']);
    }

    public function destroy(Cohort $cohort, CohortMiscellounose $misc)
    {
        $misc->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function toggleExclude(Request $request, Cohort $cohort)
    {
        $val = $request->validate(['exclude' => ['required','boolean']]);
        $cohort->exclude_misc = $val['exclude'];
        $cohort->save();

        return response()->json(['message' => 'Saved', 'exclude' => (bool)$cohort->exclude_misc]);
    }
}
