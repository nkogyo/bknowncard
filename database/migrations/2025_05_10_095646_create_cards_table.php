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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('title');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->uuid('unique_id')->unique();
            $table->string('share_url')->nullable();
            $table->string('background_color')->default('000000'); // Background Color
            $table->string('background_image')->nullable();
            $table->integer('background_opacity')->default(100);
            $table->integer('background_zoom')->default(100);
            $table->string('text_color')->default('ffffff');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};