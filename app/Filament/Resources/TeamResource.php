<?php

namespace App\Filament\Resources;

use App\Enums\AttendanceType;
use App\Enums\TeamType;
use App\Filament\Resources\TeamResource\Pages;
use App\Filament\Resources\TeamResource\RelationManagers;
use App\Models\Province;
use App\Models\State;
use App\Models\Team;
use App\Models\User;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Rules')
                        ->icon('hugeicons-check-list')
                        ->schema([
                        Forms\Components\View::make('filament.resources.team-resource.rules')
                            ->columnSpanFull(),
                    ]),
                    Forms\Components\Wizard\Step::make('Team Building')
                        ->icon('hugeicons-tools')
                        ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->getSearchResultsUsing(fn (string $search): array => User::where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%")->limit(50)->pluck('name', 'id')->toArray())
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('number_of_members')
                            ->required()
                            ->searchable()
                            ->options([
                                3 => '3',
                                4 => '4',
                                5 => '5',
                            ]),
                        Forms\Components\Select::make('type')
                            ->options(TeamType::class)
                            ->searchable()
                            ->required(),
                        Forms\Components\RichEditor::make('features')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('registration_reason')
                            ->columnSpanFull(),
                    ]),
                    Forms\Components\Wizard\Step::make('Team Leader')
                        ->icon('hugeicons-user-star-02')
                        ->schema([
                        Forms\Components\TextInput::make('leader_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('leader_civil_id')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('leader_phone')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('leader_email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('leader_position')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('leader_company')
                            ->maxLength(255),
                            Forms\Components\Select::make('province')
                                ->required()
                                ->searchable()
                                ->live()
                                ->dehydrated(false)
                                ->options(Province::all()->pluck('name', 'id')),
                            Forms\Components\Select::make('leader_region')
                                ->searchable()
                                ->options(function (Forms\Get $get) {
                                    $provinceId = $get('province');
                                    return Province::where('id', $provinceId)
                                        ->first()
                                        ?->states()
                                        ->pluck('name', 'id')
                                        ->toArray();
                                })
                                ->required(),
                    ]),
                    Forms\Components\Wizard\Step::make('Team Members')
                        ->icon('hugeicons-user-group')
                        ->schema([
                        Forms\Components\Repeater::make('members')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('full_name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('civil_id')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Select::make('province')
                                    ->required()
                                    ->searchable()
                                    ->live()
                                    ->dehydrated(false)
                                    ->options(Province::all()->pluck('name', 'id')),
                                Forms\Components\Select::make('current_residence')
                                    ->searchable()
                                    ->options(function (Forms\Get $get) {
                                        $provinceId = $get('province');
                                        return Province::where('id', $provinceId)
                                            ->first()
                                            ?->states()
                                            ->pluck('name', 'id')
                                            ->toArray();
                                    })
                                    ->required(),
                                Forms\Components\TextInput::make('position_in_team')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Select::make('skills')
                                    ->relationship('skills', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable(),
                                Forms\Components\Select::make('attendance_ability')
                                    ->required()
                                    ->options(AttendanceType::class)->searchable(),
                            ])->columns(2)
                    ]),
                    Forms\Components\Wizard\Step::make('Team Experience')
                        ->icon('hugeicons-work-history')
                        ->schema([
                        Forms\Components\TextInput::make('profile')
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('profile_intro_file')
                            ->acceptedFileTypes(['application/pdf']),
                    ]),
                    Forms\Components\Wizard\Step::make('Team Declaration')
                        ->icon('hugeicons-hand-prayer')
                        ->schema([
                            Forms\Components\View::make('filament.resources.team-resource.declaration')
                                ->columnSpanFull(),
                        Forms\Components\FileUpload::make('declaration_file')
                            ->required()
                            ->maxSize(1024 * 5) // 5MB
                            ->acceptedFileTypes(['application/pdf'])
                            ->columnSpanFull(),
                    ]),
                ])
                    ->skippable()
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Team Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('number_of_members')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Team Information')
                ->schema([
                    TextEntry::make('name')
                        ->label('Team Name'),
                    TextEntry::make('user.name')
                        ->label('Team Leader'),
                    TextEntry::make('type')
                        ->badge(),
                    TextEntry::make('number_of_members')
                        ->badge()
                        ->numeric(),
                    TextEntry::make('profile')
                        ->url(fn ($state) => $state ? $state : null)
                        ->icon('heroicon-o-globe-alt')
                        ->label('Profile Link'),
                    TextEntry::make('profile_intro_file')
                        ->url(fn ($state) => $state ? asset('storage/' . $state) : null)
                        ->icon('heroicon-o-arrow-down-tray')
                        ->label('Profile Intro File'),
                    TextEntry::make('declaration_file')
                        ->url(fn ($state) => $state ? asset('storage/' . $state) : null)
                        ->icon('heroicon-o-arrow-down-tray')
                        ->label('Declaration File'),
                    TextEntry::make('created_at')
                        ->dateTime()
                        ->label('Created At'),
                    TextEntry::make('updated_at')
                        ->dateTime()
                        ->label('Updated At'),
                ])->columns(2),
            Section::make('Team Features')
                ->schema([
                    TextEntry::make('features')
                        ->markdown()
                        ->label('Features'),
                ]),
            Section::make('Registration Reason')
                ->schema([
                    TextEntry::make('registration_reason')
                        ->markdown()
                        ->label('Reason for Registration'),
                ]),
            Section::make('Team Leader Information')
                ->schema([
                    TextEntry::make('leader_name')
                        ->label('Name'),
                    TextEntry::make('leader_civil_id')
                        ->label('Civil ID'),
                    TextEntry::make('leader_phone')
                        ->url(fn ($state) => 'tel:' . $state)
                        ->icon('heroicon-o-phone')
                        ->label('Phone'),
                    TextEntry::make('leader_email')
                        ->url(fn($state) => 'mailto:' . $state)
                        ->icon('heroicon-o-envelope')
                        ->label('Email'),
                    TextEntry::make('leader_position')
                        ->label('Position'),
                    TextEntry::make('leader_company')
                        ->label('Company'),
                    TextEntry::make('leader_region')
                        ->formatStateUsing(fn ($state) => State::find($state)?->name)
                        ->badge()
                        ->label('Region'),
                ])->columns(3),
            Section::make('Team Members')
                ->schema([
                    RepeatableEntry::make('members')
                        ->schema([
                            TextEntry::make('full_name')
                                ->label('Full Name'),
                            TextEntry::make('civil_id')
                                ->label('Civil ID'),
                            TextEntry::make('current_residence')
                                ->formatStateUsing(fn ($state) => State::find($state)?->name)
                                ->badge()
                                ->label('Current Residence'),
                            TextEntry::make('position_in_team')
                                ->label('Position in Team'),
                            TextEntry::make('attendance_ability')
                                ->badge()
                                ->label('Attendance Ability'),
                            TextEntry::make('skills')
                                ->formatStateUsing(fn ($state) => $state->name)
                                ->badge()
                                ->label('Skills'),
                        ])->columns(2)->grid(2),
                ]),
        ]); // TODO: Change the autogenerated stub
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
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
            'view' => Pages\ViewTeam::route('/{record}'),
        ];
    }
}
