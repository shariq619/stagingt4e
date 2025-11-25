<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Controller;
use App\Models\Cohort;
use App\Models\FrontOrder;
use App\Models\ProductInvoicePayment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $clients  = User::role('Corporate Client')->count();
        $learners = User::role('Learner')->count();

        $orders = ProductInvoicePayment::count();

        $sales = ProductInvoicePayment::where(function ($q) {
            $q->whereNull('is_refunded')
                ->orWhere('is_refunded', false);
        })->sum('amount');

        $recent_learners = User::with('profilePhoto')
            ->role('Learner')
            ->latest()
            ->take(20)
            ->get();

        $recent_cohorts = Cohort::with('course')
            ->withCount('learners')
            ->latest('start_date_time')
            ->take(20)
            ->get();

        $payments = ProductInvoicePayment::with(['invoice.user'])
            ->latest('payment_date')
            ->take(20)
            ->get();

        return view('crm.dashboard.index', compact(
            'learners',
            'clients',
            'orders',
            'sales',
            'recent_learners',
            'recent_cohorts',
            'payments'
        ));
    }


}
