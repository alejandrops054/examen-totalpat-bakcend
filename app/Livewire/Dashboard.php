<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pokemon;
use App\Models\User;

class Dashboard extends Component
{

    public function deletePokemon($id)
    {
        Pokemon::findOrFail($id)->delete();
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
    }

    public function createUser()
    {
        return $this->redirectRoute('users.create');
    }

    public function editUser($id)
    {
        return $this->redirectRoute('users.edit', ['id' => $id]);
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'users' => User::all(),
            'pokemons' => Pokemon::all(),
        ])->layout('layouts.app');
    }
}
