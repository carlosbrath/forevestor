<?php

namespace App\Helpers;

class ProfitHelper
{
    /**
     * Calculate daily profit percentage based on investment amount
     *
     * @param float $investmentAmount
     * @return float
     */
    public static function calculateDailyProfitPercentage(float $investmentAmount): float
    {
        if ($investmentAmount >= 10000 && $investmentAmount <= 100000) {
            return 0.333; // 0.333% for 10K to 100K
        } elseif ($investmentAmount >= 100001 && $investmentAmount <= 300000) {
            return 0.4; // 0.4% for 100K to 300K
        } elseif ($investmentAmount >= 300001) {
            return 0.466; // 14% for 300K and above
        }

        return 0; // No profit for investments below 10K
    }

    /**
     * Calculate daily profit amount
     *
     * @param float $investmentAmount
     * @return array ['percentage' => float, 'amount' => float]
     */
    public static function calculateDailyProfit(float $investmentAmount): array
    {
        $percentage = self::calculateDailyProfitPercentage($investmentAmount);
        $profitAmount = ($investmentAmount * $percentage) / 100;

        return [
            'percentage' => $percentage,
            'amount' => round($profitAmount, 2),
        ];
    }

    /**
     * Get profit tier description
     *
     * @param float $investmentAmount
     * @return string
     */
    public static function getProfitTier(float $investmentAmount): string
    {
        if ($investmentAmount >= 10000 && $investmentAmount <= 100000) {
            return 'Tier 1 (₹10K - ₹100K)';
        } elseif ($investmentAmount >= 100001 && $investmentAmount <= 300000) {
            return 'Tier 2 (₹100K - ₹300K)';
        } elseif ($investmentAmount >= 300001) {
            return 'Tier 3 (₹300K+)';
        }

        return 'Below Minimum';
    }
}
