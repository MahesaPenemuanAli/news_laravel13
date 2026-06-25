<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('article_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')
                  ->constrained('articles')
                  ->cascadeOnDelete();
            $table->text('update_content');
            $table->timestamps();

            $table->index('article_id');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_updates');
    }
};
