<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pokemon;
use Livewire\WithFileUploads;

class PokemonForm extends Component
{
    use WithFileUploads;

    public $pokemonId;
    public $nombre;
    public $color;
    public $atributos;
    public $categoria;
    public $imagen;
    public $imagen_actual;

    public function mount($id = null)
    {
        if ($id) {
            $pokemon = Pokemon::findOrFail($id);
            $this->pokemonId = $pokemon->id;
            $this->nombre = $pokemon->nombre;
            $this->color = $pokemon->color;
            $this->atributos = $pokemon->atributos;
            $this->categoria = $pokemon->categoria;
            $this->imagen_actual = $pokemon->imagen;
        }
    }

    public function save()
    {
        $this->validate([
            'nombre' => 'required|string|max:255|unique:pokemons,nombre,' . $this->pokemonId,
            'color' => 'required|string|max:100',
            'atributos' => 'nullable|string',
            'categoria' => 'required|string|max:100',
            'imagen' => $this->pokemonId ? 'nullable|image|max:1024' : 'required|image|max:1024',
        ]);

        $path = $this->imagen ? $this->imagen->store('pokemons', 'public') : $this->imagen_actual;

        Pokemon::updateOrCreate(
            ['id' => $this->pokemonId],
            [
                'nombre' => $this->nombre,
                'color' => $this->color,
                'atributos' => $this->atributos,
                'categoria' => $this->categoria,
                'imagen' => $path
            ]
        );

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.pokemon-form')->layout('layouts.app');
    }
}
