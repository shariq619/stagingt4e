<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        return view('backend.notifications.index', compact('notifications'));
    }

    public function fetch()
    {
        $notifications = Auth::user()->unreadNotifications;
        return response()->json($notifications);
    }

    public function markAsRead(Request $request)
    {
        $notification = Auth::user()->notifications()->find($request->id);

        if ($notification) {
            $notification->markAsRead();
            return redirect()->back();
        }

        return response()->json(['message' => 'Notification not found'], 404);
    }

}
