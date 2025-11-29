<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as Auditing;
use OwenIt\Auditing\Contracts\Auditable;

class ItemAssignment extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\ItemAssignmentFactory> */
    use Auditing, HasFactory;

    protected $fillable = [
        'item_id', 'user_id', 'assigned_at', 'returned_at', 'notes', 'assigned_by',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'returned_at' => 'datetime',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    /** Scope para la activa */
    public function scopeActive($q)
    {
        return $q->whereNull('returned_at');
    }
}
