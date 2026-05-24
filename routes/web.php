<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login_process', [AuthController::class, 'login_process'])->name('login_process');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [TransactionController::class, 'list'])->name('transaction.list');
    Route::any('/logout', [AuthController::class, 'logout'])->name('logout');

});


Route::get('/viewsession', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    dd(Session::all());
});
