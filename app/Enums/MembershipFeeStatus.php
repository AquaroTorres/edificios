<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum MembershipFeeStatus: string implements HasColor, HasLabel
{
    case Pendiente = 'pendiente';
    case Parcial = 'parcial';
    case Pagado = 'pagado';
    case Vencido = 'vencido';

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Pendiente => 'warning',
            self::Parcial => 'primary',
            self::Pagado => 'success',
            self::Vencido => 'danger',
        };
    }
}
