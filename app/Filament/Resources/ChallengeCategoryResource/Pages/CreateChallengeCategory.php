<?php

namespace App\Filament\Resources\ChallengeCategoryResource\Pages;

use App\Filament\Resources\ChallengeCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateChallengeCategory extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = ChallengeCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
