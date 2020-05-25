<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    //
    protected $fillable = [
        'name',
        'user_id'
    ];
}
