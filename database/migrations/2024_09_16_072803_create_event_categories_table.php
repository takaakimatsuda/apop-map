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
        Schema::create('event_categories', function (Blueprint $table) {
            $table->foreignId('event_id')->constrained('events', 'event_id')->onDelete('cascade'); // events テーブルの event_id に関連付け
            $table->foreignId('category_id')->constrained('categories', 'category_id')->onDelete('cascade'); // categories テーブルの category_id に関連付け
            $table->primary(['event_id', 'category_id']); // 複合主キー
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // categoriesで削除される
    }
};
