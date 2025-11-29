<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Auditable as Auditing;
use OwenIt\Auditing\Contracts\Auditable;

class UserType extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\UserTypeFactory> */
    use Auditing, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'fee',
    ];

    protected function casts(): array
    {
        return [
            'fee' => 'integer',
        ];
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
