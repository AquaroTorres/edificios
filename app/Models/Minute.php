<?php

namespace App\Models;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Auditable as Auditing;
use OwenIt\Auditing\Contracts\Auditable;

class Minute extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\MinuteFactory> */
    use Auditing, HasFactory;

    protected $fillable = [
        'title',
        'date',
        'body',
        'created_by',
        'minute_type_id',
        'is_public',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'is_public' => 'boolean',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function minuteType(): BelongsTo
    {
        return $this->belongsTo(MinuteType::class);
    }

    public function attendees(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'minute_user')
            ->withPivot('attended')
            ->withTimestamps()
            ->orderBy('name');
    }

    public function generatePdf()
    {
        // Load the minute with attendees for the PDF
        $this->load('attendees', 'creator');

        $pdf = Pdf::loadView('members.minutes.pdf', [
            'record' => $this,
        ])->setPaper('letter');

        return $pdf;
    }

    protected static function boot(): void
    {
        parent::boot();

        // Auto-assign created_by for new minutes when user is authenticated
        static::creating(function (Minute $minute) {
            if (! $minute->created_by && auth()->check()) {
                $minute->created_by = auth()->id();
            }
        });
    }
}
