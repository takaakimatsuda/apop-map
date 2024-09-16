<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // プライマリキーを設定
    protected $primaryKey = 'event_id';

    // マスアサインメントを許可しない属性
    protected $guarded = ['event_id', 'created_at', 'updated_at'];

    // タグとのリレーションシップを定義
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'event_tags', 'event_id', 'tag_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'event_categories', 'event_id', 'category_id');
    }
}
