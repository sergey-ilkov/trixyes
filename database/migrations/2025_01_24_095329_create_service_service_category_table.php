<?php

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_service_category', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(ServiceCategory::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Service::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->double('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_service_category');
    }
};