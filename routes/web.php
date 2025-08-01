<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'edit'])->name('settings.edit');
Route::patch('/settings', [App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');

Route::prefix('master')->name('master.')->group(function () {
    Route::resource('worker', App\Http\Controllers\WorkerController::class);
    Route::resource('material', App\Http\Controllers\MaterialController::class);
    Route::resource('project', App\Http\Controllers\ProjectController::class);
    Route::resource('estimation', \App\Http\Controllers\EstimationController::class);
    Route::resource('equipment', \App\Http\Controllers\EquipmentController::class);
    Route::resource('category', App\Http\Controllers\CategoryController::class);
});

Route::view('support', 'support')->name('support');