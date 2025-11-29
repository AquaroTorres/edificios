<?php

namespace App\Models;

use App\Enums\MembershipFeeStatus;
use App\Enums\PaymentMechanism;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Auditable as Auditing;
use OwenIt\Auditing\Contracts\Auditable;

class MembershipFee extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\MembershipFeeFactory> */
    use Auditing, HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'concept',
        'year',
        'period',
        'amount',
        'paid_amount',
        'due_at',
        'paid_at',
        'income_type_id',
        'status',
    ];

    protected $appends = [
        'pending_amount',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'paid_amount' => 'integer',
            'due_at' => 'date',
            'paid_at' => 'datetime',
            'mechanism' => PaymentMechanism::class,
            'status' => MembershipFeeStatus::class,
        ];
    }

    /**
     * Atributo calculado: Monto pendiente de pago
     */
    protected function pendingAmount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->remainingAmount(),
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Todos los pagos (incomes) relacionados con esta cuota
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Income::class);
    }

    public function incomeType(): BelongsTo
    {
        return $this->belongsTo(IncomeType::class);
    }

    public function isPaid(): bool
    {
        return $this->paid_amount >= $this->amount;
    }

    public function isPartial(): bool
    {
        return $this->paid_amount > 0 && $this->paid_amount < $this->amount;
    }

    public function remainingAmount(): int
    {
        return max(0, $this->amount - $this->paid_amount);
    }

    public function paymentProgress(): float
    {
        return $this->amount > 0
            ? ($this->paid_amount / $this->amount) * 100
            : 0;
    }

    /**
     * Registrar un pago de cuota (crea un Income directamente)
     */
    public function registerPayment(
        int $amount,
        PaymentMechanism $mechanism,
        ?string $receiptPath = null,
        ?string $notes = null,
        ?int $creatorId = null
    ): Income {
        return DB::transaction(function () use ($amount, $mechanism, $receiptPath, $notes, $creatorId) {
            // Crear el Income que representa el pago
            $income = Income::create([
                'concept' => $notes ?? "Pago cuota período {$this->period} {$this->year}",
                'amount' => $amount,
                'date' => now(),
                'file_path' => $receiptPath,
                'user_id' => $this->user_id,
                'income_type_id' => $this->income_type_id,
                'mechanism' => $mechanism->value,
                'membership_fee_id' => $this->id,
                'creator_id' => $creatorId ?? auth()->id() ?? $this->user_id,
            ]);

            // Actualizar paid_amount de la cuota
            $this->paid_amount += $amount;

            // Actualizar status de la cuota
            if ($this->paid_amount >= $this->amount) {
                $this->status = 'pagado';
                $this->paid_at = now();
                $this->mechanism = $mechanism;
            } else {
                $this->status = 'parcial';
            }

            $this->save();

            return $income;
        });
    }

    /**
     * Recalcular paid_amount basado en los pagos (incomes) reales
     */
    public function recalculatePaidAmount(): void
    {
        $this->paid_amount = $this->payments()->sum('amount');

        if ($this->paid_amount >= $this->amount) {
            $this->status = 'pagado';
            $this->paid_at = $this->paid_at ?? now();
        } elseif ($this->paid_amount > 0) {
            $this->status = 'parcial';
        } else {
            $this->status = 'pendiente';
        }

        $this->save();
    }
}
