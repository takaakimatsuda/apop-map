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
        Schema::create('event_tags', function (Blueprint $table) {
            $table->id('event_tag_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            // 外部キー制約を設定
            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');
            $table->foreign('tag_id')->references('tag_id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_tags');
    }
};
