<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Cohort;
use App\Models\Lead;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $clients = User::role('Corporate Client')->count();
        $learners = User::role('Learner')->count();
        $leads = Lead::count();

        $recent_learners = User::with('profilePhoto')
            ->role('Learner')
            ->latest()
            ->take(20)
            ->get();

        $recent_cohorts = Cohort::with('course')
            ->whereNull('deleted_at')
            ->orderByDesc('start_date_time')
            ->take(20)
            ->get();

        $recent_leads = Lead::orderByDesc('contact_date')
            ->orderByDesc('created_at')
            ->take(20)
            ->get();

        return view('crm.dashboard.index', compact(
            'clients',
            'learners',
            'leads',
            'recent_learners',
            'recent_cohorts',
            'recent_leads'
        ));
    }
}
