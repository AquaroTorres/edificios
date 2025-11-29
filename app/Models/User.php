<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Gender;
use App\Enums\MembershipStatus;
use App\Enums\RowPosition;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Auditable as Auditing;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable, FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use Auditing, HasFactory, Notifiable, SoftDeletes;

    public function minutes(): BelongsToMany
    {
        return $this->belongsToMany(Minute::class, 'minute_user')
            ->withPivot('attended')
            ->withTimestamps();
    }

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public function canAccessPanel(Panel $panel): bool
    {
        // return true;

        return $this->is_super_admin || $this->membership_status === MembershipStatus::Activo;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'run',
        'email',
        'password',
        'password_changed_at',
        'phone',
        'birth_date',
        'join_date',
        'position',
        'is_active',
        'is_admin',
        'is_super_admin',
        'membership_status',
        'user_type_id',
        'gender',
        'baptism',
        'initiation',
        'confirmation',
        'row_position',
        'address',
        'commune_id',
        'health_background',
        'photo_path',
        'social_networks',
        'annotations',
        'signature',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birth_date' => 'date',
            'join_date' => 'date',
            'is_active' => 'boolean',
            'is_admin' => 'boolean',
            'is_super_admin' => 'boolean',
            'monthly_fee' => 'decimal:2',
            'membership_status' => MembershipStatus::class,
            'gender' => Gender::class,
            'baptism' => 'boolean',
            'initiation' => 'boolean',
            'confirmation' => 'boolean',
            'row_position' => RowPosition::class,
            'social_networks' => 'array',
            'annotations' => 'array',
            'password_changed_at' => 'datetime',
        ];
    }

    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class);
    }

    public function userType(): BelongsTo
    {
        return $this->belongsTo(UserType::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function membershipFees(): HasMany
    {
        return $this->hasMany(MembershipFee::class);
    }

    public function itemAssignments(): HasMany
    {
        return $this->hasMany(ItemAssignment::class);
    }

    public function activeItemAssignments(): HasMany
    {
        return $this->hasMany(ItemAssignment::class)->whereNull('returned_at');
    }

    public function assignedItems(): HasMany
    {
        return $this->hasMany(ItemAssignment::class, 'assigned_by');
    }

    public function returnedItems(): HasMany
    {
        return $this->hasMany(ItemAssignment::class, 'returned_by');
    }

    public function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class);
    }

    public function createdMinutes(): HasMany
    {
        return $this->hasMany(Minute::class, 'created_by');
    }

    public function inscriptionPayment(): HasOne
    {
        return $this->hasOne(Income::class)
            ->whereHas('incomeType', fn ($q) => $q->where('id', 1))
            ->latest();
    }

    public function hasInscriptionPaid(): bool
    {
        return $this->inscriptionPayment()->exists();
    }

    public function age(): Attribute
    {
        return Attribute::make(
            get: fn (): ?int => $this->birth_date ? $this->birth_date->diffInYears(now()) : null
        );
    }

    protected function inscriptionPaid(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->hasInscriptionPaid()
        );
    }

    public function generatePdf()
    {
        $pdf = Pdf::loadView('members.users.pdf', [
            'record' => $this,
        ])->setPaper('letter');

        return $pdf;
    }

    // reset password
    public function resetPassword(string $opcion_password): string
    {
        $password = '';

        switch ($opcion_password) {
            case 'run':
                // Eliminar caracteres no numéricos y obtener el RUN sin el dígito verificador
                $runWithoutDV = preg_replace('/[^0-9]/', '', $this->run);
                $password = substr($runWithoutDV, 0, -1); // Remover el último dígito
                break;

            case 'random':
                // Generar una contraseña aleatoria de 8 caracteres
                $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
                break;

            default:
                throw new \InvalidArgumentException("Opción de contraseña no válida: {$opcion_password}");
        }

        // Encriptar y guardar la nueva contraseña
        $this->password = bcrypt($password);
        $this->password_changed_at = null;
        $this->save();

        return $password;
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    protected static function booted()
    {
        static::updated(function ($user) {
            if ($user->isDirty('password')) {
                $user->password_changed_at = now();
                $user->saveQuietly();
            }
        });
    }
}
