<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AttendanceType: int implements HasLabel
{
    case Partially = 1;
    case Fully = 2;
    public function getLabel(): ?string
    {
        return match ($this) {
            self::Partially => 'Partially',
            self::Fully => 'Fully',
        };
    }
}
