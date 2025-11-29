<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PaymentMechanism: string implements HasLabel
{
    case Transferencia = 'transferencia';
    case Efectivo = 'efectivo';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
