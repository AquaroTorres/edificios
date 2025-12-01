<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $fillable = [
        'billing_period_id',
        'user_id',
        'number',
        'due_date',
        'status',
        'subtotal_common',
        'reserve_percent',
        'reserve_amount',
        'mora_percent',
        'mora_amount',
        'total_to_pay',
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    public function period(): BelongsTo
    {
        return $this->belongsTo(BillingPeriod::class, 'billing_period_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lines(): HasMany
    {
        return $this->hasMany(InvoiceLine::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
