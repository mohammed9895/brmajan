<?php

namespace App\Filament\Resources\ParticipantResource\Pages;

use App\Enums\ParticipantStatus;
use App\Filament\Resources\ParticipantResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewParticipant extends ViewRecord
{
    protected static string $resource = ParticipantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('approve')
                ->icon('heroicon-o-check-badge')
                ->color('success')
                ->action(function ($record) {
                       $record->status = ParticipantStatus::Approved;
                       $record->save();
                       Notification::make('saved')
                           ->success()
                           ->title('saved')
                            ->send();
                }),
            Actions\Action::make('reject')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->action(function ($record) {
                    $record->status = ParticipantStatus::Rejected;
                    $record->save();
                    Notification::make('saved')
                        ->success()
                        ->title('saved')
                        ->send();
                })
        ];
    }
}
