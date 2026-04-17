<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">

    <div class="max-w-md w-full bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-200">
        <div class="bg-blue-600 h-24"></div>
        <div class="px-6 pb-6">
            <div class="relative -mt-12 mb-4">
                <div class="w-24 h-24 bg-blue-100 border-4 border-white rounded-full flex items-center justify-center text-3xl font-bold text-blue-600 mx-auto">
                    {{ substr($nama, 0, 1) }}
                </div>
            </div>

            <div class="text-center border-b pb-4">
                <h1 class="text-2xl font-bold text-gray-800">{{ $nama }}</h1>
                <p class="text-blue-600 font-medium">NIM: {{ $nim }}</p>
            </div>

            <div class="mt-4 space-y-2 text-sm text-gray-600">
                <p><span class="font-semibold text-gray-800">Program Studi:</span> {{ $prodi }}</p>
                <p><span class="font-semibold text-gray-800">Semester:</span> {{ $semester }}</p>
            </div>

            <div class="mt-6">
                <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-3">Keahlian:</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($keahlian as $skill)
                        <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-semibold rounded-full border border-blue-100">
                            {{ $skill }}
                        </span>
                    @endforeach
                </div>
            </div>

            <div class="mt-8 pt-4 border-t flex justify-between text-sm">
                <a href="{{ route('katalog.index') }}" class="text-blue-600 hover:underline font-medium">Lihat Katalog →</a>
                <a href="{{ route('statis.about') }}" class="text-gray-500 hover:text-gray-800 italic">Tentang Kami</a>
            </div>
        </div>
    </div>

</body>
</html>
