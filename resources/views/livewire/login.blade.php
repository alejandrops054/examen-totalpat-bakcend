<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
    <h1 class="text-xl font-bold mb-4">Iniciar sesión</h1>

    @if ($error)
        <div class="bg-red-100 text-red-700 p-2 rounded mb-3">{{ $error }}</div>
    @endif

    <form wire:submit.prevent="login">
        <div class="mb-4">
            <label>Email</label>
            <input type="email" wire:model="email" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Contraseña</label>
            <input type="password" wire:model="password" class="w-full border p-2 rounded">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Entrar</button>
    </form>
</div>
