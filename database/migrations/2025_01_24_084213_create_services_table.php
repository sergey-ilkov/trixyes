<?php

use App\Models\ServiceCategory;
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
        Schema::create('services', function (Blueprint $table) {
            $table->id();


            $table->json('name');
            $table->string('icon');
            $table->string('alt_image');
            $table->double('interset');
            $table->integer('term');
            $table->integer('amount');
            $table->string('promo_code')->nullable();
            $table->integer('promo_discount')->nullable();
            $table->integer('vote_rating');
            $table->integer('vote_count');

            $table->string('url');
            $table->json('license');
            $table->json('comp_name');
            $table->string('email');
            $table->json('address');
            $table->string('phone');
            $table->boolean('published')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};