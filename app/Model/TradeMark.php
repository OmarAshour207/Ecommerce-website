<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TradeMark extends Model
{
    protected $table = 'trade_marks';

    protected $fillable = [
        'trademark_name_ar',
        'trademark_name_en',
        'icon',
    ];

}
