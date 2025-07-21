<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function index()
    {
        return Pokemon::all();
    }

    public function cards(Request $request)
    {
        $paginated = Pokemon::paginate(10);

        return response()->json($paginated);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'color' => 'nullable|string',
            'atributos' => 'nullable|array',
            'categoria' => 'nullable|string',
            'imagen' => 'nullable|image',
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $this->resizeAndStoreImage($request->file('imagen'));
        }

        try {
            $pokemon = Pokemon::create($data);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'No se pudo guardar el pokémon',
            ], 500);
        }

        return response()->json([
            'message' => 'Pokémon guardado correctamente',
            'pokemon' => $pokemon,
        ], 201);
    }

    public function show(Pokemon $pokemon)
    {
        return $pokemon;
    }

    public function update(Request $request, Pokemon $pokemon)
    {
        $data = $request->validate([
            'nombre' => 'sometimes|string',
            'color' => 'nullable|string',
            'atributos' => 'nullable|array',
            'categoria' => 'nullable|string',
            'imagen' => 'nullable|image',
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $this->resizeAndStoreImage($request->file('imagen'));
        }

        $pokemon->update($data);

        return $pokemon;
    }

    public function destroy(Pokemon $pokemon)
    {
        $pokemon->delete();
        return response()->noContent();
    }

    private function resizeAndStoreImage($file): string
    {
        $imageData = file_get_contents($file->getRealPath());
        $image = imagecreatefromstring($imageData);
        if (!$image) {
            throw new \RuntimeException('Invalid image');
        }
        $width = imagesx($image);
        $height = imagesy($image);
        $newWidth = 300;
        $newHeight = (int) (($newWidth / $width) * $height);
        $resized = imagescale($image, $newWidth, $newHeight);
        $filename = uniqid('pokemon_') . '.jpg';
        $path = 'public/pokemons/' . $filename;
        if (!is_dir('public/pokemons')) {
            mkdir('public/pokemons', 0777, true);
        }
        imagejpeg($resized, $path, 85);
        imagedestroy($image);
        imagedestroy($resized);
        return $path;
    }
}
