<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wallet_id',
        'total_deposit',
        'total_investment',
        'total_profit',
        'total_withdrawal',
        'withdrawable_amount',
        'last_withdrawal_date',
    ];

    protected $casts = [
        'total_deposit' => 'decimal:2',
        'total_investment' => 'decimal:2',
        'total_profit' => 'decimal:2',
        'total_withdrawal' => 'decimal:2',
        'withdrawable_amount' => 'decimal:2',
        'last_withdrawal_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalBalanceAttribute()
    {
        return $this->total_deposit + $this->total_profit - $this->total_withdrawal;
    }

    /**
     * Generate a unique wallet ID
     */
    public static function generateWalletId(): string
    {
        do {
            $uniqueNumber = strtoupper(substr(uniqid(), -8));
            $walletId = 'FV-User-' . $uniqueNumber;
        } while (self::where('wallet_id', $walletId)->exists());

        return $walletId;
    }
}
