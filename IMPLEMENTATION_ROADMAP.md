# 🚀 FOREVESTOR IMPLEMENTATION ROADMAP

## 📋 BUSINESS REQUIREMENTS SUMMARY

### User Flow:
1. **Investor Registration** → Auto-create Wallet with unique ID
2. **Investment Submission** → Admin approval required
3. **Daily Profit Generation** → Based on tiered system settings
4. **Withdrawal** → Once per week to bank account
5. **Compound Option** → Re-invest profit back into investment
6. **Wallet Auto-Update** → Every transaction/profit/withdrawal

### Profit Tiers (Example):
- ₹1,00,000 → 5% daily profit
- ₹5,00,000 → 10% daily profit
- (Configurable via system settings)

---

## 🗂️ PHASE 1: DATABASE RESTRUCTURE (Critical)

### 1.1 Update Investments Table
**File:** `database/migrations/2025_01_01_000001_create_investments_table.php`

**Add Missing Columns:**
```php
Schema::create('investments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->decimal('investment_amount', 10, 2);
    $table->decimal('current_amount', 10, 2)->default(0); // After compounds
    $table->decimal('paid_amount', 10, 2);
    $table->string('payment_method', 50);
    $table->string('upi_id_or_bank', 150);
    $table->string('transaction_id', 150);
    $table->string('payment_proof')->nullable();
    $table->dateTime('transaction_datetime')->nullable();

    // Status: pending → approved → active → completed/inactive
    $table->enum('status', ['pending', 'approved', 'active', 'completed', 'rejected'])->default('pending');

    $table->dateTime('approved_at')->nullable();
    $table->dateTime('profit_cycle_start')->nullable();
    $table->dateTime('profit_cycle_end')->nullable(); // NEW

    // Profit tracking
    $table->decimal('total_profit_earned', 10, 2)->default(0); // NEW
    $table->decimal('total_compounded', 10, 2)->default(0); // NEW
    $table->decimal('profit_percentage', 5, 2)->nullable(); // NEW - Based on tier

    $table->timestamps();

    $table->index(['user_id', 'status']);
});
```

**Why these changes?**
- `current_amount`: Tracks investment after compounds (₹2L → ₹50k compound → ₹2.5L)
- `total_compounded`: Total amount added via compound feature
- `profit_percentage`: Store tier-based percentage (5%, 10%, etc.)
- `active` status: Investment is approved and generating profits
- `completed`: Investment cycle ended

---

### 1.2 Update Wallets Table
**File:** `database/migrations/0001_01_01_000005_create_wallets_table.php`

**Add Unique Wallet ID:**
```php
Schema::create('wallets', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');

    // Unique wallet identifier
    $table->string('wallet_id', 20)->unique(); // NEW: FV-USR-000001

    // Balance tracking
    $table->decimal('total_invested', 10, 2)->default(0); // Total deposits
    $table->decimal('active_investment', 10, 2)->default(0); // Currently invested
    $table->decimal('total_profit_earned', 10, 2)->default(0);
    $table->decimal('withdrawable_balance', 10, 2)->default(0);
    $table->decimal('total_withdrawn', 10, 2)->default(0);
    $table->decimal('total_compounded', 10, 2)->default(0); // NEW

    // Withdrawal limits
    $table->date('last_withdrawal_date')->nullable();
    $table->integer('withdrawal_count_this_week')->default(0); // NEW
    $table->date('week_start_date')->nullable(); // NEW

    $table->timestamps();

    $table->index('user_id');
    $table->index('wallet_id');
});
```

**Wallet ID Format:** `FV-USR-000001`, `FV-USR-000002`, etc.

---

### 1.3 Create System Settings Table
**New File:** `database/migrations/2025_01_02_000001_create_system_settings_table.php`

```php
Schema::create('system_settings', function (Blueprint $table) {
    $table->id();
    $table->string('key')->unique();
    $table->text('value');
    $table->string('type')->default('string'); // string, json, number, boolean
    $table->text('description')->nullable();
    $table->timestamps();
});
```

**Default Settings (Seeder):**
```php
// database/seeders/SystemSettingsSeeder.php
[
    ['key' => 'profit_tiers', 'value' => json_encode([
        ['min' => 0, 'max' => 100000, 'percentage' => 3],
        ['min' => 100000, 'max' => 500000, 'percentage' => 5],
        ['min' => 500000, 'max' => 1000000, 'percentage' => 8],
        ['min' => 1000000, 'max' => null, 'percentage' => 10],
    ]), 'type' => 'json'],
    ['key' => 'withdrawal_limit_days', 'value' => '7', 'type' => 'number'],
    ['key' => 'min_withdrawal_amount', 'value' => '500', 'type' => 'number'],
    ['key' => 'profit_calculation_time', 'value' => '00:00', 'type' => 'string'],
]
```

---

### 1.4 Create Compounds Table
**New File:** `database/migrations/2025_01_02_000002_create_compounds_table.php`

```php
Schema::create('compounds', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('investment_id')->constrained()->onDelete('cascade');
    $table->decimal('compound_amount', 10, 2);
    $table->decimal('previous_investment', 10, 2);
    $table->decimal('new_investment', 10, 2);
    $table->date('compound_date');
    $table->text('remark')->nullable();
    $table->timestamps();

    $table->index(['user_id', 'investment_id']);
});
```

**Purpose:** Track all compound activities
- Example: ₹2L → ₹50k compound → ₹2.5L (record this change)

---

### 1.5 Update Transactions Table
**File:** `database/migrations/2025_01_01_000004_create_transactions_table.php`

**Add compound type:**
```php
Schema::create('transactions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->enum('type', ['deposit', 'profit', 'withdrawal', 'compound']); // Added compound
    $table->decimal('amount', 10, 2);
    $table->unsignedBigInteger('related_id')->nullable();
    $table->string('related_type')->nullable(); // investment, withdrawal, compound
    $table->decimal('balance_before', 10, 2)->default(0); // NEW
    $table->decimal('balance_after', 10, 2)->default(0); // NEW
    $table->text('remark')->nullable();
    $table->timestamps();

    $table->index(['user_id', 'type']);
});
```

---

## 🏗️ PHASE 2: MODELS & RELATIONSHIPS

### 2.1 Update Investment Model
**File:** `app/Models/Investment.php`

```php
protected $fillable = [
    'user_id',
    'investment_amount',
    'current_amount',
    'paid_amount',
    'payment_method',
    'upi_id_or_bank',
    'transaction_id',
    'payment_proof',
    'transaction_datetime',
    'status',
    'approved_at',
    'profit_cycle_start',
    'profit_cycle_end',
    'total_profit_earned',
    'total_compounded',
    'profit_percentage',
];

protected $casts = [
    'investment_amount' => 'decimal:2',
    'current_amount' => 'decimal:2',
    'paid_amount' => 'decimal:2',
    'total_profit_earned' => 'decimal:2',
    'total_compounded' => 'decimal:2',
    'profit_percentage' => 'decimal:2',
    'transaction_datetime' => 'datetime',
    'approved_at' => 'datetime',
    'profit_cycle_start' => 'datetime',
    'profit_cycle_end' => 'datetime',
];

// Relationships
public function compounds()
{
    return $this->hasMany(Compound::class);
}
```

---

### 2.2 Update Wallet Model
**File:** `app/Models/Wallet.php`

```php
protected $fillable = [
    'user_id',
    'wallet_id',
    'total_invested',
    'active_investment',
    'total_profit_earned',
    'withdrawable_balance',
    'total_withdrawn',
    'total_compounded',
    'last_withdrawal_date',
    'withdrawal_count_this_week',
    'week_start_date',
];

// Auto-generate wallet ID on creation
protected static function boot()
{
    parent::boot();

    static::creating(function ($wallet) {
        if (!$wallet->wallet_id) {
            $wallet->wallet_id = self::generateWalletId();
        }
    });
}

private static function generateWalletId()
{
    $lastWallet = self::orderBy('id', 'desc')->first();
    $nextId = $lastWallet ? $lastWallet->id + 1 : 1;
    return 'FV-USR-' . str_pad($nextId, 6, '0', STR_PAD_LEFT);
}

// Check if user can withdraw
public function canWithdraw()
{
    if (!$this->last_withdrawal_date) {
        return true;
    }

    $daysSinceLastWithdrawal = now()->diffInDays($this->last_withdrawal_date);
    $withdrawalLimit = SystemSetting::get('withdrawal_limit_days', 7);

    return $daysSinceLastWithdrawal >= $withdrawalLimit;
}
```

---

### 2.3 Create Compound Model
**New File:** `app/Models/Compound.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compound extends Model
{
    protected $fillable = [
        'user_id',
        'investment_id',
        'compound_amount',
        'previous_investment',
        'new_investment',
        'compound_date',
        'remark',
    ];

    protected $casts = [
        'compound_amount' => 'decimal:2',
        'previous_investment' => 'decimal:2',
        'new_investment' => 'decimal:2',
        'compound_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }
}
```

---

### 2.4 Create SystemSetting Model
**New File:** `app/Models/SystemSetting.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'description'];

    // Get setting value by key
    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();

        if (!$setting) {
            return $default;
        }

        return match($setting->type) {
            'json' => json_decode($setting->value, true),
            'number' => (float) $setting->value,
            'boolean' => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN),
            default => $setting->value,
        };
    }

    // Get profit percentage based on investment amount
    public static function getProfitPercentage($amount)
    {
        $tiers = self::get('profit_tiers', []);

        foreach ($tiers as $tier) {
            $min = $tier['min'];
            $max = $tier['max'] ?? PHP_FLOAT_MAX;

            if ($amount >= $min && $amount < $max) {
                return $tier['percentage'];
            }
        }

        return 0;
    }
}
```

---

## 🔄 PHASE 3: OBSERVERS (Auto-Update Wallet)

### 3.1 Create WalletObserver
**New File:** `app/Observers/WalletObserver.php`

**Purpose:** Auto-update wallet on every transaction

```php
<?php

namespace App\Observers;

use App\Models\Investment;
use App\Models\ProfitHistory;
use App\Models\Withdrawal;
use App\Models\Compound;
use App\Models\Wallet;

class WalletObserver
{
    // When investment is approved
    public function investmentApproved(Investment $investment)
    {
        $wallet = Wallet::where('user_id', $investment->user_id)->first();

        $wallet->update([
            'total_invested' => $wallet->total_invested + $investment->investment_amount,
            'active_investment' => $wallet->active_investment + $investment->current_amount,
        ]);
    }

    // When daily profit is added
    public function profitAdded(ProfitHistory $profit)
    {
        $wallet = Wallet::where('user_id', $profit->user_id)->first();

        $wallet->update([
            'total_profit_earned' => $wallet->total_profit_earned + $profit->profit_amount,
            'withdrawable_balance' => $wallet->withdrawable_balance + $profit->profit_amount,
        ]);
    }

    // When withdrawal is processed
    public function withdrawalProcessed(Withdrawal $withdrawal)
    {
        $wallet = Wallet::where('user_id', $withdrawal->user_id)->first();

        $wallet->update([
            'withdrawable_balance' => $wallet->withdrawable_balance - $withdrawal->amount,
            'total_withdrawn' => $wallet->total_withdrawn + $withdrawal->amount,
            'last_withdrawal_date' => now(),
        ]);
    }

    // When compound is done
    public function compoundProcessed(Compound $compound)
    {
        $wallet = Wallet::where('user_id', $compound->user_id)->first();

        $wallet->update([
            'total_compounded' => $wallet->total_compounded + $compound->compound_amount,
            'withdrawable_balance' => $wallet->withdrawable_balance - $compound->compound_amount,
            'active_investment' => $wallet->active_investment + $compound->compound_amount,
        ]);
    }
}
```

**Register Observer in AppServiceProvider:**
```php
// app/Providers/AppServiceProvider.php
use App\Models\Investment;
use App\Models\ProfitHistory;
use App\Models\Withdrawal;
use App\Models\Compound;
use App\Observers\WalletObserver;

public function boot()
{
    Investment::observe(WalletObserver::class);
    ProfitHistory::observe(WalletObserver::class);
    Withdrawal::observe(WalletObserver::class);
    Compound::observe(WalletObserver::class);
}
```

---

## 🎛️ PHASE 4: CONTROLLERS

### 4.1 Update DashboardController
**File:** `app/Http/Controllers/DashboardController.php`

**Use Wallet instead of calculations:**
```php
public function index()
{
    $user = auth()->user();
    $wallet = $user->wallet; // Load from relationship

    if (in_array($user->role?->name, ['super-admin', 'admin', 'moderator'])) {
        return redirect()->route('admin.dashboard');
    }

    // Get data from wallet (single source of truth)
    $totalInvestment = $wallet->active_investment;
    $withdrawableAmount = $wallet->withdrawable_balance;
    $totalWithdrawn = $wallet->total_withdrawn;
    $totalCompounded = $wallet->total_compounded;

    // Today's profit
    $todaysProfit = ProfitHistory::where('user_id', $user->id)
        ->whereDate('profit_date', today())
        ->sum('profit_amount');

    // Recent transactions
    $recentTransactions = Transaction::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();

    // Can withdraw?
    $canWithdraw = $wallet->canWithdraw();
    $nextWithdrawalDate = $wallet->last_withdrawal_date?->addDays(7);

    return view('dashboard.investor', compact(
        'user',
        'wallet',
        'totalInvestment',
        'withdrawableAmount',
        'totalWithdrawn',
        'totalCompounded',
        'todaysProfit',
        'recentTransactions',
        'canWithdraw',
        'nextWithdrawalDate'
    ));
}
```

---

### 4.2 Create WithdrawalController
**New File:** `app/Http/Controllers/WithdrawalController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Models\Transaction;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('withdrawals.index', compact('withdrawals'));
    }

    public function create()
    {
        $wallet = auth()->user()->wallet;

        // Check if can withdraw
        if (!$wallet->canWithdraw()) {
            $nextDate = $wallet->last_withdrawal_date->addDays(7);
            return redirect()->back()->withErrors([
                'error' => "You can only withdraw once per week. Next withdrawal available on {$nextDate->format('M d, Y')}"
            ]);
        }

        // Check minimum balance
        $minAmount = SystemSetting::get('min_withdrawal_amount', 500);
        if ($wallet->withdrawable_balance < $minAmount) {
            return redirect()->back()->withErrors([
                'error' => "Minimum withdrawal amount is ₹{$minAmount}"
            ]);
        }

        return view('withdrawals.create', compact('wallet'));
    }

    public function store(Request $request)
    {
        $wallet = auth()->user()->wallet;

        $validated = $request->validate([
            'amount' => "required|numeric|min:500|max:{$wallet->withdrawable_balance}",
            'method' => 'required|in:upi,bank_transfer',
            'upi_id_or_bank' => 'required|string',
        ]);

        // Check weekly limit
        if (!$wallet->canWithdraw()) {
            return back()->withErrors(['error' => 'Weekly withdrawal limit reached']);
        }

        try {
            DB::beginTransaction();

            // Create withdrawal request
            $withdrawal = Withdrawal::create([
                'user_id' => auth()->id(),
                'amount' => $validated['amount'],
                'method' => $validated['method'],
                'upi_id_or_bank' => $validated['upi_id_or_bank'],
                'status' => 'pending',
                'requested_at' => now(),
            ]);

            // Create transaction record
            Transaction::create([
                'user_id' => auth()->id(),
                'type' => 'withdrawal',
                'amount' => $validated['amount'],
                'related_id' => $withdrawal->id,
                'related_type' => 'withdrawal',
                'balance_before' => $wallet->withdrawable_balance,
                'balance_after' => $wallet->withdrawable_balance - $validated['amount'],
                'remark' => 'Withdrawal request created',
            ]);

            DB::commit();

            return redirect()->route('withdrawals.show', $withdrawal)
                ->with('success', 'Withdrawal request submitted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to process withdrawal']);
        }
    }
}
```

---

### 4.3 Create CompoundController
**New File:** `app/Http/Controllers/CompoundController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Compound;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompoundController extends Controller
{
    public function index()
    {
        $compounds = Compound::where('user_id', auth()->id())
            ->with('investment')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('compounds.index', compact('compounds'));
    }

    public function create()
    {
        $wallet = auth()->user()->wallet;

        // Get active investments
        $activeInvestments = Investment::where('user_id', auth()->id())
            ->where('status', 'active')
            ->get();

        if ($activeInvestments->isEmpty()) {
            return redirect()->back()->withErrors([
                'error' => 'You need at least one active investment to compound'
            ]);
        }

        if ($wallet->withdrawable_balance <= 0) {
            return redirect()->back()->withErrors([
                'error' => 'Insufficient balance to compound'
            ]);
        }

        return view('compounds.create', compact('wallet', 'activeInvestments'));
    }

    public function store(Request $request)
    {
        $wallet = auth()->user()->wallet;

        $validated = $request->validate([
            'investment_id' => 'required|exists:investments,id',
            'amount' => "required|numeric|min:100|max:{$wallet->withdrawable_balance}",
        ]);

        $investment = Investment::findOrFail($validated['investment_id']);

        // Ensure user owns this investment
        if ($investment->user_id !== auth()->id()) {
            abort(403);
        }

        try {
            DB::beginTransaction();

            $previousAmount = $investment->current_amount;
            $newAmount = $previousAmount + $validated['amount'];

            // Update investment
            $investment->update([
                'current_amount' => $newAmount,
                'total_compounded' => $investment->total_compounded + $validated['amount'],
                'profit_percentage' => SystemSetting::getProfitPercentage($newAmount),
            ]);

            // Create compound record
            $compound = Compound::create([
                'user_id' => auth()->id(),
                'investment_id' => $investment->id,
                'compound_amount' => $validated['amount'],
                'previous_investment' => $previousAmount,
                'new_investment' => $newAmount,
                'compound_date' => now(),
                'remark' => "Compounded ₹{$validated['amount']} from withdrawable balance",
            ]);

            // Create transaction
            Transaction::create([
                'user_id' => auth()->id(),
                'type' => 'compound',
                'amount' => $validated['amount'],
                'related_id' => $compound->id,
                'related_type' => 'compound',
                'balance_before' => $wallet->withdrawable_balance,
                'balance_after' => $wallet->withdrawable_balance - $validated['amount'],
                'remark' => "Compounded to investment #{$investment->id}",
            ]);

            // Observer will auto-update wallet

            DB::commit();

            return redirect()->route('compounds.show', $compound)
                ->with('success', "Successfully compounded ₹{$validated['amount']}!");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to process compound']);
        }
    }
}
```

---

## ⏰ PHASE 5: DAILY PROFIT CALCULATION (CRON JOB)

### 5.1 Create ProfitCalculationCommand
**New File:** `app/Console/Commands/CalculateDailyProfits.php`

```php
<?php

namespace App\Console\Commands;

use App\Models\Investment;
use App\Models\ProfitHistory;
use App\Models\Transaction;
use App\Models\SystemSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateDailyProfits extends Command
{
    protected $signature = 'profits:calculate';
    protected $description = 'Calculate and distribute daily profits to active investments';

    public function handle()
    {
        $this->info('Starting daily profit calculation...');

        // Get all active investments
        $activeInvestments = Investment::where('status', 'active')->get();

        $processedCount = 0;
        $totalProfitDistributed = 0;

        foreach ($activeInvestments as $investment) {
            try {
                DB::beginTransaction();

                // Calculate profit based on current_amount and profit_percentage
                $profitAmount = ($investment->current_amount * $investment->profit_percentage) / 100;

                // Create profit history record
                $profit = ProfitHistory::create([
                    'user_id' => $investment->user_id,
                    'investment_id' => $investment->id,
                    'profit_amount' => $profitAmount,
                    'percentage' => $investment->profit_percentage,
                    'profit_date' => today(),
                ]);

                // Update investment total profit
                $investment->increment('total_profit_earned', $profitAmount);

                // Create transaction
                $wallet = $investment->user->wallet;
                Transaction::create([
                    'user_id' => $investment->user_id,
                    'type' => 'profit',
                    'amount' => $profitAmount,
                    'related_id' => $profit->id,
                    'related_type' => 'profit',
                    'balance_before' => $wallet->withdrawable_balance,
                    'balance_after' => $wallet->withdrawable_balance + $profitAmount,
                    'remark' => "Daily profit {$investment->profit_percentage}% on ₹{$investment->current_amount}",
                ]);

                // Observer will update wallet automatically

                DB::commit();

                $processedCount++;
                $totalProfitDistributed += $profitAmount;

            } catch (\Exception $e) {
                DB::rollBack();
                $this->error("Failed to process investment ID {$investment->id}: " . $e->getMessage());
            }
        }

        $this->info("Processed {$processedCount} investments");
        $this->info("Total profit distributed: ₹" . number_format($totalProfitDistributed, 2));

        return 0;
    }
}
```

**Register in Kernel:**
```php
// app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    // Run daily at midnight
    $schedule->command('profits:calculate')->dailyAt('00:00');
}
```

---

## 🛣️ PHASE 6: ROUTES

### 6.1 Add Missing Routes
**File:** `routes/web.php`

```php
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Investor routes
    Route::middleware('role:investor,moderator,admin,super-admin')->group(function () {
        // Investments
        Route::resource('investments', InvestmentController::class);

        // Withdrawals
        Route::resource('withdrawals', WithdrawalController::class);

        // Compounds
        Route::resource('compounds', CompoundController::class);

        // Wallet
        Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
        Route::get('/wallet/transactions', [WalletController::class, 'transactions'])->name('wallet.transactions');
    });

    // Admin routes
    Route::middleware('role:admin,moderator,super-admin')->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

            // Withdrawal approvals
            Route::get('/withdrawals', [AdminController::class, 'withdrawals'])->name('withdrawals');
            Route::post('/withdrawals/{withdrawal}/approve', [AdminController::class, 'approveWithdrawal'])->name('approve-withdrawal');
            Route::post('/withdrawals/{withdrawal}/reject', [AdminController::class, 'rejectWithdrawal'])->name('reject-withdrawal');

            // System settings
            Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
            Route::post('/settings', [AdminController::class, 'updateSettings'])->name('update-settings');
        });
    });
});
```

---

## 🎨 PHASE 7: UPDATE VIEWS

### 7.1 Update investor.blade.php Links
**File:** `resources/views/dashboard/investor.blade.php`

```blade
<!-- Quick Actions -->
<a href="{{ route('investments.create') }}" class="quick-action-btn deposit">
    <i class="bi bi-download"></i>
    <span>Deposit</span>
</a>
<a href="{{ route('withdrawals.create') }}" class="quick-action-btn withdraw">
    <i class="bi bi-upload"></i>
    <span>Withdraw</span>
</a>
<a href="{{ route('compounds.create') }}" class="quick-action-btn compound">
    <i class="bi bi-arrow-repeat"></i>
    <span>Compound</span>
</a>
<a href="{{ route('investments.index') }}" class="quick-action-btn invest">
    <i class="bi bi-plus-circle"></i>
    <span>Invest</span>
</a>

<!-- View All Transactions -->
<a href="{{ route('wallet.transactions') }}" class="view-all-link">View All</a>

<!-- Display wallet data -->
<h3 class="stat-value">₹{{ number_format($wallet->active_investment, 2) }}</h3>
<h3 class="stat-value">₹{{ number_format($wallet->withdrawable_balance, 2) }}</h3>
<h3 class="stat-value">₹{{ number_format($todaysProfit, 2) }}</h3>
<h3 class="stat-value">₹{{ number_format($wallet->total_compounded, 2) }}</h3>

<!-- Total Withdrawn -->
<h2>₹{{ number_format($wallet->total_withdrawn, 2) }}</h2>
```

---

## 🔐 PHASE 8: USER REGISTRATION WALLET AUTO-CREATE

### 8.1 Update RegistrationController
**File:** `app/Http/Controllers/RegistrationController.php`

```php
public function register(Request $request)
{
    // ... validation ...

    try {
        DB::beginTransaction();

        // Create user
        $user = User::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'referral_code' => $validated['referral_code'] ?? null,
            'terms_agreed' => true,
            'status' => 'pending',
        ]);

        // Auto-assign investor role
        $investorRole = Role::where('name', 'investor')->first();
        $user->role()->associate($investorRole);
        $user->save();

        // AUTO-CREATE WALLET with unique ID
        Wallet::create([
            'user_id' => $user->id,
            // wallet_id auto-generated by model
        ]);

        DB::commit();

        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'Registration successful! Your wallet has been created.');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Registration failed']);
    }
}
```

---

## 📊 PHASE 9: ADMIN APPROVAL WORKFLOW

### 9.1 Update AdminController
**File:** `app/Http/Controllers/AdminController.php`

```php
public function approveInvestment(Investment $investment)
{
    try {
        DB::beginTransaction();

        // Calculate profit percentage based on amount
        $profitPercentage = SystemSetting::getProfitPercentage($investment->investment_amount);

        // Update investment
        $investment->update([
            'status' => 'active',
            'approved_at' => now(),
            'profit_cycle_start' => now(),
            'current_amount' => $investment->investment_amount,
            'profit_percentage' => $profitPercentage,
        ]);

        // Update wallet (via observer)
        // Observer will auto-update total_invested and active_investment

        DB::commit();

        return redirect()->back()
            ->with('success', "Investment approved! Profit: {$profitPercentage}% daily");

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Approval failed']);
    }
}
```

---

## ✅ IMPLEMENTATION CHECKLIST

### Database (Priority 1)
- [ ] Update investments table (add columns)
- [ ] Update wallets table (add wallet_id, compound tracking)
- [ ] Create system_settings table
- [ ] Create compounds table
- [ ] Update transactions table (add compound type)
- [ ] Run migrations
- [ ] Create SystemSettingsSeeder
- [ ] Run seeder

### Models (Priority 2)
- [ ] Update Investment model fillable array
- [ ] Update Wallet model with auto-generation logic
- [ ] Create Compound model
- [ ] Create SystemSetting model
- [ ] Add relationships to User model

### Observers (Priority 3)
- [ ] Create WalletObserver
- [ ] Register observer in AppServiceProvider
- [ ] Test wallet auto-update on transactions

### Controllers (Priority 4)
- [ ] Update DashboardController (use wallet data)
- [ ] Create WithdrawalController
- [ ] Create CompoundController
- [ ] Update AdminController (investment approval)
- [ ] Update RegistrationController (wallet creation)

### Commands (Priority 5)
- [ ] Create CalculateDailyProfits command
- [ ] Register in Kernel schedule
- [ ] Test profit calculation

### Routes (Priority 6)
- [ ] Add withdrawal routes
- [ ] Add compound routes
- [ ] Add wallet routes
- [ ] Update quick action links

### Views (Priority 7)
- [ ] Create withdrawal views (index, create, show)
- [ ] Create compound views (index, create, show)
- [ ] Update investor.blade.php with wallet data
- [ ] Add Chart.js for portfolio

### Testing (Priority 8)
- [ ] Test user registration → wallet creation
- [ ] Test investment → admin approval → active
- [ ] Test daily profit calculation
- [ ] Test withdrawal (weekly limit)
- [ ] Test compound (profit → investment)
- [ ] Test wallet balance updates

---

## 🎯 TIMELINE ESTIMATE

**Week 1:** Database + Models + Observers (Foundation)
**Week 2:** Controllers + Routes (Core functionality)
**Week 3:** Views + Testing (User interface)
**Week 4:** Cron Jobs + Admin Panel + Polish

---

## 📝 NOTES

1. **Wallet is the single source of truth** - all balance calculations come from wallet
2. **Observers auto-update wallet** - no manual updates needed
3. **System settings are configurable** - profit tiers can be changed via admin panel
4. **Weekly withdrawal limit enforced** - users can only withdraw once per 7 days
5. **Compound increases current_amount** - which increases daily profit
6. **Daily cron job calculates profits** - runs at midnight automatically

---

Would you like me to start implementing these phases?
