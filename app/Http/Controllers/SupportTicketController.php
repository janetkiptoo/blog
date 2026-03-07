<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Mail\SupportTicketReceived;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Notifications\SupportTicketCreated;

class SupportTicketController extends Controller
{

public function store(Request $request)
{
    $validated = $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email',
        'category' => 'required|string',
        'message'  => 'required|string|max:2000',
    ]);

    $ticket = SupportTicket::create($validated);
    $admins = User::where('role', 'admin')->get();

    foreach ($admins as $admin) {
        $admin->notify(new SupportTicketCreated($ticket));
    }
    Mail::to($ticket->email)->send(new SupportTicketReceived($ticket));

    return redirect()->route('web.contact')->with('success', 'Your message has been received. Please check your email.');
}
    //
}

