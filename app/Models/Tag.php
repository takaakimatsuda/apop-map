<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string $name タグ名
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    use HasFactory;
    // プライマリキーを設定
    protected $primaryKey = 'tag_id';

    // マスアサインメントを許可しない属性
    protected $guarded = ['tag_id', 'created_at', 'updated_at'];

    // イベントとの多対多の関係を定義
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_tags', 'tag_id', 'event_id')->withTimestamps();
    }

    // タグが削除されたとき、中間テーブルの関連レコードも削除
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($tag) {
            $tag->events()->detach(); // 関連するイベントとの紐付けを解除
        });
    }
}
