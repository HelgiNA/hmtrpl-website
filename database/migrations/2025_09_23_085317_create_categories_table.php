<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     * Method ini dieksekusi ketika migrasi dijalankan (`php artisan migrate`).
     * Ini akan membuat tabel 'categories' untuk mengelompokkan postingan atau konten lainnya.
     */
    public function up(): void
    {
        // Membuat tabel 'categories'
        Schema::create('categories', function (Blueprint $table) {
            $table->id();                            // ID unik untuk setiap kategori (Primary Key, auto-increment).
            $table->string('name');                  // Nama kategori.
            $table->string('slug')->unique();        // Versi URL-friendly dari nama kategori, harus unik.
            $table->text('description')->nullable(); // Deskripsi atau penjelasan singkat tentang kategori, boleh kosong.
            $table->timestamps();                    // Membuat kolom `created_at` dan `updated_at` secara otomatis
                                                     // untuk melacak kapan kategori dibuat dan terakhir diperbarui.
        });
    }

    /**
     * Balikkan migrasi.
     * Method ini dieksekusi ketika migrasi di-rollback (`php artisan migrate:rollback`).
     * Ini akan menghapus tabel 'categories' jika ada.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
