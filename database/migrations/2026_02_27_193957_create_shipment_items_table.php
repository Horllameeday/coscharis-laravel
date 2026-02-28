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
        Schema::create('shipment_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('note')->nullable();
            $table->json('images')->nullable();
            $table->decimal('item_value', 10, 2);
            $table->integer('quantity');
            $table->decimal('weight', 8, 2);
            $table->foreignId('category_id')->constrained('product_categories')->cascadeOnDelete();
            $table->foreignUuid('shipment_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipment_items');
    }
};
