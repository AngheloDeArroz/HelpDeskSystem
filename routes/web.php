<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketCommentController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\AdminControl;

Route::get('/', fn() => view('welcome'))->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/support/dashboard', [SupportController::class, 'dashboard'])->name('support.dashboard');
    Route::get('/profile', fn() => view('livewire.profile.edit'))->name('profile');

    Route::prefix('tickets')->group(function () {
        
        // Only users with role_id === 3 can access these routes
        Route::middleware('can:user')->group(function () {
            Route::get('/create', [TicketController::class, 'create'])->name('tickets.create');
            Route::post('/', [TicketController::class, 'store'])->name('tickets.store');
        });
        
        // Show ticket (Supports {id} for archived viewing)
        Route::get('/{id}', [TicketController::class, 'show'])->name('tickets.show');

        Route::patch('/{ticket}/solve', [TicketController::class, 'solve'])
            ->middleware('can:support')->name('tickets.solve');

        Route::delete('/{ticket}', [TicketController::class, 'destroy'])
            ->middleware('can:admin')->name('tickets.destroy');

        Route::post('/{ticket}/comments', [TicketCommentController::class, 'store'])->name('tickets.comments.store');
    });

    // ADMIN ONLY
    Route::middleware('can:admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/archive', [DashboardController::class, 'archive'])->name('admin.archive');
        Route::get('/admin/summary', [AdminControl::class, 'summary'])->name('admin.summary');
        Route::post('/tickets/{id}/restore', [TicketController::class, 'restore'])->name('tickets.restore');
    });
});

require __DIR__ . '/auth.php';