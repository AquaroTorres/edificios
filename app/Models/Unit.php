<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Unit extends Model
{
    /** @use HasFactory<\Database\Factories\UnitFactory> */
    use HasFactory;

    protected $fillable = [
        'correlative',
        'unit_type_id',
        'number',
        'floor',
        'rol',
        'surface',
        'proration',
    ];

    protected function casts(): array
    {
        return [
            'area_m2' => 'integer',
            'proration' => 'decimal:4',
        ];
    }

    public function unitType(): BelongsTo
    {
        return $this->belongsTo(UnitType::class);
    }
}
