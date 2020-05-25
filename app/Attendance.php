<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'clock_in_time',
        'clock_out_time',
        'late',
        'working_from',
        'half_day',
        'employee_id',
    ];

    public function employee()
    {
        return $this->belongsToMany(Employee::class);
    }

    public static function getTotalUserClockIn($date, $userId){
        return Attendance::where(DB::raw('DATE(attendances.clock_in_time)'), '>=', $date)
            ->where(DB::raw('DATE(attendances.clock_in_time)'), '<=', $date)
            ->where('employee_id', $userId)
            ->count();
    }
    public static function userAttendanceByDate($startDate, $endDate, $userId) {
        return Attendance::join('users', 'users.id', '=', 'attendances.employee_id')
            ->where(DB::raw('DATE(attendances.clock_in_time)'), '>=', $startDate)
            ->where(DB::raw('DATE(attendances.clock_in_time)'), '<=', $endDate)
            ->where('attendances.employee_id', '=', $userId)
            ->orderBy('attendances.id', 'desc')
            ->select('attendances.*', 'users.*', 'attendances.id as aId')
            ->get();
    }
}
