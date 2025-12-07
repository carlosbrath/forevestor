<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfitHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wallet_id',
        'investment_id',
        'profit_amount',
        'percentage',
        'profit_date',
    ];

    protected $casts = [
        'profit_amount' => 'decimal:2',
        'percentage' => 'decimal:2',
        'profit_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function investment(): BelongsTo
    {
        return $this->belongsTo(Investment::class);
    }
}
