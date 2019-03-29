<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $table = 'weights';

    protected $fillable = [
    	'weight_name_ar',
    	'weight_name_en',
    	
    ];
}
