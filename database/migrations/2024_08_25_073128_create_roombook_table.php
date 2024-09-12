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
        Schema::create('roombook', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('room_id'); // Reference to the room table
            $table->string('name');
            $table->string('phone');
            $table->string('roomtype');
            $table->string('roomno');
            $table->date('checkin');    // Changed to date type for better date handling
            $table->date('checkout');   // Changed to date type for better date handling
            $table->unsignedInteger('guestn');  // Changed to unsignedInteger for guest count
            $table->text('message')->nullable();  // Set message as nullable
            $table->string('status')->default('pending');  // Added default value for status
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('room')->onDelete('cascade'); // Foreign key for room
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roombook');
    }
};
