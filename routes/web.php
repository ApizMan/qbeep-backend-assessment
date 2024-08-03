<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(CompanyController::class)->group(function () {
        Route::get('/add-company',  'create')->name('add_company');
        Route::post('/create-company', 'store')->name('create_company');
        Route::get('/edit-company/{id}', 'edit')->name('edit_company');
        Route::put('/update-company/{id}', 'update')->name('update_company');
        Route::delete('/delete-company/{id}', 'destroy')->name('destroy_company');
    });

    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/add-employee',  'create')->name('add_employee');
        Route::post('/create-employee', 'store')->name('create_employee');
        Route::get('/edit-employee/{id}', 'edit')->name('edit_employee');
        Route::put('/update-employee/{id}', 'update')->name('update_employee');
        Route::delete('/delete-employee/{id}', 'destroy')->name('destroy_employee');
    });
});
