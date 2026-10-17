<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rate_plans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('room_type_id')
                ->constrained('room_types')
                ->restrictOnDelete();

            $table->string('name', 120);
            $table->text('description')->nullable();

            $table->decimal('base_price', 12, 2);
            $table->char('currency', 3)->default('USD');

            $table->boolean('is_refundable')->default(true);
            $table->unsignedSmallInteger('max_guests')->default(2);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->unique(['room_type_id', 'name']);
            $table->index(['room_type_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rate_plans');
    }
};
