<div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-8 text-center">Panel de administración</h1>

    @if (session('status'))
        <div class="mb-6 text-green-600 text-center">
            {{ session('status') }}
        </div>
    @endif


    <div class="mb-12 bg-white rounded shadow p-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h2 class="text-lg font-semibold">Usuarios</h2>
            <button wire:click="createUser" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Registrar nuevo usuario</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2 text-right">
                                <button wire:click="editUser({{ $user->id }})" class="text-blue-600 hover:underline">Editar</button>
                                <button wire:click="deleteUser({{ $user->id }})" class="text-red-600 hover:underline ml-4">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <br/>
    <div class="bg-white rounded shadow p-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h2 class="text-lg font-semibold">Pokémon</h2>
            <a href="{{ route('pokemons.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Registrar nuevo Pokémon</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Categoría</th>
                        <th class="px-4 py-2 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pokemons as $pokemon)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $pokemon->nombre }}</td>
                            <td class="px-4 py-2">{{ $pokemon->categoria }}</td>
                            <td class="px-4 py-2 text-right">
                                <a href="{{ route('pokemons.edit', $pokemon->id) }}" class="text-blue-600 hover:underline">Editar</a>
                                <button wire:click="deletePokemon({{ $pokemon->id }})" class="text-red-600 hover:underline ml-4">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
