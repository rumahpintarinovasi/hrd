<?php

// AuthController.php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        if ($request->name === 'admin' && $request->password === 'admin123') {
            Session::put('admin', true);
            return redirect()->route('employee.index');
        }
        
        $employee = Employee::where('name', $request->name)->first();

        if ($employee && $employee->password === $request->password) {

            Session::put('employee_id', $employee->id);
            Session::put('employee_name', $employee->name);

            return redirect()->route('attendance.create');
        }

        return back()->withErrors(['login_error' => 'Invalid name or password.']);
    }

    public function logout(){
    Session::forget('employee_id');
    Session::forget('employee_name');
    Session::forget('admin');
    return redirect()->route('login');
    }

}

