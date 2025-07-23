<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h1 class="text-xl font-bold mb-4">{{ $userId ? 'Editar Usuario' : 'Registrar Usuario' }}</h1>

    <form wire:submit.prevent="save">
        <div class="mb-4">
            <label>Nombre</label>
            <input type="text" wire:model="name" class="w-full border p-2 rounded">
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <div class="mb-4">
            <label>Email</label>
            <input type="email" wire:model="email" class="w-full border p-2 rounded">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div class="mb-4">
            <label>Contraseña</label>
            <input type="password" wire:model="password" class="w-full border p-2 rounded">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            {{ $userId ? 'Actualizar' : 'Guardar' }}
        </button>
    </form>
</div>
