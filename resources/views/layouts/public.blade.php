<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pokédex</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Si usas Vite -->
    @livewireStyles
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <span class="text-xl font-bold">Pokédex</span>
        <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Iniciar sesión</a>
    </nav>

    <main class="py-6">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
