<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{

    use SoftDeletes;
    //
    public function users()
    {
        return $this->hasMany('App\User');
    }

    protected $dates = ['deleted_at'];
}
