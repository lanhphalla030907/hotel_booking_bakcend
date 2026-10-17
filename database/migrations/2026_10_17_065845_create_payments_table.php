<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                ->constrained('bookings')
                ->restrictOnDelete();

            $table->string('payment_code', 50)->unique();

            $table->string('provider', 50);
            $table->string('provider_transaction_id', 150)->nullable();

            $table->decimal('amount', 12, 2);
            $table->char('currency', 3)->default('USD');

            $table->string('status', 30)->default('PENDING');

            $table->timestamp('paid_at')->nullable();
            $table->text('failure_reason')->nullable();

            $table->timestamps();

            $table->index(['booking_id', 'status']);
            $table->index(['provider', 'provider_transaction_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
