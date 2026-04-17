@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="max-w-lg mx-auto bg-white p-10 rounded-3xl shadow-lg border border-gray-100">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-4">Tambah Produk Baru</h2>
    <form>
        <div class="mb-5">
            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Nama Produk</label>
            <input type="text" placeholder="Contoh: Laptop Asus" class="w-full p-4 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition">
        </div>
        <div class="mb-8">
            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Harga Satuan (Rp)</label>
            <input type="number" placeholder="Contoh: 5000000" class="w-full p-4 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition">
        </div>
        <div class="flex gap-4">
            <a href="{{ route('katalog.index') }}" class="w-1/3 text-center py-4 text-gray-500 font-bold hover:text-gray-800 transition">Batal</a>
            <button type="button" class="w-2/3 bg-blue-600 text-white py-4 rounded-2xl font-black shadow-lg shadow-blue-200 hover:bg-blue-700 transition uppercase">Simpan Produk</button>
        </div>
    </form>
</div>
@endsection
