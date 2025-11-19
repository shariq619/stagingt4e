<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Controller;
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
            ->take(9)
            ->get();

        $payments = ProductInvoicePayment::with(['invoice.user'])
            ->latest('payment_date')
            ->take(10)
            ->get();

        return view('crm.dashboard.index', compact(
            'learners',
            'clients',
            'orders',
            'sales',
            'recent_learners',
            'payments'
        ));
    }

}
