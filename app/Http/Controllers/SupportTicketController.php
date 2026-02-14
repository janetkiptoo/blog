<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Mail\SupportTicketReceived;
use Illuminate\Support\Facades\Mail;

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

    Mail::to($ticket->email)->send(
        new SupportTicketReceived($ticket)
    );

    return back()->with('success', 'Your message has been received. Please check your email.');
}
    //
}

