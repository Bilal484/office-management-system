<?php

namespace App;

use App\AttendanceEmployee;
use App\Http\Traits\UseUuid;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use UseUuid;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'f_name',
        'l_name',
        'dob',
        'marital_status',
        'country',
        'blood_group',
        'id_number',
        'religious',
        'gender',
        'photo',
        'terminate_status',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function hasRole()
    {
        return $this->role;
    }


    public function clockIns()
    {
        return $this->hasMany(AttendanceEmployee::class, 'employee_id')->whereNotNull('clock_out');
    }


    public function isClockedIn()
    {
        return AttendanceEmployee::where('employee_id', $this->id)
            ->whereNull('clock_out')
            ->exists();
    }
}
