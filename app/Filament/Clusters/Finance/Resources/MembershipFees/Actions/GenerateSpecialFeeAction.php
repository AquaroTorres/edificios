<?php

namespace App\Filament\Clusters\Finance\Resources\MembershipFees\Actions;

use App\Enums\MembershipFeeStatus;
use App\Enums\MembershipStatus;
use App\Models\MembershipFee;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
use Illuminate\Support\Facades\DB;

class GenerateSpecialFeeAction extends Action
{
    public static function make(?string $name = null): static
    {
        return parent::make($name)
            ->label('Generar cuota especial')
            ->modalHeading('Crear cuota especial')
            ->form([
                Grid::make(3)->schema([
                    Select::make('income_type_id')
                        ->label('Tipo de ingreso')
                        ->relationship('incomeType', 'name')
                        ->required(),
                    TextInput::make('concept')
                        ->label('Concepto')
                        ->required(),
                    TextInput::make('amount')
                        ->label('Monto')
                        ->numeric()
                        ->minValue(1)
                        ->required(),
                    TextInput::make('year')
                        ->label('Año')
                        ->default(date('Y'))
                        ->required(),
                    DatePicker::make('due_at')
                        ->label('Fecha de vencimiento')
                        ->required(),
                    Select::make('users')
                        ->label('Usuarios')
                        ->multiple()
                        ->searchable()
                        ->options(
                            User::where('is_super_admin', false)
                                ->where('membership_status', MembershipStatus::Activo)
                                ->orderBy('name')
                                ->pluck('name', 'id')
                        )
                        ->helperText('Deja vacío para aplicar a todos los usuarios activos')
                        ->columnSpanFull(),
                ]),
            ])
            ->action(function (array $data) {
                // Si se seleccionaron usuarios específicos, usar esos; si no, usar todos los activos
                if (! empty($data['users'])) {
                    $users = User::whereIn('id', $data['users'])->get();
                } else {
                    $users = User::where('is_super_admin', false)
                        ->where('membership_status', MembershipStatus::Activo)
                        ->get();
                }

                DB::transaction(function () use ($users, $data) {
                    foreach ($users as $user) {
                        MembershipFee::create([
                            'user_id' => $user->id,
                            'concept' => $data['concept'],
                            'amount' => $data['amount'],
                            'year' => $data['year'],
                            'period' => 0,
                            'due_at' => $data['due_at'],
                            'income_type_id' => $data['income_type_id'],
                            'paid_amount' => 0,
                            'status' => MembershipFeeStatus::Pendiente,
                        ]);
                    }
                });

                Notification::make()
                    ->title('Cuotas generadas')
                    ->body("Se han creado cuotas para {$users->count()} usuarios.")
                    ->success()
                    ->send();
            });
    }
}
