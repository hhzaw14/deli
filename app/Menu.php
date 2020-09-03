<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    protected $fillable	= [
    	'codeno', 'name', 'photo', 'price', 'description', 'category_id', 'restaurant_id'
    ];

    public function category(){
    	return $this->belongsTo('App\Category');
    }

        public function restaurant(){
    	return $this->belongsTo('App\Restaurant');
    }

     public function orders(){
        return $this->belongsToMany('App\Order','orderdetails',
        'order_id','menu_id')
                    ->withPivot('qty')
                    ->withPivot('price')
                    ->withPivot('subtotal')
                    ->withTimestamps();;
    }
}
