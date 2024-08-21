<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\LanguageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::post('/employees', [EmployeeController::class, 'create_employee'])->name('employees.create');
Route::get('/employees/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::put('/employees', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
Route::get('/employees/{id}', [EmployeeController::class, 'viewProfile'])->name('employees.viewProfile');

Route::get('/companies', [CompaniesController::class, 'index'])->name('companies.index');
Route::post('/companies', [CompaniesController::class, 'create'])->name('companies.create');
Route::get('/companies/{id}', [CompaniesController::class, 'edit'])->name('companies.edit');
Route::put('/companies', [CompaniesController::class, 'update'])->name('companies.update');
Route::delete('/companies/{id}', [CompaniesController::class, 'destroy']);

// routes/web.php
Route::post('/adminlte/language', [App\Http\Controllers\LanguageController::class, 'setLanguage'])->name('adminlte.language');

