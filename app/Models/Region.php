<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $primaryKey = 'region_id';

    protected $table = 'regions'; // テーブル名を指定
    protected $fillable = ['name']; // 代入可能な属性
}
