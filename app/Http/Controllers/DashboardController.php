<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $roleName = strtolower($user->role->name);

        // Standard query excludes soft-deleted tickets by default
        $query = Ticket::with(['user', 'status', 'priority']);

        if ($roleName === 'admin') {
            $tickets = $this->applyOrdering($query)->get();
            return view('admin.dashboard', compact('tickets'));
        }

        if ($roleName === 'support') {
            $tickets = $this->applyOrdering($query)->get();
            return view('support.dashboard', [
                'tickets' => $tickets,
                'totalTickets' => $tickets->count(),
                'solvedTickets' => $tickets->filter(fn($t) => strtolower($t->status->name) === 'closed')->count(),
                'remainingTickets' => $tickets->filter(fn($t) => strtolower($t->status->name) !== 'closed')->count(),
            ]);
        }

        // Regular User
        $tickets = $this->applyOrdering($query)->where('user_id', $user->id)->get();
        return view('user.dashboard', compact('tickets'));
    }

    public function archive()
    {
        if (strtolower(Auth::user()->role->name) !== 'admin') abort(403);

        // Fetch ONLY trashed tickets
        $query = Ticket::onlyTrashed()->with(['user', 'status', 'priority']);
        $tickets = $this->applyOrdering($query)->get();

        return view('admin.archive', compact('tickets'));
    }

    private function applyOrdering($query)
    {
        return $query
            ->join('priorities', 'tickets.priority_id', '=', 'priorities.id')
            ->join('statuses', 'tickets.status_id', '=', 'statuses.id')
            ->orderByRaw("CASE WHEN LOWER(statuses.name) = 'closed' THEN 2 ELSE 1 END")
            ->orderByRaw("CASE LOWER(priorities.name) WHEN 'urgent' THEN 1 WHEN 'high' THEN 2 WHEN 'medium' THEN 3 WHEN 'low' THEN 4 ELSE 5 END")
            ->select('tickets.*');
    }
}