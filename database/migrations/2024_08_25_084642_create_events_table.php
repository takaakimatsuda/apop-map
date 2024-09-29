<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');  // 'event_id' カラムを主キーとして設定
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('image_url')->nullable();
            $table->string('venue_name')->nullable();
            $table->string('venue_address')->nullable();
            $table->text('description')->nullable();
            $table->string('reference_url')->nullable();
            $table->date('date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->tinyInteger('visibility')->default(0);  // 公開状態 (0: 下書き, 1: 登録ユーザーのみ, 2: 全公開)
            $table->timestamps();  // 'created_at' と 'updated_at' カラムを自動的に生成
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
