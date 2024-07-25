<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    function list(Request $request)
    {
        return view('notification.list', [
            'notifications' => $request->user()->notifications
        ]);
    }

    function read(string $notification_id, Request $request)
    {
        $notification = $request->user()->notifications->where('id', $notification_id)->firstOrFail();

        if (!$notification->read_at) $notification->markAsRead();

        if (isset($notification->data['route'])) {
            return redirect()->route(
                $notification->data['route'],
                $notification->data['routeParam']
            );
        }
        return back();
    }
}