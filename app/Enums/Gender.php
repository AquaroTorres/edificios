<?php

namespace App\Enums;

enum Gender: string
{
    case Masculino = 'masculino';
    case Femenino = 'femenino';

    public function getLabel(): string
    {
        return $this->name;
    }
}
