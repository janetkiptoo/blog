<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{

     public function index()
    {
        return view('admin.notifications');
    }

    public function markAsRead($id)
{
    $notification = auth()->user()->notifications()->findOrFail($id);

    $notification->markAsRead();

    if ($notification->data['type'] === 'support_ticket') {
        return redirect()->route(
            'admin.support-tickets.show',
            $notification->data['ticket_id']
        );
    }

    if ($notification->data['type'] === 'loan_application') {
        return redirect()->route(
            'admin.loans.show',
            $notification->data['loan_id']
        );
    }

    return redirect()->route('admin.dashboard');
}
    
}



