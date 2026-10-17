<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Booking reference
            $table->string('booking_code', 30)->unique();

            // Customer and hotel
            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignId('hotel_id')
                ->constrained('hotels')
                ->restrictOnDelete();

            // Stay dates
            $table->date('check_in_date');
            $table->date('check_out_date');

            $table->unsignedSmallInteger('total_guests')->default(1);

            // Price snapshot
            $table->decimal('subtotal', 12, 2);
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2);
            $table->char('currency', 3)->default('USD');

            // Booking lifecycle
            $table->string('status', 30)->default('PENDING_PAYMENT');

            // Check-in and check-out audit
            $table->timestamp('checked_in_at')->nullable();
            $table->foreignId('checked_in_by')
                ->nullable()
                ->constrained('users')
                ->restrictOnDelete();

            $table->timestamp('checked_out_at')->nullable();
            $table->foreignId('checked_out_by')
                ->nullable()
                ->constrained('users')
                ->restrictOnDelete();

            // Cancellation
            $table->timestamp('cancelled_at')->nullable();
            $table->text('cancellation_reason')->nullable();

            // Customer requests
            $table->text('special_requests')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['hotel_id', 'status']);
            $table->index(['check_in_date', 'check_out_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
