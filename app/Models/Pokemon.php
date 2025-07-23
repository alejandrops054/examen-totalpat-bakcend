<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = 'pokemons';
    protected $fillable = ['nombre', 'color', 'atributos', 'categoria', 'imagen'];
}

