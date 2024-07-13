<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth','role:admin')->group(function () {
Route::get('admin/dashboard',[AdminController::class,'adminDashboard'])->name('admin.dashboard');
Route::get('admin/logout',[AdminController::class,'adminLogout'])->name('admin.logout');
Route::get('admin/profile',[AdminController::class,'adminProfile']);
});

Route::middleware('auth','role:agent')->group(function () {

Route::get('agent/dashboard',[AgentController::class,'agentDashboard'])->name('agent.dashboard');
});
Route::get('admin/login',[AdminController::class,'adminLogin'])->name('admin.login');

