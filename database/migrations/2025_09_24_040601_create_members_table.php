<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Method ini dieksekusi ketika migrasi dijalankan.
     * Ini akan membuat tabel 'members' yang menyimpan data keanggotaan organisasi.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
                                                                                         // Kolom-kolom utama
            $table->id();                                                                // ID unik untuk setiap anggota (Primary Key)
            $table->string('student_number')->unique();                                  // Nomor Induk Mahasiswa (NIM), harus unik
            $table->string('full_name');                                                 // Nama lengkap anggota
            $table->year('enrollment_year');                                             // Tahun angkatan atau tahun masuk
            $table->string('email')->unique();                                           // Alamat email anggota, harus unik
            $table->string('phone_number')->nullable();                                  // Nomor telepon, boleh kosong
            $table->enum('status', ['active', 'inactive', 'alumni'])->default('active'); // Status keanggotaan
            $table->date('join_date')->nullable();                                       // Tanggal bergabung dengan organisasi
            $table->string('profile_photo_path')->nullable();                            // Path ke file foto profil, boleh kosong

            // Foreign Keys (Relasi)
            $table->foreignId('division_id')
                ->constrained('divisions')
                ->onUpdate('cascade')
                ->onDelete('cascade'); // Relasi ke tabel 'divisions'

            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade'); // Relasi ke tabel 'users' untuk otentikasi

            $table->timestamps(); // Membuat kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     * Method ini dieksekusi ketika migrasi di-rollback. Ini akan menghapus tabel 'members'.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
