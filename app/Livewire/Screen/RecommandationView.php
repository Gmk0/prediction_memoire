<?php

namespace App\Livewire\Screen;

use Livewire\Component;

class RecommandationView extends Component
{
    public function render()
    {
        return view('livewire.screen.recommandation-view', ['recomandations'=>\App\Models\Recommandation::all()]);
    }
}
