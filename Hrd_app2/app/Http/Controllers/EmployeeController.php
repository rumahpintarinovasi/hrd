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


    public function salary() {
        $employees = Employee::all();  
    
        $startDate = Carbon::now()->subDays(6); // Mulai dari 7 hari yang lalu
        $endDate = Carbon::now(); // Sampai hari ini
    
        $data = [];
        foreach ($employees as $employee) {
            $attendances = Attendance::where('employee_id', $employee->id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get();
    
            $totalTimeLateness = 0; // Total keterlambatan
            $totalTimeShortage = 0; // Total kekurangan waktu
    
            foreach ($attendances as $attendance) {
                $totalTimeLateness += $attendance->time_lateness ?? 0; // Menjumlahkan keterlambatan
                $totalTimeShortage += $attendance->time_shortage ?? 0; // Menjumlahkan kekurangan waktu
            }
    
            $data[] = [
                'employee' => $employee,
                'total_time_lateness' => $totalTimeLateness,
                'total_time_shortage' => $totalTimeShortage,
            ];
        }
    
        return view('employee.salary', ['data' => $data]);
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
