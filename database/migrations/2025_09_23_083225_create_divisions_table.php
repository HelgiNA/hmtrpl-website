<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     * Method ini dieksekusi ketika migrasi dijalankan (`php artisan migrate`).
     * Ini akan membuat tabel 'divisions' untuk menyimpan data divisi atau departemen dalam organisasi.
     */
    public function up(): void
    {
        // Membuat tabel 'divisions'
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();                     // ID unik untuk setiap divisi (Primary Key, auto-increment).
            $table->string('name')->unique(); // Nama divisi, harus unik.
            $table->text('description');      // Deskripsi atau penjelasan tentang divisi.
            $table->timestamps();             // Membuat kolom `created_at` dan `updated_at` secara otomatis
                                              // untuk melacak kapan divisi dibuat dan terakhir diperbarui.
        });
    }

    /**
     * Balikkan migrasi.
     * Method ini dieksekusi ketika migrasi di-rollback (`php artisan migrate:rollback`).
     * Ini akan menghapus tabel 'divisions' jika ada.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisions');
    }
};
