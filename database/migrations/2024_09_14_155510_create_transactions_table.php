<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('roombook_id');
        $table->string('pidx');
        $table->string('payment_method');
        $table->string('payment_status')->default('pending');
        $table->decimal('amount', 8, 2); // Adjust as needed
        $table->timestamps();

        $table->foreign('roombook_id')->references('id')->on('roombook')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
