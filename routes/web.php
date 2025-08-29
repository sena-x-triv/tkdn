<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'edit'])->name('settings.edit');
Route::patch('/settings', [App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');

// Users Management Routes
Route::resource('users', App\Http\Controllers\UserController::class);

Route::prefix('master')->name('master.')->group(function () {
    // Worker routes - specific routes must come BEFORE resource route
    Route::get('worker/download-template', [App\Http\Controllers\WorkerController::class, 'downloadTemplate'])->name('worker.download-template');
    Route::post('worker/import', [App\Http\Controllers\WorkerController::class, 'import'])->name('worker.import');
    Route::resource('worker', App\Http\Controllers\WorkerController::class);

    // Material routes - specific routes must come BEFORE resource route
    Route::get('material/download-template', [App\Http\Controllers\MaterialController::class, 'downloadTemplate'])->name('material.download-template');
    Route::post('material/import', [App\Http\Controllers\MaterialController::class, 'import'])->name('material.import');
    Route::resource('material', App\Http\Controllers\MaterialController::class);

    // Project routes - specific routes must come BEFORE resource route
    Route::get('project/download-template', [App\Http\Controllers\ProjectController::class, 'downloadTemplate'])->name('project.download-template');
    Route::post('project/import', [App\Http\Controllers\ProjectController::class, 'import'])->name('project.import');
    Route::resource('project', App\Http\Controllers\ProjectController::class);

    // Equipment routes - specific routes must come BEFORE resource route
    Route::get('equipment/download-template', [App\Http\Controllers\EquipmentController::class, 'downloadTemplate'])->name('equipment.download-template');
    Route::post('equipment/import', [App\Http\Controllers\EquipmentController::class, 'import'])->name('equipment.import');
    Route::resource('equipment', App\Http\Controllers\EquipmentController::class);

    Route::resource('estimation', \App\Http\Controllers\EstimationController::class);
    Route::resource('category', App\Http\Controllers\CategoryController::class);
});

// Service Routes - Specific routes must come BEFORE resource route
Route::get('service/get-hpp-data', [App\Http\Controllers\ServiceController::class, 'getHppData'])->name('service.get-hpp-data');
Route::resource('service', App\Http\Controllers\ServiceController::class);
Route::post('service/{service}/submit', [App\Http\Controllers\ServiceController::class, 'submit'])->name('service.submit');
Route::post('service/{service}/approve', [App\Http\Controllers\ServiceController::class, 'approve'])->name('service.approve');
Route::post('service/{service}/reject', [App\Http\Controllers\ServiceController::class, 'reject'])->name('service.reject');
Route::post('service/{service}/generate', [App\Http\Controllers\ServiceController::class, 'generate'])->name('service.generate');
Route::post('service/{service}/generate-form/{formNumber}', [App\Http\Controllers\ServiceController::class, 'generateForm'])->name('service.generate-form');
Route::get('service/{service}/export/excel/{classification}', [App\Http\Controllers\ServiceController::class, 'exportExcel'])->name('service.export.excel');

// HPP Routes - Specific routes must come BEFORE resource route
Route::get('hpp/get-ahs-data', [App\Http\Controllers\HppController::class, 'getAhsDataAjax'])->name('hpp.get-ahs-data');
Route::get('hpp/get-ahs-items', [App\Http\Controllers\HppController::class, 'getAhsItems'])->name('hpp.get-ahs-items');
Route::get('hpp/{hpp}/get-estimation-items', [App\Http\Controllers\HppController::class, 'getEstimationItems'])->name('hpp.get-estimation-items');
Route::resource('hpp', App\Http\Controllers\HppController::class);
Route::patch('hpp/{hpp}/approve', [App\Http\Controllers\HppController::class, 'approve'])->name('hpp.approve');
Route::patch('hpp/{hpp}/reject', [App\Http\Controllers\HppController::class, 'reject'])->name('hpp.reject');

Route::view('support', 'support')->name('support');
