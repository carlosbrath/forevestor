<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Wallet;
use App\Models\ProfitHistory;
use App\Models\Transaction;
use App\Helpers\ProfitHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DistributeDailyProfit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'profit:distribute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Distribute daily profits to investors based on their total wallet investment';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting daily profit distribution...');

        try {
            DB::beginTransaction();

            // Get all wallets with total investment > 0
            $wallets = Wallet::with('user')
                ->where('total_investment', '>', 0)
                ->get();

            $totalProfitDistributed = 0;
            $walletsProcessed = 0;

            foreach ($wallets as $wallet) {
                // Skip if user doesn't exist
                if (!$wallet->user) {
                    $this->warn("Wallet #{$wallet->id} has no associated user");
                    continue;
                }

                // Check if profit already distributed today for this user
                $todayProfit = ProfitHistory::where('user_id', $wallet->user_id)
                    ->whereNull('investment_id') // Wallet-based profit has null investment_id
                    ->whereDate('profit_date', today())
                    ->first();

                if ($todayProfit) {
                    $this->warn("Profit already distributed today for {$wallet->user->full_name}");
                    continue;
                }

                // Calculate daily profit based on total investment in wallet
                $profitData = ProfitHelper::calculateDailyProfit($wallet->total_investment);

                if ($profitData['amount'] <= 0) {
                    $this->warn("{$wallet->user->full_name}'s total investment (₹{$wallet->total_investment}) is below minimum (₹10,000)");
                    continue;
                }

                // Create profit history record (without investment_id since it's wallet-based)
                ProfitHistory::create([
                    'user_id' => $wallet->user_id,
                    'wallet_id' => $wallet->id,
                    'investment_id' => null, // Null indicates wallet-based profit
                    'profit_amount' => $profitData['amount'],
                    'percentage' => $profitData['percentage'],
                    'profit_date' => today(),
                ]);

                // Create transaction record
                Transaction::create([
                    'user_id' => $wallet->user_id,
                    'wallet_id' => $wallet->id,
                    'type' => 'profit',
                    'amount' => $profitData['amount'],
                    'related_id' => null, // No specific investment relation
                    'remark' => "Daily profit ({$profitData['percentage']}%) on total investment ₹" . number_format($wallet->total_investment, 2),
                ]);

                // Update wallet
                $wallet->increment('total_profit', $profitData['amount']);
                $wallet->increment('withdrawable_amount', $profitData['amount']);

                $totalProfitDistributed += $profitData['amount'];
                $walletsProcessed++;

                $this->info("✓ Distributed ₹{$profitData['amount']} ({$profitData['percentage']}%) to {$wallet->user->full_name} (Total Investment: ₹{$wallet->total_investment})");
            }

            DB::commit();

            $this->newLine();
            $this->info("✓ Daily profit distribution completed successfully!");
            $this->info("Total wallets processed: {$walletsProcessed}");
            $this->info("Total profit distributed: ₹" . number_format($totalProfitDistributed, 2));

            // Log the distribution
            Log::info('Daily profit distribution completed', [
                'wallets_processed' => $walletsProcessed,
                'total_profit' => $totalProfitDistributed,
                'date' => today()->toDateString(),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Error distributing profits: ' . $e->getMessage());
            Log::error('Daily profit distribution failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
