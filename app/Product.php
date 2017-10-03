<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    //

//    public function quotes()
//    {
//        return $this->belongsToMany('App\Quote', 'quote_product')->withTimestamps();
//    }
    public function styles()
    {
        return $this->belongsToMany('App\Style', 'product_style')->withTimestamps()->withPivot('quantity', 'id');
    }
    protected $dates = ['deleted_at'];
}
