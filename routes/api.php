<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ControllerApi\CompanyController as CompanyApiController;
use App\Http\Controllers\ControllerApi\EmployeeController as EmployeeApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [AuthController::class, 'login']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/company/{id}/employee-list', [CompanyController::class, 'index']);

    Route::controller(CompanyApiController::class)->group(function () {
        Route::get('/list-company',  'index');
        Route::post('/create-company', 'store');
        Route::put('/update-company/{id}', 'update');
        Route::delete('/delete-company/{id}', 'destroy')->name('destroy_company');
    });

    Route::controller(EmployeeApiController::class)->group(function () {
        Route::get('/list-employee',  'index');
        Route::post('/create-employee', 'store');
        Route::put('/update-employee/{id}', 'update')->name('update_employee');
        Route::delete('/delete-employee/{id}', 'destroy')->name('destroy_employee');
    });
});
