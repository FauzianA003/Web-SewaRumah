@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<!-- Hero Section -->
<div class="bg-blue-600 rounded-3xl p-12 text-center text-white mb-10 shadow-xl">
    <h1 class="text-4xl font-black mb-4">PLATFORM KATALOG MODERN</h1>
    <p class="text-blue-100 max-w-xl mx-auto italic">Solusi digital terbaik untuk manajemen data produk mahasiswa.</p>
</div>

<!-- 3 Info Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
    <div class="p-8 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
        <div class="text-4xl mb-4 text-blue-600">⚡</div>
        <h4 class="font-bold text-lg mb-2 uppercase">Performa Cepat</h4>
        <p class="text-gray-500 text-sm">Akses data instan tanpa hambatan dengan optimasi Laravel.</p>
    </div>
    <div class="p-8 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
        <div class="text-4xl mb-4 text-blue-600">🎨</div>
        <h4 class="font-bold text-lg mb-2 uppercase">Desain Modern</h4>
        <p class="text-gray-500 text-sm">Tampilan antarmuka menggunakan Tailwind CSS v4 terbaru.</p>
    </div>
    <div class="p-8 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
        <div class="text-4xl mb-4 text-blue-600">🔒</div>
        <h4 class="font-bold text-lg mb-2 uppercase">Keamanan Data</h4>
        <p class="text-gray-500 text-sm">Sistem terenkripsi untuk menjaga keamanan informasi Anda.</p>
    </div>
</div>
@endsection
