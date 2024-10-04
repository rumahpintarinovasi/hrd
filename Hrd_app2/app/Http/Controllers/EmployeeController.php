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

        
        $startDate = Carbon::now()->startOfWeek();  
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

    public function edit(Employee $employee){
        return view('employee.edit', ['employee' => $employee]);
    }

    public function update(Employee $employee, Request $request){
        $data = $request->validate([
            'name' => 'required',
            'position' => 'required',
            'age' => 'required|numeric',
            'salary' => 'required|numeric',
            'password' => 'required'
        ]);

        $employee->update($data);

        return redirect(route('employee.view'))->with('success', 'Employee Data Updated !');
    }

    public function create() {
        return view('employee.create');
    }


    public function salary(Request $request) {
        $employees = Employee::all(); 
        
        $filter = $request->input ('filter', 'week');
        
        if ($filter == 'month'){
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        }elseif ($filter =='week'){
            $startDate = carbon::now()->startOfWeek();
            $endDate = Carbon::now()->endOfWeek();
        } 
         
    
        $data = [];
        foreach ($employees as $employee) {
            $attendances = Attendance::where('employee_id', $employee->id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get();
    
            $totalTimeLateness = 0; 
            $totalTimeShortage = 0; 
    
            foreach ($attendances as $attendance) {
                $totalTimeLateness += $attendance->time_lateness ?? 0; 
                $totalTimeShortage += $attendance->time_shortage ?? 0; 
            }
    
            $data[] = [
                'employee' => $employee,
                'total_time_lateness' => $totalTimeLateness,
                'total_time_shortage' => $totalTimeShortage,
            ];
        }

        $daterange = $startDate->format('d/m/y'). ' - ' . $endDate->format('d/m/y');
    
        return view('employee.salary', ['data' => $data, 'filter' => $filter, 'daterange' => $daterange]);
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
