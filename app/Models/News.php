<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as Auditing;
use OwenIt\Auditing\Contracts\Auditable;

class News extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\NewsFactory> */
    use Auditing, HasFactory;

    protected $fillable = [
        'title',
        'body',
        'photo_path',
        'link',
        'creator_id',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (News $news) {
            if (auth()->check() && ! $news->creator_id) {
                $news->creator_id = auth()->id();
            }
        });
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
