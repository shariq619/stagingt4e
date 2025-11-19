<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::role('Corporate Client');
        $search = request()->get('search', '');
        if (!empty($search)) {
            $customers->where(function ($q) use ($search) {
                $nameInput = $search;
                $q->where('name', 'like', '%' . $nameInput . '%')
                    ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%{$nameInput}%"]);
            });
        }
        $customers = $customers->paginate(10);
        return view('crm.customers.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = User::role('Corporate Client')->with('learners.cohorts')->findOrFail($id);
        return view('crm.customers.show', compact('customer'));
    }
}
