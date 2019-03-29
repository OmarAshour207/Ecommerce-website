<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    protected $table = 'malls';

    protected $fillable = [
    	'mall_name_ar',
    	'mall_name_en',
    	'contact_name',
        'email',
        'mobile',
        'address',
        'country_id',
        'facebook',
        'twitter',
        'website',
        'lat',
        'lng',
        'icon',
    ];

    public function country_id()
    {
        return $this->hasOne('App\Model\Country', 'id', 'country_id');
    }
}
