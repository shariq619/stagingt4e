<?php

namespace App\Http\Controllers\Backend;

use App\Exports\SubscribersExport;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $subscribers = Subscriber::when(!empty($search), function ($q) use ($search) {
            return $q->where(function ($query) use ($search) {
                $query->where('full_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        })->orderBy('created_at', 'desc')->paginate(15);
        return view('backend.subscribers.index', compact('subscribers'));
    }

    public function export()
    {
        return Excel::download(new SubscribersExport, 'subscribers.xlsx');
    }
}
