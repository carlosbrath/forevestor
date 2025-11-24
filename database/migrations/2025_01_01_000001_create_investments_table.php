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
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('investment_amount', 10, 2);
            $table->decimal('paid_amount', 10, 2);
            $table->string('payment_method', 50);
            $table->string('upi_id_or_bank', 150);
            $table->string('transaction_id', 150);
            $table->string('payment_proof');
            $table->dateTime('transaction_datetime');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('profit_cycle_start')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};
