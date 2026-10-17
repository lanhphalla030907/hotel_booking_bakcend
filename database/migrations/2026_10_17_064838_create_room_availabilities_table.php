<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_availabilities', function (Blueprint $table) {
            $table->id();

            $table->foreignId('room_type_id')
                ->constrained('room_types')
                ->restrictOnDelete();

            $table->date('availability_date');

            $table->unsignedInteger('total_rooms');
            $table->unsignedInteger('available_rooms');

            $table->decimal('price_per_night', 12, 2)->nullable();

            $table->boolean('is_available')->default(true);

            $table->timestamps();

            $table->unique(['room_type_id', 'availability_date']);
            $table->index(['availability_date', 'is_available']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_availabilities');
    }
};
