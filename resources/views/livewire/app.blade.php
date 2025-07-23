<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin - Pokédex</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-blue-600 text-white p-4 flex justify-between">
        <span>Admin</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="hover:underline">Cerrar sesión</button>
        </form>
    </nav>

    <main class="p-6">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
