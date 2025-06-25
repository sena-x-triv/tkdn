<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');
    Route::resource('workers', App\Http\Controllers\WorkerController::class);
});
