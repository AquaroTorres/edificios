<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\MembershipStatus;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Auditable as Auditing;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable, FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use Auditing, HasFactory, Notifiable, SoftDeletes;

    public function canAccessPanel(Panel $panel): bool
    {
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
        'join_date',
        'position',
        'is_active',
        'is_admin',
        'is_super_admin',
        'membership_status',
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
            'membership_status' => MembershipStatus::class,
            'password_changed_at' => 'datetime',
        ];
    }

    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class);
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
