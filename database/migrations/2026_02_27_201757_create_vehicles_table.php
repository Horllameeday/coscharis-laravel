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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            // $table->string('pickup_type_id')->foreign()->references('pickup_types')->on('id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('pickup_type_id')->constrained('pickup_types')->cascadeOnDelete();
            $table->string('make');
            $table->string('model');
            $table->string('plate_number');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
