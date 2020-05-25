<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $fillable = [
        'emp_id',
        'address',
        'joining_date',
        'gender',
        'user_id'
    ];

    // protected $dateFormat = 'Y-m-d';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->hasMany(Department::class,'employee_departments');
    }
    public function setJoiningDateAttribute( $value ) {
        $this->attributes['joining_date'] = (new \Carbon($value))->format('Y-m-d');
    }

    public static function allemployees()
    {
        $employees = Employee::with(['user'=>function($q){
            $q->select('id','name','email');
        }])->get()->toArray();
        return $employees;

    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
    
    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function getJoiningDateAttribute( $value ) {
        return (new \Carbon($value))->format('d-M-Y');
    }

    public function getDeparmentName()
    {
        return $this->department->name;
    }
}
