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
        Schema::create('log_postingan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->text('konten');
            $table->text('des');
            $table->string('gambar')->nullable(); 
            $table->timestamps();
        });

        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_post')->constrained('log_postingan')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('commatar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_post')->constrained('log_postingan')->onDelete('cascade')->onUpdate('cascade');
            $table->text('commad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_postingan');
        Schema::dropIfExists('likes');
        Schema::dropIfExists('commatar');
    }
};
