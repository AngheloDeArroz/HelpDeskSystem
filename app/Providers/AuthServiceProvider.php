<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(): void
    {
        $this->registerPolicies();

        // Admin gate
        Gate::define('admin', fn(User $user) => $user->role_id === 1);

        // Support gate
        Gate::define('support', fn(User $user) => $user->role_id === 2);

        // User gate
        Gate::define('user', fn(User $user) => $user->role_id === 3);
    }
}
