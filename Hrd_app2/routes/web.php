<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function(){
    return view('auth/login', ['title'=>'login page']);
});
// Routes protected by session check
Route::middleware(['web'])->group(function () {
    Route::get('/employee', function () {
        if (!Session::has('employee_id') && !Session::has('admin')) {
            return redirect()->route('login')->withErrors('You must log in first.');
        }
        return app(EmployeeController::class)->index();
    })->name('employee.index');

    Route::get('/employee/create', function () {
        if (!Session::has('employee_id') && !Session::has('admin')) {
            return redirect()->route('login')->withErrors('You must log in first.');
        }
        return app(EmployeeController::class)->create();
    })->name('employee.create');

    Route::post('/employee', function () {
        if (!Session::has('employee_id') && !Session::has('admin')) {
            return redirect()->route('login')->withErrors('You must log in first.');
        }
        return app(EmployeeController::class)->store(request());
    })->name('employee.store');

    // Attendance routes
    Route::get('/attendance/create', function () {
        if (!Session::has('employee_id')) {
            return redirect()->route('login')->withErrors('You must log in first.');
        }
        return app(AttendanceController::class)->create();
    })->name('attendance.create');

    Route::post('/attendance', function () {
        if (!Session::has('employee_id')) {
            return redirect()->route('login')->withErrors('You must log in first.');
        }
        return app(AttendanceController::class)->store(request());
    })->name('attendance.store');
});
