<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReturnLogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Items (Catalog / Viewable by both Admin and User)
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');

    // Loans (User can borrow, view own loans; Admin can view all)
    Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/create', [LoanController::class, 'create'])->name('loans.create');
    Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');
    Route::get('/loans/{loan}', [LoanController::class, 'show'])->name('loans.show');

    // Return Logs (Viewable by both)
    Route::get('/return-logs', [ReturnLogController::class, 'index'])->name('return_logs.index');
    Route::get('/return-logs/{returnLog}', [ReturnLogController::class, 'show'])->name('return_logs.show');

    // Admin Only Routes
    Route::middleware(['role:admin'])->group(function () {
        // Categories
        Route::resource('categories', CategoryController::class);

        // Item Management
        Route::get('/items-create', [ItemController::class, 'create'])->name('items.create');
        Route::post('/items', [ItemController::class, 'store'])->name('items.store');
        Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
        Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
        Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

        // Loan delete
        Route::delete('/loans/{loan}', [LoanController::class, 'destroy'])->name('loans.destroy');

        // Return processing
        Route::get('/return-logs-create', [ReturnLogController::class, 'create'])->name('return_logs.create');
        Route::post('/return-logs', [ReturnLogController::class, 'store'])->name('return_logs.store');
        Route::delete('/return-logs/{returnLog}', [ReturnLogController::class, 'destroy'])->name('return_logs.destroy');

        // Reports & Export
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/print', [ReportController::class, 'print'])->name('reports.print');
        Route::get('/reports/export-items', [ReportController::class, 'exportItems'])->name('reports.export_items');
        Route::get('/reports/export-loans', [ReportController::class, 'exportLoans'])->name('reports.export_loans');

        // Activity Logs
        Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity_logs.index');

        // Users Management
        Route::resource('users', UserController::class);
    });
});

require __DIR__.'/auth.php';
