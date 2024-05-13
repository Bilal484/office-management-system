<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Attendance;
use App\AttendanceEmployee;
use Illuminate\Http\Request;


class AttendanceemployeeController extends Controller
{


    public function attendance()
    {
        return view('admin.employees.attendance');
    }




    public function clockIn(Request $request)
    {
        $employee = Employee::find($request->employee_id);
        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        // Check if the employee is already clocked in
        if ($employee->isClockedIn()) {
            return response()->json(['error' => 'Employee is already clocked in'], 400);
        }

        // Clock in the employee
        $attendance = new AttendanceEmployee();
        $attendance->employee_id = $employee->id;
        $attendance->clock_in = now();
        $attendance->save();

        return response()->json(['message' => 'Employee clocked in successfully'], 200);
    }




    public function clockOut(Request $request)
    {
        $employee = Employee::find($request->employee_id);
        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        // Check if the employee is already clocked out
        if (!$employee->isClockedIn()) {
            return response()->json(['error' => 'Employee is already clocked out'], 400);
        }

        // Clock out the employee
        $attendance = AttendanceEmployee::where('employee_id', $employee->id)
            ->whereNull('clock_out')
            ->first();

        $attendance->clock_out = now();
        $attendance->save();

        return response()->json(['message' => 'Employee clocked out successfully'], 200);
    }





    public function markAttendance(Request $request)
    {
        $employee = Employee::find($request->employee_id);
        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        // Mark attendance for the employee
        $attendance = new AttendanceEmployee();
        $attendance->employee_id = $employee->id;
        $attendance->clock_in = now();
        $attendance->clock_out = now();
        $attendance->save();

        return response()->json(['message' => 'Attendance marked successfully'], 200);
    }



    // Show the daily base  attendance 
    public function myAttendance(Request $request)
    {
        $employeeId = $request->employee_id;

        // Retrieve the employee with the specified UUID
        $employee = Employee::where('id', $employeeId)->firstOrFail();

        // Retrieve attendance records for the specified employee ID
        $attendanceRecords = Attendanceemployee::where('employee_id', $employeeId)
            ->whereNotNull('clock_in')
            ->whereNotNull('clock_out')
            ->get();

        return view('admin.employees.index', ['attendanceRecords' => $attendanceRecords, 'employee' => $employee]);
    }
}
