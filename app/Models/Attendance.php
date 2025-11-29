<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as Auditing;
use OwenIt\Auditing\Contracts\Auditable;

class Attendance extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\AttendanceFactory> */
    use Auditing, HasFactory, SoftDeletes;

    protected $fillable = [
        'date',
        'subject',
        'created_by',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function attendees(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'attendance_user')
            ->withPivot('attended')
            ->withTimestamps()
            ->orderBy('name');
    }

    protected static function booted()
    {
        // boot on creating asign authenticated user id to created_by
        static::creating(function ($attendance) {
            if (auth()->check()) {
                $attendance->created_by = auth()->id();
            }
        });

        // After creating, attach all active non-admin users as not attended
        static::created(function ($attendance) {
            $allUsers = User::where('membership_status', 'activo')
                ->where('is_super_admin', false)
                ->pluck('id')
                ->all();
            $attendance->attendees()->syncWithoutDetaching(
                collect($allUsers)->mapWithKeys(fn ($id) => [$id => ['attended' => false]])->toArray()
            );
        });

        // al borrar la asistencia borrar los registros de la pivote (soft delete)
        static::deleted(function ($attendance) {
            $attendance->attendees()->detach();
        });

        // al forzar borrado borrar los registros de la pivote (force delete)
        static::forceDeleted(function ($attendance) {
            $attendance->attendees()->detach();
        });
    }
}
