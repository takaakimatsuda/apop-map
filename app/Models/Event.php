<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // マスアサインメントを許可しない属性
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // タグとのリレーションシップを定義
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'event_tags', 'event_id', 'tag_id');
    }
}
