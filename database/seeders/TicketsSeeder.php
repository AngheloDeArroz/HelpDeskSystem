<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Status;
use App\Models\Priority;

class TicketsSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = Status::all();
        $priorities = Priority::all();
        $users = User::whereHas('role', fn($q) => $q->where('name', 'User'))->get();

        foreach ($users as $user) {
            for ($i = 1; $i <= 2; $i++) {
                Ticket::create([
                    'user_id' => $user->id,
                    'status_id' => $statuses->random()->id,
                    'priority_id' => $priorities->random()->id,
                    'subject' => "Sample Ticket {$i} from {$user->name}",
                    'description' => "This is a sample description for ticket {$i} submitted by {$user->name}."
                ]);
            }
        }
    }
}
