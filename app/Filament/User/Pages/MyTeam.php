<?php

namespace App\Filament\User\Pages;

use App\Enums\AttendanceType;
use App\Enums\TeamType;
use App\Models\Province;
use App\Models\Team;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class MyTeam extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.user.pages.my-team';

    use InteractsWithForms;

    public ?array $data = [];

    public Team $team;


    public function mount()
    {
        $this->team = Team::where('user_id', auth()->id())->first();
        $this->form->fill($this->team->toArray());
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make(__('hackathon.onboarding.steps.rules'))
                        ->icon('hugeicons-check-list')
                        ->schema([
                            View::make('filament.resources.team-resource.rules')
                                ->columnSpanFull(),
                        ]),
                    Step::make(__('hackathon.onboarding.steps.team_building'))
                        ->icon('hugeicons-tools')
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->label(__('hackathon.onboarding.fields.name'))
                                ->maxLength(255),
                            Select::make('number_of_members')
                                ->required()
                                ->label(__('hackathon.onboarding.fields.number_of_members'))
                                ->searchable()
                                ->options([
                                    3 => '3',
                                    4 => '4',
                                    5 => '5',
                                ]),
                            Select::make('type')
                                ->label(__('hackathon.onboarding.fields.type'))
                                ->options(TeamType::class)
                                ->searchable()
                                ->required(),
                            RichEditor::make('features')
                                ->label(__('hackathon.onboarding.fields.features'))
                                ->columnSpanFull(),
                            RichEditor::make('registration_reason')
                                ->label(__('hackathon.onboarding.fields.registration_reason'))
                                ->columnSpanFull(),
                        ]),
                    Step::make(__('hackathon.onboarding.steps.team_leader'))
                        ->icon('hugeicons-user-star-02')
                        ->schema([
                            TextInput::make('leader_name')
                                ->label(__('hackathon.onboarding.fields.leader_name'))
                                ->required()
                                ->maxLength(255),
                            TextInput::make('leader_civil_id')
                                ->label(__('hackathon.onboarding.fields.leader_civil_id'))
                                ->required()
                                ->maxLength(255),
                            TextInput::make('leader_phone')
                                ->label(__('hackathon.onboarding.fields.leader_phone'))
                                ->tel()
                                ->required()
                                ->maxLength(255),
                            TextInput::make('leader_email')
                                ->label(__('hackathon.onboarding.fields.leader_email'))
                                ->email()
                                ->required()
                                ->maxLength(255),
                            TextInput::make('leader_position')
                                ->label(__('hackathon.onboarding.fields.leader_position'))
                                ->maxLength(255),
                            TextInput::make('leader_company')
                                ->label(__('hackathon.onboarding.fields.leader_company'))
                                ->maxLength(255),
                            Select::make('province')
                                ->label(__('hackathon.onboarding.fields.province'))
                                ->required()
                                ->searchable()
                                ->live()
                                ->dehydrated(false)
                                ->options(Province::all()->pluck('name', 'id')),
                            Select::make('leader_region')
                                ->label(__('hackathon.onboarding.fields.leader_region'))
                                ->searchable()
                                ->options(function (Get $get) {
                                    $provinceId = $get('province');
                                    return Province::where('id', $provinceId)
                                        ->first()
                                        ?->states()
                                        ->pluck('name', 'id')
                                        ->toArray();
                                })
                                ->required(),
                        ]),
                    Step::make(__('hackathon.onboarding.steps.team_members'))
                        ->icon('hugeicons-user-group')
                        ->schema([
                            Repeater::make('members')
                                ->relationship()
                                ->schema([
                                    TextInput::make('full_name')
                                        ->required()
                                        ->label(__('hackathon.onboarding.fields.full_name'))
                                        ->maxLength(255),
                                    TextInput::make('civil_id')
                                        ->required()
                                        ->label(__('hackathon.onboarding.fields.civil_id'))
                                        ->maxLength(255),
                                    Select::make('province')
                                        ->required()
                                        ->searchable()
                                        ->label(__('hackathon.onboarding.fields.province'))
                                        ->live()
                                        ->dehydrated(false)
                                        ->options(Province::all()->pluck('name', 'id')),
                                    Select::make('current_residence')
                                        ->label(__('hackathon.onboarding.fields.current_residence'))
                                        ->searchable()
                                        ->options(function (Get $get) {
                                            $provinceId = $get('province');
                                            return Province::where('id', $provinceId)
                                                ->first()
                                                ?->states()
                                                ->pluck('name', 'id')
                                                ->toArray();
                                        })
                                        ->required(),
                                    TextInput::make('position_in_team')
                                        ->required()
                                        ->label(__('hackathon.onboarding.fields.position_in_team'))
                                        ->maxLength(255),
                                    Select::make('skills')
                                        ->relationship('skills', 'name')
                                        ->multiple()
                                        ->preload()
                                        ->label(__('hackathon.onboarding.fields.skills'))
                                        ->searchable(),
                                    Select::make('attendance_ability')
                                        ->required()
                                        ->label(__('hackathon.onboarding.fields.attendance_ability'))
                                        ->options(AttendanceType::class)->searchable(),
                                ])->columns(2)
                        ]),
                    Step::make(__('hackathon.onboarding.steps.team_experience'))
                        ->icon('hugeicons-work-history')
                        ->schema([
                            TextInput::make('profile')
                                ->label(__('hackathon.onboarding.fields.profile'))
                                ->maxLength(255),
                            FileUpload::make('profile_intro_file')
                                ->label(__('hackathon.onboarding.fields.profile_intro_file'))
                                ->acceptedFileTypes(['application/pdf']),
                        ]),
                    Step::make(__('hackathon.onboarding.steps.team_declaration'))
                        ->icon('hugeicons-hand-prayer')
                        ->schema([
                            View::make('filament.resources.team-resource.declaration')
                                ->columnSpanFull(),
                            FileUpload::make('declaration_file')
                                ->required()
                                ->label(__('hackathon.onboarding.fields.declaration_file'))
                                ->maxSize(1024 * 5) // 5MB
                                ->acceptedFileTypes(['application/pdf'])
                                ->columnSpanFull(),
                        ]),
                ])
                    ->skippable()
                    ->columnSpanFull()
                    ->submitAction(new HtmlString(Blade::render(<<<BLADE
                    <x-filament::button
                        type="submit"
                        size="sm"
                    >
                        Submit
                    </x-filament::button>
                BLADE))),
            ])
            ->model($this->team)
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $user = auth()->user();

        // Create or update the user's club
        $user->team()->updateOrCreate(
            ['user_id' => $user->id], // Match by user ID
            $data // Fillable fields from form
        );

        Notification::make()->title('Club Updated Successfully')
            ->body('Your Team information has been updated successfully.')
            ->icon('heroicon-o-check-circle')
            ->iconColor('success')
            ->color('success')
            ->send();

    }
}
