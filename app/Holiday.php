<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable = [
        'date',
        'occassion',
    ];

    public function setDateAttribute( $value ) {
        $this->attributes['date'] = (new \Carbon($value))->format('Y-m-d');
    }
    public function getDateAttribute( $value ) {
        return (new \Carbon($value))->format('d-m-Y');
    }
}
