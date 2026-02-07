<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminControl
{
    public function summary()
    {
        // Only show regular users (exclude Admin and Support)
        $users = User::whereNotIn('role_id', [1, 2])
            ->withCount([
                'tickets',
                'tickets as closed_tickets_count' => function ($query) {
                    $query->whereHas('status', fn($q) => $q->where('name', 'closed'));
                },
                'tickets as pending_tickets_count' => function ($query) {
                    $query->whereHas('status', fn($q) => $q->where('name', '<>', 'closed'));
                }
            ])
            ->orderByDesc('tickets_count') // Order by number of tickets submitted
            ->get();

        return view('admin.summary', compact('users'));
    }

    
    
}
