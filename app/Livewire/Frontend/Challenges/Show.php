<?php

namespace App\Livewire\Frontend\Challenges;

use App\Models\Challenge;
use App\Models\Participant;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;

class Show extends Component implements HasForms
{
    use InteractsWithForms;

    public Challenge $challenge;

    public ?array $data = [];

    public $participated = false;

    public $participated_count = 0;

    public function mount(Challenge $challenge)
    {
        // get partisipant count for the current challenge and team
        $this->participated_count = Participant::where('challenge_id', $challenge->id)
            ->count();
        $this->challenge = $challenge;
        if (auth()->check()) {
            $this->participated = Participant::where('challenge_id', $this->challenge->id)
                ->where('team_id', auth()->user()->team->id)
                ->exists();
        }
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            RichEditor::make('plan')->required(),
        ])
            ->statePath('data');
    }

    public function create()
    {
        $data = $this->form->getState();

        // check if here participant already exists
        $participantExists = Participant::where('challenge_id', $this->challenge->id)
            ->where('team_id', auth()->user()->team->id)
            ->exists();

        // check if he have team
        if (!auth()->user()->team) {
            Notification::make()
                ->title(__('hackathon.messages.team_required'))
                ->danger()
                ->send();
            return;
        }

        if ($participantExists) {
            Notification::make()
                ->title(__('hackathon.messages.already_participated'))
                ->danger()
                ->send();
            return;
        }
        // check if he alerdy participated on 3 challenges
        $participatedCount = Participant::where('team_id', auth()->user()->team->id)
            ->count();
        if ($participatedCount >= 3) {
            Notification::make()
                ->title(__('hackathon.messages.max_participation'))
                ->danger()
                ->send();
            return;
        }
        // create participant
        Participant::create([
            'challenge_id' => $this->challenge->id,
            'team_id' => auth()->user()->team->id,
            'plan' => $data['plan'],
        ]);

        Notification::make()
            ->title(__('hackathon.messages.success'))
            ->success()
            ->send();
    }

    public function render()
    {
        return view('livewire.frontend.challenges.show');
    }
}
