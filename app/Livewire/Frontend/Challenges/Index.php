<?php

namespace App\Livewire\Frontend\Challenges;

use App\Models\Challenge;
use App\Models\ChallengeCategory;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public $category;


    public function mount($category = null)
    {
        $this->category = $category;
    }

    public function setCategory($value)
    {
        $this->category = $value;
    }

    #[Computed]
    public function challenges()
    {
        if ($this->category) {
            return Challenge::where('challenge_category_id', $this->category)->get();
        }
        return Challenge::all();
    }
    public function render()
    {
        $challenge_categories = ChallengeCategory::all();
        return view('livewire.frontend.challenges.index', [
            'challenge_categories' => $challenge_categories,
        ]);
    }
}
