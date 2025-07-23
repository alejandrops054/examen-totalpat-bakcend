<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pokemon;

class Cards extends Component
{
    public function render()
    {
        return view('livewire.cards', [
            'pokemons' => Pokemon::all()
        ])->layout('layouts.public'); 
    }
}
