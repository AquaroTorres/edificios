<?php

namespace App\Models;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    /** @use HasFactory<\Database\Factories\CertificateFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'issued_date',
        'user_id',
        'certificate_type_id',
        'signer_id_1',
        'signer_id_2',
        'signer_id_3',
        'citation_start',
        'citation_end',
        'institution',
        'pdf_path',
    ];

    protected $casts = [
        'issued_date' => 'date',
        'citation_start' => 'datetime',
        'citation_end' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function certificateType(): BelongsTo
    {
        return $this->belongsTo(CertificateType::class);
    }

    public function signer1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'signer_id_1');
    }

    public function signer2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'signer_id_2');
    }

    public function signer3(): BelongsTo
    {
        return $this->belongsTo(User::class, 'signer_id_3');
    }

    public function generatePdf()
    {
        $pdf = Pdf::loadView('members.certificates.pdf', [
            'record' => $this,
        ])->setPaper('letter');

        return $pdf;
    }
}
