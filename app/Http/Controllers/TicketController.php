<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Priority;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Show the form to create a new ticket
     */
    public function create()
    {
        $priorities = Priority::all();
        return view('tickets.create', compact('priorities'));
    }

    /**
     * Store a newly created ticket
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'priority_id' => 'required|exists:priorities,id',
        ]);

        Ticket::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'description' => $request->description,
            'status_id' => 1, 
            'priority_id' => $request->priority_id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Ticket submitted successfully.');
    }

    /**
     * Display the specified ticket.
     * FIXED: Using $id to manually handle the query and allow archived viewing.
     */
    public function show($id)
    {
        $user = Auth::user();
        $role = strtolower($user->role->name);

        // 1. Fetch ticket (Admins can see trashed, others only active)
        $query = ($role === 'admin') ? Ticket::withTrashed() : Ticket::query();
        
        $ticket = $query->with(['user', 'status', 'priority', 'comments.user'])
            ->findOrFail($id);

        // 2. Authorization Check
        if ($user->id !== $ticket->user_id && !in_array($role, ['support', 'admin'])) {
            abort(403);
        }

        return view('tickets.show', compact('ticket'));
    }

    /**
     * Mark a ticket as solved
     * FIXED: Using $id and withTrashed() so support doesn't 404 on archived tickets
     */
    public function solve($id)
    {
        $ticket = Ticket::withTrashed()->findOrFail($id);
        
        $closedStatusId = 2;
        $inProgressStatusId = 1;

        if ($ticket->status_id == $closedStatusId) {
            return redirect()->back()->with('info', 'This ticket is already closed.');
        }

        $ticket->status_id = $closedStatusId;
        $ticket->save();

        return redirect()->back()->with('success', 'Ticket marked as solved.');
    }

    /**
     * Archive/Soft Delete the ticket (Admin Only)
     * FIXED: Using $id ensures this works even if called from an archived state view
     */
    public function destroy($id)
    {
        if (strtolower(Auth::user()->role->name) !== 'admin') {
            abort(403);
        }

        $ticket = Ticket::withTrashed()->findOrFail($id);
        $ticket->delete();

        return back()->with('success', 'Ticket Deleted (Archived).');
    } 

    /**
     * Restore a soft-deleted ticket (Admin Only)
     */
    public function restore($id)
    {
        if (strtolower(Auth::user()->role->name) !== 'admin') {
            abort(403);
        }

        $ticket = Ticket::withTrashed()->findOrFail($id);
        $ticket->restore();

        // Stay on current page (usually the archive list)
        return back()->with('success', 'Ticket restored to Dashboard.');
    }
}