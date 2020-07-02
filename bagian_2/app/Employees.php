<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    //
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $fillable = ['nama','email','companies_id'];

    public function companies()
    {
        return $this->belongsTo('App\Companies');
    }

}
