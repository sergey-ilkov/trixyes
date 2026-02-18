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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->json('title');
            $table->json('slug');
            $table->json('description');
            $table->integer('views');
            $table->string('image');
            $table->string('image_min');
            $table->string('alt_image');
            $table->json('body');
            $table->boolean('published')->default(false);
            $table->boolean('slider')->default(false);

            $table->timestamps();
        });
    }

    /**php
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};