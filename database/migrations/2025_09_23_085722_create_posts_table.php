<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     * Method ini dieksekusi ketika migrasi dijalankan (`php artisan migrate`).
     * Ini akan membuat tabel 'posts' untuk menyimpan artikel, berita, atau konten lainnya.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
                                                                                          // Kolom-kolom utama
            $table->id();                                                                 // ID unik untuk setiap post (Primary Key).
            $table->string('title');                                                      // Judul post.
            $table->string('slug')->unique();                                             // Versi URL-friendly dari judul, harus unik.
            $table->longText('content');                                                  // Konten utama atau isi dari post.
            $table->text('excerpt')->nullable();                                          // Ringkasan atau kutipan singkat dari post, boleh kosong.
            $table->string('image')->nullable();                                          // Path ke file gambar utama (featured image), boleh kosong.
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft'); // Status publikasi post.
            $table->timestamp('published_at')->nullable();                                // Waktu kapan post dipublikasikan. Null jika masih draft.

            // Foreign Keys (Relasi)
            // Relasi ke tabel 'users'. Jika penulis (user) dihapus, semua post miliknya juga akan terhapus (cascade).
            $table->foreignId('author_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Relasi ke tabel 'categories'. Jika kategori dihapus, foreign key di post ini akan menjadi NULL.
            $table->foreignId('category_id')
                ->nullable() // Memungkinkan kolom ini menjadi null.
                ->constrained('categories')
                ->onUpdate('cascade')
                ->nullOnDelete();

            $table->timestamps(); // Membuat kolom `created_at` dan `updated_at` secara otomatis.
        });
    }

    /**
     * Balikkan migrasi.
     * Method ini dieksekusi ketika migrasi di-rollback (`php artisan migrate:rollback`).
     * Ini akan menghapus tabel 'posts'.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
