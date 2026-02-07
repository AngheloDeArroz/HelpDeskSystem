<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'priority_id',
        'status_id',
        'title', 
        'subject',       
        'description',
    ];

    // Relationship to the user who submitted the ticket
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to the ticket status
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    // Relationship to the ticket priority
    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    // Relationship to comments
    public function comments()
    {
        return $this->hasMany(TicketComment::class);
    }
}
