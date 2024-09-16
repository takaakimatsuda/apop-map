<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * マイグレーションの実行
     */
    public function up(): void
    {
        // categories テーブルを作成
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id'); // id カラム（自動増分の主キー）
            $table->string('name'); // name カラム（カテゴリー名を保存する文字列）
            $table->timestamps(); // created_at, updated_at タイムスタンプ
        });
    }

    /**
     * マイグレーションのロールバック
     */
    public function down(): void
    {
        // event_categories テーブルを先に削除
        Schema::dropIfExists('event_categories');
        // categories テーブルをその後に削除
        Schema::dropIfExists('categories');
    }
};
