<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'shippings';

    protected $fillable = [
    	'shipping_name_ar',
    	'shipping_name_en',
    	'user_id',
        'address',
    	'lat',
    	'lng',
    	'icon',
    ];

    public function user_id()
    {
    	return $this->hasOne('App\User','id','user_id');
    }
}