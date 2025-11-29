<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MinuteType extends Model
{
    /** @use HasFactory<\Database\Factories\MinuteTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function minutes(): HasMany
    {
        return $this->hasMany(Minute::class, 'minute_type_id');
    }
}
