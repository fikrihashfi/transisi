<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    //

    public function company()
    {
        return $this->belongsTo('App\Companies');
    }

}
