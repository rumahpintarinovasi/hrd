<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function create(){
        return view('attendance.create');
    }

    public function store(Request $request){
        $request->validate([                                                 
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:check_in,check_out',
        ]);

        $employeeId = Session::get('employee_id');                          

        $path = $request->file('photo')->store('photos', 'public');         

        $today = Carbon::today();                                           

        $attendance = Attendance::where('employee_id', $employeeId)         
            ->whereDate('created_at', $today)
            ->first();

        $startTime = Carbon::createFromTimeString('09:00:00');  // Acuan waktu masuk
        $endTime = Carbon::createFromTimeString('16:00:00');    // Acuan waktu keluar

        if ($request->status == 'check_in') {                               
            if ($attendance && $attendance->check_in) {
                return redirect()->back()->withErrors(['error' => 'You have already checked in today.']);   
            }

            if (!$attendance) {
                // Hitung keterlambatan jika check-in lebih dari jam 09:00
                $checkInTime = Carbon::now();
                $timeLateness = 0; // Default: tidak terlambat
                if ($checkInTime->gt($startTime)) {
                    $timeLateness = $checkInTime->diffInMinutes($startTime);
                }

                // Simpan data check-in dengan keterlambatan
                Attendance::create([
                    'employee_id' => $employeeId,
                    'photo_path' => $path,
                    'status' => 'check_in',
                    'check_in' => $checkInTime,
                    'time_lateness' => $timeLateness, // Simpan keterlambatan
                ]);
            } 
        } elseif ($request->status == 'check_out') {                        
            if (!$attendance || !$attendance->check_in) {                   
                return redirect()->back()->withErrors(['error' => 'You must check in before checking out.']);   
            }

            if ($attendance->check_out) {
                return redirect()->back()->withErrors(['error' => 'You have already checked out today.']);     
            }

            // Hitung kekurangan waktu jika check-out sebelum jam 16:00
            $checkOutTime = Carbon::now();
            $timeShortage = 0; // Default: tidak ada kekurangan waktu
            if ($checkOutTime->lt($endTime)) {
                $timeShortage = $endTime->diffInMinutes($checkOutTime);
            }

            // Update data check-out dengan kekurangan waktu
            $attendance->update([                                           
                'photo_path' => $path,
                'status' => 'check_out',
                'check_out' => $checkOutTime,
                'time_shortage' => $timeShortage, // Simpan kekurangan waktu
            ]);
        } else {
            return redirect()->back()->withErrors(['error' => 'No check-in record found for today.']);
        }

        return redirect()->back()->with('success', 'Attendance recorded successfully.');
    }
}
