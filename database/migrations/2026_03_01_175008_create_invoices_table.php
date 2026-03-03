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
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('shipment_id')->constrained('shipments')->cascadeOnDelete();
            $table->foreignUuid('initiator_id')->constrained('users')->cascadeOnDelete();
            $table->string('reference');
            $table->json('data');
            $table->enum('status', \App\Enums\InvoicePaymentStatus::values())->default(\App\Enums\InvoicePaymentStatus::PENDING);
            $table->string('payment_reference')->nullable();
            $table->timestamp('expires_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
