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
        $notification = auth()
            ->user()
            ->notifications()
            ->findOrFail($id);

        $notification->markAsRead();

        return redirect()->route(
            'admin.loans.show',
            $notification->data['loan_id']
        );
    }
    
}



