<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     * Method ini dieksekusi ketika migrasi dijalankan (`php artisan migrate`).
     */
    public function up(): void
    {
        // Membuat tabel 'users' untuk menyimpan data pengguna aplikasi.
        Schema::create('users', function (Blueprint $table) {
            $table->id();                                       // ID unik untuk setiap pengguna (Primary Key, auto-increment).
            $table->string('name');                             // Nama lengkap pengguna.
            $table->string('email')->unique();                  // Alamat email pengguna, harus unik.
            $table->timestamp('email_verified_at')->nullable(); // Waktu verifikasi email, boleh kosong.
            $table->string('password');                         // Kata sandi pengguna (akan di-hash).
            $table->rememberToken();                            // Token untuk fitur "ingat saya".
            $table->timestamps();                               // Membuat kolom `created_at` dan `updated_at` secara otomatis.
        });

        // Membuat tabel 'password_reset_tokens' untuk menyimpan token saat pengguna meminta reset kata sandi.
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();          // Email pengguna, sebagai primary key.
            $table->string('token');                     // Token reset kata sandi yang unik.
            $table->timestamp('created_at')->nullable(); // Waktu pembuatan token.
        });

        // Membuat tabel 'sessions' untuk menyimpan data sesi pengguna yang sedang login.
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();                   // ID sesi yang unik.
            $table->foreignId('user_id')->nullable()->index(); // Relasi ke tabel 'users', bisa null jika sesi tamu.
            $table->string('ip_address', 45)->nullable();      // Alamat IP pengguna.
            $table->text('user_agent')->nullable();            // Informasi browser/perangkat pengguna.
            $table->longText('payload');                       // Data sesi yang di-encode.
            $table->integer('last_activity')->index();         // Timestamp aktivitas terakhir pengguna.
        });
    }

    /**
     * Balikkan migrasi.
     * Method ini dieksekusi ketika migrasi di-rollback (`php artisan migrate:rollback`).
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
