<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';

    protected $fillable = [
    	'size_name_ar',
    	'size_name_en',
    	'is_public',
    	'department_id',
    ];

    public function department_id()
    {
    	return $this->hasOne('App\Model\Department','id','department_id');
    }
}
