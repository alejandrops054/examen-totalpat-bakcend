<?php

namespace Database\Factories;

use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PokemonFactory extends Factory
{
    protected $model = Pokemon::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word,
            'color' => $this->faker->safeColorName(),
            'atributos' => ['vida' => $this->faker->numberBetween(1, 100)],
            'categoria' => $this->faker->word,
            'imagen' => null,
        ];
    }
}
