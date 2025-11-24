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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total_deposit', 10, 2)->default(0);
            $table->decimal('total_profit', 10, 2)->default(0);
            $table->decimal('total_withdrawal', 10, 2)->default(0);
            $table->decimal('withdrawable_amount', 10, 2)->default(0);
            $table->date('last_withdrawal_date')->nullable();
            $table->timestamps();

            // Add indexes for faster queries
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
