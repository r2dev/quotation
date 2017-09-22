<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
//        return $this->belongsToMany('App\Product')->using('App\QuoteProduct')->withPivot('')
        return $this->belongsToMany('App\Product', 'quote_product')->withTimestamps()->withPivot('quantity');
    }
}
