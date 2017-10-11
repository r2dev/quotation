<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class QuoteProduct extends Pivot
{
    //
    public function product()
    {
        return $this->hasOne('App\Product');
    }

}