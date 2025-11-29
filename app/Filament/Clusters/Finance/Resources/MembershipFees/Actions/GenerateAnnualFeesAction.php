<?php

namespace App\Filament\Clusters\Finance\Resources\MembershipFees\Actions;

use App\Enums\MembershipFeeStatus;
use App\Models\MembershipFee;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class GenerateAnnualFeesAction extends Action
{
    public static function make(?string $name = null): static
    {
        return parent::make($name)
            ->label('Generar cuotas anuales')
            ->action(fn (array $data) => static::handle($data))
            ->requiresConfirmation()
            ->form([
                Select::make('year')
                    ->label('Año')
                    ->required()
                    ->options([
                        now()->year => now()->year,
                        now()->year + 1 => now()->year + 1,
                        now()->year + 2 => now()->year + 2,
                    ])
                    ->default(now()->year),
            ]);
    }

    public static function handle(array $data): void
    {
        $year = $data['year'];

        // Obtener los meses configurados para pago de cuotas
        $monthsWithFees = db_config('system.months_with_fees');
        if (empty($monthsWithFees)) {
            Notification::make()
                ->title('Cuotas generadas')
                ->body('Falta configurar los meses para la generación de cuotas.')
                ->danger()
                ->send();

            return; // No hay meses configurados
        }

        // Convertir string "4,6" a array de enteros [4, 6]
        $months = array_map('intval', explode(',', $monthsWithFees));

        // Crear períodos dinámicamente
        $periods = [];
        foreach ($months as $month) {
            $periods[$month] = Carbon::create($year, $month)->endOfMonth();
        }

        $users = User::where('is_super_admin', false)
            ->where('membership_status', 'activo')
            ->get();

        DB::transaction(function () use ($users, $year, $periods) {
            foreach ($users as $user) {
                $fee = $user->userType?->fee ?? 0;
                foreach ($periods as $period => $dueDate) {
                    // Si la fecha de ingreso es posterior al vencimiento, no crear cuota
                    if ($user->join_date && $user->join_date->gt($dueDate)) {
                        continue;
                    }

                    // Si ya existe la cuota para ese usuario, periodo y año, no crear
                    $exists = MembershipFee::where('user_id', $user->id)
                        ->where('year', $year)
                        ->where('period', $period)
                        ->exists();
                    if ($exists) {
                        continue;
                    }

                    MembershipFee::create([
                        'user_id' => $user->id,
                        'year' => $year,
                        'period' => $period,
                        'amount' => $fee,
                        'paid_amount' => 0,
                        'due_at' => $dueDate,
                        'income_type_id' => 2, // "Membership Fees"
                        'status' => MembershipFeeStatus::Pendiente,
                    ]);
                }
            }
        });

        Notification::make()
            ->title('Cuotas generadas')
            ->body("Se han creado cuotas para {$users->count()} usuarios.")
            ->success()
            ->send();
    }
}
