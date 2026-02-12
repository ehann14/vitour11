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
        Schema::create('school_maps', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255); // Judul denah (misal: "Denah Lantai 1")
            $table->string('slug', 255)->unique(); // URL slug
            $table->text('description')->nullable(); // Deskripsi denah
            $table->string('image_path', 500); // Path gambar di storage
            $table->string('image_name', 255)->nullable(); // Nama file asli
            $table->string('file_size', 50)->nullable(); // Ukuran file
            $table->string('file_type', 50)->nullable(); // Tipe file (jpg, png, dll)
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status aktif/tidak
            $table->integer('order')->default(0); // Urutan tampilan
            $table->integer('view_count')->default(0); // Jumlah views
            $table->timestamps();
            $table->softDeletes(); // Soft delete untuk recovery
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_maps');
    }
};