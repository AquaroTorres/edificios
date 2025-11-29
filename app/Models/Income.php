<?php

namespace App\Models;

use App\Enums\PaymentMechanism;
use App\Notifications\IncomeRegistered;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use OwenIt\Auditing\Auditable as Auditing;
use OwenIt\Auditing\Contracts\Auditable;

class Income extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\IncomeFactory> */
    use Auditing, HasFactory, SoftDeletes;

    protected $fillable = [
        'concept',
        'notes',
        'amount',
        'date',
        'income_type_id',
        'mechanism',
        'user_id',
        'receiver_id',
        'membership_fee_id',
        'file_path',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'date' => 'date',
            'mechanism' => PaymentMechanism::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function incomeType(): BelongsTo
    {
        return $this->belongsTo(IncomeType::class);
    }

    /**
     * Cuota de membresía asociada (si este income es un pago de cuota)
     */
    public function membershipFee(): BelongsTo
    {
        return $this->belongsTo(MembershipFee::class);
    }

    /**
     * Verifica si este income es un pago de cuota
     */
    public function isMembershipFeePayment(): bool
    {
        return $this->income_type_id === 2 && $this->membership_fee_id !== null;
    }

    // Generate PDF for income payment
    public function generatePdf()
    {
        $pdf = Pdf::loadView('finance.incomes.pdf', [
            'record' => $this,
        ])->setPaper('letter');

        return $pdf;
    }

    protected static function boot(): void
    {
        parent::boot();

        // Auto-assign income_type_id for membership fee payments
        static::creating(function (Income $income) {
            if ($income->membership_fee_id && ! $income->income_type_id) {
                $income->income_type_id = $income->membershipFee->income_type_id;
                $income->user_id = $income->membershipFee->user_id;
                if ($income->receiver_id === null) {
                    $income->receiver_id = auth()->id();
                }
            }
        });

        // Recalcular paid_amount cuando se elimina un pago
        static::deleted(function (Income $income) {
            if ($income->membershipFee) {
                $income->membershipFee->recalculatePaidAmount();
            }
        });

        // Recalcular paid_amount cuando se crea un pago
        static::created(function (Income $income) {
            if ($income->membershipFee) {
                $income->membershipFee->recalculatePaidAmount();
            }
            // Skip sending notifications when running in console (e.g., during seeders)
            if (! App::runningInConsole() && $income->user && ! empty($income->user->email)) {
                $income->user->notify(new IncomeRegistered($income));
            }
        });
    }
}
