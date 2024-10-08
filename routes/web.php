<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailController;
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
Route::post('admin_profile/update',[AdminController::class,'adminProfileUpdate']);
Route::get('admin/users/',[AdminController::class,'admin_users']);
Route::get('admin/users/view/{id}',[AdminController::class,'admin_users_view']);
Route::get('admin/users/edit/{id}',[AdminController::class,'admin_users_edit']);
Route::post('admin/users/edit/{id}',[AdminController::class,'admin_users_update']);
Route::get('admin/users/delete/{id}',[AdminController::class,'admin_users_delete']);
Route::get('admin/email/compose',[EmailController::class,'email_compose']);
Route::post('admin/email/compose_post',[EmailController::class,'email_compose_post']);
Route::get('admin/email/sent',[EmailController::class,'sent_email']);
Route::get('admin/email_sent',[EmailController::class,'admin_delete_sent_email']);
Route::get('admin/email/read/{id}',[EmailController::class,'admin_read_email']);
Route::get('admin/email/read_delete/{id}',[EmailController::class,'admin_read_delete']);

Route::get('admin/users/create',[AdminController::class,'admin_users_create'])->name('admin.users.create');
Route::post('admin/users/create',[AdminController::class,'admin_users_store'])->name('admin.users.store');
});

Route::middleware('auth','role:agent')->group(function () {

Route::get('agent/dashboard',[AgentController::class,'agentDashboard'])->name('agent.dashboard');
});
Route::get('admin/login',[AdminController::class,'adminLogin'])->name('admin.login');
Route::get('set_new_password/{token}',[AdminController::class,'set_new_password']);
Route::post('set_new_password/{token}',[AdminController::class,'set_new_password_post']);

