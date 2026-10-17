<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();

            $table->foreignId('hotel_id')
                ->constrained('hotels')
                ->restrictOnDelete();

            $table->string('name', 120);
            $table->text('description')->nullable();

            $table->unsignedSmallInteger('max_guests')->default(2);
            $table->unsignedSmallInteger('bed_count')->default(1);

            $table->string('bed_type', 50)->nullable();

            $table->timestamps();

            $table->unique(['hotel_id', 'name']);
            $table->index('hotel_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};
