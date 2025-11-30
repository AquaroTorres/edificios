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

        // Skip sending notifications when running in console (e.g., during seeders)
        static::created(function (Income $income) {
            if (! App::runningInConsole() && $income->user && ! empty($income->user->email)) {
                $income->user->notify(new IncomeRegistered($income));
            }
        });
    }
}
