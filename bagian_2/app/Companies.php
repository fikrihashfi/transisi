<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    //
    protected $table = 'companies';
    protected $primaryKey = 'id';
    protected $fillable = ['nama','email','logo','website'];


    public function company()
    {
        return $this->hasMany('App\Employees');
    }
}
