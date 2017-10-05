<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductStyle extends Pivot
{
    //
    public function style()
    {
        return $this->hasOne('App\Style');
    }
}