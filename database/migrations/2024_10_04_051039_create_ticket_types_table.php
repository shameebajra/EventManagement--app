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
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')
                ->constrained('events')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->index();
            $table->enum('ticket_type', [
                'general',
                'VIP',
                'early_bird',
                'student',
                'group',
                'family_pass',
                'sponsorship',
            ]);
            $table->integer('quantity');
            $table->float('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_types');
    }
};
