<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Challenge;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $challenges = Challenge::limit(3)->get();
        return view('livewire.frontend.home.index', [
            'challenges' => $challenges,
        ]);
    }
}
