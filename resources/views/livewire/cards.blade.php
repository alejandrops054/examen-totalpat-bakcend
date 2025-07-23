<div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
    @foreach ($pokemons as $pokemon)
        <div class="bg-white shadow rounded p-4 text-center">
            <img src="{{ asset('storage/' . $pokemon->imagen) }}" alt="{{ $pokemon->nombre }}" class="w-full h-40 object-cover rounded">
            <h2 class="text-xl font-bold mt-2">{{ $pokemon->nombre }}</h2>
            <p class="text-sm text-gray-600">{{ $pokemon->categoria }}</p>
            <p class="text-sm mt-2">Color: {{ $pokemon->color }}</p>
            <p class="text-sm mt-1">{{ $pokemon->atributos }}</p>
        </div>
    @endforeach
</div>