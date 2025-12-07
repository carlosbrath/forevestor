<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add wallet_id to profit_histories table
        Schema::table('profit_histories', function (Blueprint $table) {
            // Make investment_id nullable since we now support wallet-based profits
            $table->foreignId('investment_id')->nullable()->change();

            // Add wallet_id column as nullable first
            $table->unsignedBigInteger('wallet_id')->nullable()->after('user_id');
        });

        // Add wallet_id to transactions table
        Schema::table('transactions', function (Blueprint $table) {
            // Add wallet_id column as nullable first
            $table->unsignedBigInteger('wallet_id')->nullable()->after('user_id');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profit_histories', function (Blueprint $table) {
            $table->dropColumn('wallet_id');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('wallet_id');
        });
    }
};
