<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            // Relasi ke Penulis (User)
            $table->foreignId('author_id')
                  ->constrained('users')
                  ->restrictOnDelete(); // Tidak boleh hapus user jika masih punya artikel

            // Relasi ke Kategori
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->restrictOnDelete(); // Tidak boleh hapus kategori jika masih ada artikel

            // Konten Artikel
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('thumbnail')->nullable();

            // Status & Metadata
            $table->enum('status', ['draft', 'review', 'published', 'archived'])
                  ->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_breaking_news')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_premium')->default(false);

            // Analytics
            $table->unsignedBigInteger('views_count')->default(0);

            // SEO (Cadangan jika tidak pakai polymorphic SEO)
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->timestamps();
            $table->softDeletes(); // Fitur restore artikel yang tidak sengaja terhapus

            // Index untuk performa query (SANGAT PENTING untuk portal berita!)
            $table->index('slug');
            $table->index('status');
            $table->index('published_at');
            $table->index('views_count');
            $table->index('is_breaking_news');
            $table->index('is_featured');
            $table->index('author_id');
            $table->index('category_id');

            // Composite Index: Query artikel published terbaru di halaman depan
            $table->index(['status', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
