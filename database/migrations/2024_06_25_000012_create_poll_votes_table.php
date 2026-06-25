<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('poll_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poll_option_id')
                  ->constrained('poll_options')
                  ->cascadeOnDelete();
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            $table->string('ip_address', 45);
            $table->timestamps();

            $table->index('poll_option_id');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('poll_votes');
    }
};
