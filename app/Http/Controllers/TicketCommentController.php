<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketComment;

class TicketCommentController extends Controller
{
    // Add a comment to a ticket
    public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        TicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Comment added.');
    }
}
