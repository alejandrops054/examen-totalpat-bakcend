<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserForm extends Component
{
    public $userId;
    public $name;
    public $email;
    public $password;

    public function mount($id = null)
    {
        $this->userId = $id;

        if ($this->userId) {
            $user = User::findOrFail($this->userId);
            $this->name = $user->name;
            $this->email = $user->email;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->userId,
            'password' => $this->userId ? 'nullable|min:6' : 'required|min:6',
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        User::updateOrCreate(['id' => $this->userId], $data);

        session()->flash('status', $this->userId ? 'Usuario actualizado.' : 'Usuario creado.');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.user-form')->layout('layouts.app');
    }
}
