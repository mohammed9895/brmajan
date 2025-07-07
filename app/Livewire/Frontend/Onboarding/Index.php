<?php

namespace App\Livewire\Frontend\Onboarding;

use App\Enums\AttendanceType;
use App\Enums\TeamType;
use App\Models\Province;
use App\Models\Team;
use App\Models\User;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Get;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount()
    {
        $this->form->fill();
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Rules')
                        ->icon('hugeicons-check-list')
                        ->schema([
                            View::make('filament.resources.team-resource.rules')
                                ->columnSpanFull(),
                        ]),
                    Step::make('Team Building')
                        ->icon('hugeicons-tools')
                        ->schema([
                            Select::make('user_id')
                                ->relationship('user', 'name')
                                ->searchable()
                                ->getSearchResultsUsing(fn (string $search): array => User::where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%")->limit(50)->pluck('name', 'id')->toArray())
                                ->preload()
                                ->required(),
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            Select::make('number_of_members')
                                ->required()
                                ->searchable()
                                ->options([
                                    3 => '3',
                                    4 => '4',
                                    5 => '5',
                                ]),
                            Select::make('type')
                                ->options(TeamType::class)
                                ->searchable()
                                ->required(),
                            RichEditor::make('features')
                                ->columnSpanFull(),
                            RichEditor::make('registration_reason')
                                ->columnSpanFull(),
                        ]),
                    Step::make('Team Leader')
                        ->icon('hugeicons-user-star-02')
                        ->schema([
                            TextInput::make('leader_name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('leader_civil_id')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('leader_phone')
                                ->tel()
                                ->required()
                                ->maxLength(255),
                            TextInput::make('leader_email')
                                ->email()
                                ->required()
                                ->maxLength(255),
                            TextInput::make('leader_position')
                                ->maxLength(255),
                            TextInput::make('leader_company')
                                ->maxLength(255),
                            Select::make('province')
                                ->required()
                                ->searchable()
                                ->live()
                                ->dehydrated(false)
                                ->options(Province::all()->pluck('name', 'id')),
                            Select::make('leader_region')
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
                    Step::make('Team Members')
                        ->icon('hugeicons-user-group')
                        ->schema([
                            Repeater::make('members')
                                ->relationship()
                                ->schema([
                                    TextInput::make('full_name')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('civil_id')
                                        ->required()
                                        ->maxLength(255),
                                    Select::make('province')
                                        ->required()
                                        ->searchable()
                                        ->live()
                                        ->dehydrated(false)
                                        ->options(Province::all()->pluck('name', 'id')),
                                    Select::make('current_residence')
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
                                        ->maxLength(255),
                                    Select::make('skills')
                                        ->relationship('skills', 'name')
                                        ->multiple()
                                        ->preload()
                                        ->searchable(),
                                    Select::make('attendance_ability')
                                        ->required()
                                        ->options(AttendanceType::class)->searchable(),
                                ])->columns(2)
                        ]),
                    Step::make('Team Experience')
                        ->icon('hugeicons-work-history')
                        ->schema([
                            TextInput::make('profile')
                                ->maxLength(255),
                            FileUpload::make('profile_intro_file')
                                ->acceptedFileTypes(['application/pdf']),
                        ]),
                    Wizard\Step::make('Team Declaration')
                        ->icon('hugeicons-hand-prayer')
                        ->schema([
                            View::make('filament.resources.team-resource.declaration')
                                ->columnSpanFull(),
                            FileUpload::make('declaration_file')
                                ->required()
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
            ->model(Team::class)
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


        // assign the user to the club
        $user->assignRole('team');

        redirect()->route('filament.club.pages.dashboard'); // Change route as needed
    }
    #[Layout('components.layouts.onboarding')]
    public function render()
    {
        return view('livewire.frontend.onboarding.index');
    }
}
