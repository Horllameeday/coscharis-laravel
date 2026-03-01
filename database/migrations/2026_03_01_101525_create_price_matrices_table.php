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
        Schema::create('price_matrices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_price_matrix_id')->constrained('client_price_matrices')->cascadeOnDelete();
            $table->foreignId('pickup_type_id')->constrained('pickup_types')->cascadeOnDelete();
            $table->enum('category', \App\Enums\PriceMatrixCategory::values());
            $table->enum('type', \App\Enums\PriceMatrixType::values());
            $table->decimal('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_matrices');
    }
};
