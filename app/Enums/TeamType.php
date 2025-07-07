<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TeamType: int implements HasLabel
{
    case Student = 1;
    case Employees = 2;
    case Company = 3;
    public function getLabel(): ?string
    {
        return match ($this) {
            self::Student => 'Student',
            self::Employees => 'Employees',
            self::Company => 'Company',
        };
    }
}
