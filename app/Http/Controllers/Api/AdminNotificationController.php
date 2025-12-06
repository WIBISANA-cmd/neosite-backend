<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    public function index(Request $request)
    {
        $query = AdminNotification::orderByDesc('created_at');
        if ($request->user()) {
            $query->where(function ($q) use ($request) {
                $q->whereNull('user_id')->orWhere('user_id', $request->user()->id);
            });
        }

        return $query->paginate(15);
    }

    public function markRead(AdminNotification $notification)
    {
        $notification->update(['is_read' => true]);
        return $notification;
    }
}
