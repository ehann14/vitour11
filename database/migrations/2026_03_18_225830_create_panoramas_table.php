<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('panoramas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('scene_id')->unique(); // gerbang, lapangan, kantin, dll
            $table->string('image_path');
            $table->enum('type', ['360', 'normal'])->default('360');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->json('hotspots')->nullable();
            $table->string('icon')->default('fa-image');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('panoramas');
    }
};