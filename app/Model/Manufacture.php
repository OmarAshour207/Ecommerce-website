<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    protected $table = 'manufactures';

    protected $fillable = [
    	'manufacture_name_ar',
    	'manufacture_name_en',
    	'facebook',
    	'twitter',
    	'website',
    	'contact_name',
        'mobile',
        'email',
        'address',
    	'lat',
    	'lng',
    	'icon',
    ];
}
