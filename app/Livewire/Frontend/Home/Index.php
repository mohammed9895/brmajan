<?php

namespace App\Livewire\Frontend\Home;

use App\Enums\TeamType;
use App\Models\Challenge;
use App\Models\Team;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $companies_count = Team::where('type', TeamType::Company)->count();
        $indiviuals_count = Team::where('type', TeamType::Employees)->orWhere('type', TeamType::Student)->count();
        $challenges = Challenge::limit(3)->get();
        return view('livewire.frontend.home.index', [
            'challenges' => $challenges,
            'companies_count' => $companies_count,
            'indiviuals_count' => $indiviuals_count,
        ]);
    }
}
