<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::get('tarjetas', [PokemonController::class, 'cards']);

Route::middleware(['jwt'])->get('validar-token', [AuthController::class, 'validarToken']);

Route::middleware(['jwt'])->group(function () {
    Route::apiResource('pokemons', PokemonController::class);
});
