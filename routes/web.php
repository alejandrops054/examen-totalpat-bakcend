<?php

use App\Livewire\Login;
use App\Livewire\Cards;
use App\Livewire\Dashboard;
use App\Livewire\PokemonForm;
use App\Livewire\UserForm;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', Cards::class)->name('home');
Route::get('/login', Login::class)->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/users/create', UserForm::class)->name('users.create');
    Route::get('/users/{id}/edit', UserForm::class)->name('users.edit');
    Route::get('/pokemons/create', PokemonForm::class)->name('pokemons.create');
    Route::get('/pokemons/{id}/edit', PokemonForm::class)->name('pokemons.edit');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
