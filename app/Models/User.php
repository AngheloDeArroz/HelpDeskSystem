<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // A user has many tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // A user may have many comments
    public function ticketComments()
    {
        return $this->hasMany(TicketComment::class);
    }

    // User belongs to a role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Shortcut to check if user is admin
    public function isAdmin()
    {
        return $this->role && $this->role->name === 'admin';
    }
}
