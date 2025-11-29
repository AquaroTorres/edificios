<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as Auditing;
use OwenIt\Auditing\Contracts\Auditable;

class Item extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use Auditing, HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'description',
        'price',
        'active',
        'photo_path',
        'category_id',
        'location_id',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(ItemAssignment::class);
    }

    public function activeAssignment(): HasOne
    {
        return $this->hasOne(ItemAssignment::class)->whereNull('returned_at')->latestOfMany('assigned_at');
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
