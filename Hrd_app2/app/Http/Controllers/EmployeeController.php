<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee; 
use App\Models\Attendance;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function index() {
        $employees = Employee::all();  

        
        $startDate = Carbon::now()->subDays(6);  
        $endDate = Carbon::now();

        
        $data = [];
        foreach ($employees as $employee) {
            $attendances = Attendance::where('employee_id', $employee->id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get()
                ->groupBy(function($attendance) {
                    return $attendance->created_at->format('Y-m-d'); 
                });

            $data[] = [
                'employee' => $employee,
                'attendances' => $attendances
            ];
        }

        
        $dateRange = [];
        for ($date = $startDate; $date <= $endDate; $date->addDay()) {
            $dateRange[] = $date->format('Y-m-d');
        }

        return view('employee.index', ['data' => $data, 'dateRange' => $dateRange]);
    }

    public function view(){
        $employees = Employee::all();
        return view('employee.view', ['employees' => $employees ]);
    }

    public function create() {
        return view('employee.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'position' => 'required',
            'age' => 'required|numeric',
            'salary' => 'required|numeric',
            'password' => 'required'
        ]);

        $newEmployee = Employee::create($data); 
        return redirect(route('employee.index'));
    }
}
