<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceEmployee extends Model
{
    protected $table = 'attendanceemployee';

    protected $fillable = [
        'employee_id', 'date', 'clock_in', 'clock_out'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function isClockedIn()
    {
        return $this->clockIns()->whereNull('clock_out')->exists();
    }
}
