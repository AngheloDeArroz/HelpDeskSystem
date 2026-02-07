<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class SupportController
{
    public function dashboard(Request $request)
    {
        // 1. Get the search term from the URL
        $search = $request->input('search');

        // 2. Start the query with eager loading to prevent N+1 performance issues
        $query = Ticket::with(['user', 'status', 'priority']);

        // 3. If there is a search term, apply the filters
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'ILIKE', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'ILIKE', "%{$search}%");
                    })
                    ->orWhereHas('priority', function ($q) use ($search) {
                       
                    $q->where('name', 'ILIKE', "%{$search}%");
                    })
                    ->orWhereHas('status', function ($q) use ($search) {
                        $q->where('name', 'ILIKE', "%{$search}%");
                    });
            });
        }

        // 4. Order logic: Closed (status_id 2) at the bottom, newest first otherwise
        // status_id = 2 returns true(1) or false(0). Sorting ASC puts 0s first.
        $tickets = $query->orderByRaw('status_id = 2 ASC')
                         ->orderBy('created_at', 'desc')
                         ->get();

        // 5. Calculate stats
        $totalTickets = Ticket::count();
        $solvedTickets = Ticket::where('status_id', 2)->count(); 
        $remainingTickets = Ticket::where('status_id', '!=', 2)->count(); 

        return view('support.dashboard', compact(
            'tickets',
            'totalTickets',
            'solvedTickets',
            'remainingTickets'
        ));
    }
}