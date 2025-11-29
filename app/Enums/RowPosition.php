<?php

namespace App\Enums;

enum RowPosition: string
{
    case Derecha = 'derecha';
    case Izquierda = 'izquierda';

    public function getLabel(): string
    {
        return $this->name;
    }
}
