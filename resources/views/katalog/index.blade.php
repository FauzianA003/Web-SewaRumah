@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-black text-gray-800 border-b-4 border-blue-600 pb-2">KATALOG PRODUK</h1>
    <a href="{{ route('produk.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg">+ TAMBAH</a>
</div>

{{-- Poin 5: Grid 3 Kolom Card --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    @foreach($produk as $p)
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl transition duration-300 group">
        <div class="h-48 bg-gray-50 flex items-center justify-center text-5xl group-hover:scale-110 transition">
            📦
        </div>
        <div class="p-6">
            <h3 class="text-xl font-extrabold text-gray-800">{{ $p['nama'] }}</h3>
            <p class="text-blue-600 font-black text-lg mt-2">
                Rp{{ number_format($p['harga'], 0, ',', '.') }}
            </p>

            <div class="mt-6 pt-4 border-t border-gray-50 flex justify-between items-center">
                <a href="{{ route('katalog.show', $p['id']) }}" class="text-sm font-bold text-gray-400 hover:text-blue-600 uppercase tracking-widest transition">Detail →</a>
                <button class="bg-blue-50 text-blue-600 px-4 py-2 rounded-lg font-bold hover:bg-blue-600 hover:text-white transition italic">Beli</button>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
