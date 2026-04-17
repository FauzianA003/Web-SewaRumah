@extends('layouts.app')

@section('title', '404 - Not Found')

@section('content')
<div class="text-center py-24">
    <h1 class="text-[120px] font-black text-blue-700 leading-none">404</h1>
    <p class="text-2xl font-bold text-gray-800 mt-4 uppercase tracking-widest">Halaman Tidak Ditemukan</p>
    <p class="text-gray-400 mt-4 max-w-md mx-auto mb-10 italic">Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.</p>
    <a href="{{ route('katalog.index') }}" class="inline-block bg-blue-600 text-white px-10 py-4 rounded-full font-black hover:bg-blue-800 transition shadow-xl shadow-blue-100">KEMBALI KE BERANDA</a>
</div>
@endsection
