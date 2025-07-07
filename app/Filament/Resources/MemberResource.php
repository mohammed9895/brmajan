<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('team_id')
                    ->required()
                    ->searchable()
                    ->getSearchResultsUsing(function (string $search) {
                        return \App\Models\Team::where('name', 'like', "%{$search}%")
                            ->orWhere('id', 'like', "%{$search}%")
                            ->pluck('name', 'id');
                    })
                    ->relationship('team', 'name'),
                Forms\Components\TextInput::make('full_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('civil_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('current_residence')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('position_in_team')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('attendance_ability')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('team.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('civil_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('current_residence')
                    ->formatStateUsing(fn($state) => State::find($state)->name ?? $state)
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('position_in_team')
                    ->searchable(),
                Tables\Columns\TextColumn::make('attendance_ability')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('team_id')
                    ->relationship('team', 'name')
                    ->preload()
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
