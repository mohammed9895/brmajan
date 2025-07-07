<?php

namespace App\Filament\Resources\ChallengeResource\Pages;

use App\Filament\Resources\ChallengeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChallenges extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = ChallengeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
