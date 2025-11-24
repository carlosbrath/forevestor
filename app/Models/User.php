<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role_id',
        'full_name',
        'email',
        'phone',
        'password',
        'date_of_birth',
        'address',
        'city',
        'country',
        'cnic_number',
        'cnic_front_image',
        'cnic_back_image',
        'referral_code',
        'terms_agreed',
        'status',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
            'terms_agreed' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the role associated with this user
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get all investments for this user
     */
    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    /**
     * Get all profit histories for this user
     */
    public function profitHistories()
    {
        return $this->hasMany(ProfitHistory::class);
    }

    /**
     * Get all withdrawals for this user
     */
    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    /**
     * Get all transactions for this user
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the wallet for this user
     */
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
}
