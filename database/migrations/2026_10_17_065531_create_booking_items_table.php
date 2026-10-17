<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                ->constrained('bookings')
                ->cascadeOnDelete();

            $table->foreignId('room_type_id')
                ->constrained('room_types')
                ->restrictOnDelete();

            $table->foreignId('rate_plan_id')
                ->constrained('rate_plans')
                ->restrictOnDelete();

            $table->unsignedSmallInteger('quantity')->default(1);
            $table->unsignedSmallInteger('guests_per_room')->default(1);

            // Price snapshot at booking time
            $table->decimal('price_per_night', 12, 2);
            $table->unsignedSmallInteger('nights');
            $table->decimal('subtotal', 12, 2);

            $table->timestamps();

            $table->index(['booking_id', 'room_type_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_items');
    }
};
