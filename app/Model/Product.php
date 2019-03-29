<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
    	'title',
    	'content',
    	'photo',
    	'department_id',
    	'trade_id',
    	'manu_id',
    	'color_id',
        'size',
    	'size_id',
    	'currency_id',
    	'price',
    	'stock',
    	'start_at',
    	'end_at',
    	'price_offer',
    	'start_offer_at',
    	'end_offer_at',
    	'weight',
    	'weight_id',
    	'status',
    	'reason',
    	'other_data',
    ];

    public function other_data()
    {
        return $this->hasMany('App\Model\OtherData', 'product_id', 'id');
    }
    public function malls()
    {
        return $this->hasMany(\App\Model\MallProduct::class, 'product_id', 'id');
    }
    public function files() 
    {
        return $this->hasMany('App\File', 'relation_id','id')->where('file_type','product');
    }
}
