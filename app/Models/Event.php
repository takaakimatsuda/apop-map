<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // プライマリキーを設定
    protected $primaryKey = 'event_id';
    protected $casts = [
        'date' => 'date',  // 'date' フィールドを自動的に Carbon インスタンスにキャスト
    ];

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

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function scopeVisible($query, $visibilityLevel = 2)
    {
        return $query->where('visibility', '>=', $visibilityLevel);
    }
}
