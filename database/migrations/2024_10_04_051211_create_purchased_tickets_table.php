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
        Schema::create('purchased_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('ticket_id')
                ->constrained('ticket_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');

                $table->foreignId('promo_code_id')
                ->constrained('promo_codes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('name');
            $table->string('email');
            $table->string('phone_number')->nullable();
            $table->float('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchased_tickets');
    }
};