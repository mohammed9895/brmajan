<?php

namespace App\Filament\Resources\ChallengeCategoryResource\Pages;

use App\Filament\Resources\ChallengeCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChallengeCategories extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = ChallengeCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
