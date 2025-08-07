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
    Route::resource('tkdn', App\Http\Controllers\TkdnController::class)->parameters(['tkdn' => 'tkdnItem']);
    Route::patch('tkdn/{tkdnItem}/toggle-status', [App\Http\Controllers\TkdnController::class, 'toggleStatus'])->name('tkdn.toggle-status');
    
    // TKDN Breakdown
    Route::get('tkdn-breakdown', [App\Http\Controllers\TkdnBreakdownController::class, 'index'])->name('tkdn.breakdown');
    Route::get('tkdn-breakdown/print', [App\Http\Controllers\TkdnBreakdownController::class, 'print'])->name('tkdn.breakdown.print');
});

Route::resource('service', App\Http\Controllers\ServiceController::class);
Route::post('service/{service}/submit', [App\Http\Controllers\ServiceController::class, 'submit'])->name('service.submit');
Route::post('service/{service}/approve', [App\Http\Controllers\ServiceController::class, 'approve'])->name('service.approve');
Route::post('service/{service}/reject', [App\Http\Controllers\ServiceController::class, 'reject'])->name('service.reject');

Route::view('support', 'support')->name('support');