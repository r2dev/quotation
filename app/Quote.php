<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $touches = ['products'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }


    public function products()
    {
//        return $this->belongsToMany('App\Product')->using('App\QuoteProduct')->withPivot('')
        return $this
            ->belongsToMany('App\Product', 'quote_product')
            ->withTimestamps()
            ->withPivot('quantity', 'width', 'height', 'lite', 'style', 'price', 'id', 'style_id', 'adjustment', 'adjustment_lr')
            ->using('App\QuoteProduct');
    }
}
