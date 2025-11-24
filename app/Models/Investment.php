<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'investment_amount',
        'paid_amount',
        'payment_method',
        'upi_id_or_bank',
        'transaction_id',
        'payment_proof',
        'transaction_datetime',
        'status',
        'approved_at',
        'profit_cycle_start',
    ];

    protected $casts = [
        'investment_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'transaction_datetime' => 'datetime',
        'approved_at' => 'datetime',
        'profit_cycle_start' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function profitHistories(): HasMany
    {
        return $this->hasMany(ProfitHistory::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'related_id');
    }
}
