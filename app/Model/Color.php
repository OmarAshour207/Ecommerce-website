<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';

    protected $fillable = [
    	'color_name_ar',
    	'color_name_en',
    	'color',
    ];
}
