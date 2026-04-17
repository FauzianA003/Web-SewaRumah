<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-50 flex flex-col min-h-screen">
    <nav class="bg-blue-700 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="font-black text-xl tracking-tighter">MY-STORE</a>
            <div class="space-x-6 text-sm font-bold uppercase">
                <a href="{{ route('katalog.index') }}" class="hover:text-yellow-400">Katalog</a>
                <a href="{{ route('profil.index') }}" class="hover:text-yellow-400">Profil</a>
                <a href="{{ route('statis.about') }}" class="hover:text-yellow-400">Tentang</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto flex-grow p-8">
        @yield('content')
    </main>

    <footer class="bg-blue-800 text-white p-6 text-center text-xs font-bold uppercase tracking-widest">
        &copy; 2026 M. Fauzian Afshor | 4124033
    </footer>
</body>
</html>
