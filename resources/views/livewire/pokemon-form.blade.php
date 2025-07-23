<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h1 class="text-xl font-bold mb-4">{{ $pokemonId ? 'Editar' : 'Registrar' }} Pokémon</h1>

    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div class="mb-4">
            <label>Nombre</label>
            <input type="text" wire:model="nombre" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Color</label>
            <input type="text" wire:model="color" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Atributos</label>
            <textarea wire:model="atributos" class="w-full border p-2 rounded"></textarea>
        </div>

        <div class="mb-4">
            <label>Categoría</label>
            <input type="text" wire:model="categoria" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Imagen</label>
            <input type="file" wire:model="imagen" class="w-full border p-2 rounded">
            @if ($imagen_actual)
                <img src="{{ asset('storage/' . $imagen_actual) }}" class="h-32 mt-2">
            @endif
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            {{ $pokemonId ? 'Actualizar' : 'Guardar' }}
        </button>
    </form>
</div>
