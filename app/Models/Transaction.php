<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'related_id',
        'remark',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function relatedInvestment()
    {
        return $this->belongsTo(Investment::class, 'related_id');
    }

    public function relatedWithdrawal()
    {
        return $this->belongsTo(Withdrawal::class, 'related_id');
    }
}
