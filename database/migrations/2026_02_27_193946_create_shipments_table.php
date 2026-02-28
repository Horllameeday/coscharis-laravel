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
        Schema::create('shipments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('pickup_type_id')->constrained()->cascadeOnDelete();
            $table->string('sender_person');
            $table->string('sender_number');
            $table->string('pickup_place_id');
            $table->string('pickup_place_name');
            $table->string('pickup_place_longitude');
            $table->string('pickup_place_latitude');
            $table->string('receiver_person');
            $table->string('receiver_number');
            $table->string('destination_place_name');
            $table->string('destination_place_id');
            $table->string('destination_place_longitude');
            $table->string('destination_place_latitude');
            $table->date('preferred_pickup_date')->nullable();
            $table->date('preferred_delivery_date')->nullable();
            $table->float('distance');
            $table->string('duration');
            $table->enum('state', \App\Enums\ShipmentStateEnum::values())->default(\App\Enums\ShipmentStateEnum::NEW->value);
            $table->foreignUuid('driver_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
