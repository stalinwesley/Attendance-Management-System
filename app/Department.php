<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $fillable = [
        'name','user_id','notes'
    ];

    public function employees()
    {
        return $this->hasmany(Employee::class);
    }
}
