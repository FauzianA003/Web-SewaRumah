<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan ini agar tidak merah di bagian Storage

class HouseController extends Controller
{
    // Menampilkan semua daftar rumah di halaman depan
    public function index()
    {
        // Hanya tampilkan rumah yang tersedia (is_available = true)
        $houses = House::latest()->get();
        return view('houses.index', compact('houses'));
    }

    // Menampilkan halaman form tambah rumah (Admin)
    public function create()
    {
        return view('houses.create');
    }

    // Menyimpan data rumah baru ke database
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'price_per_month' => 'required|numeric',
            'address' => 'required|string',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        // 2. Logika Upload Gambar
        if ($request->hasFile('thumbnail')) {
            // Gambar akan disimpan di folder storage/app/public/houses
            $data['thumbnail'] = $request->file('thumbnail')->store('houses', 'public');
        }

        // 3. Simpan ke database
        House::create($data);

        return redirect()->route('houses.index')->with('message', 'Rumah berhasil ditambahkan!');
    }

    // Menampilkan detail rumah saat diklik
    public function show($id)
    {
        $house = House::findOrFail($id);
        return view('houses.show', compact('house'));
    }

    // --- TAMBAHKAN FITUR EDIT & UPDATE DI SINI ---

    // Menampilkan halaman form edit rumah
    public function edit($id)
    {
        $house = House::findOrFail($id);
        return view('houses.edit', compact('house'));
    }

    // Memproses pembaruan data ke database
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price_per_month' => 'required|numeric',
            'address' => 'required|string',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $house = House::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            // Hapus foto lama jika ada di storage lokal
            if ($house->thumbnail && !filter_var($house->thumbnail, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($house->thumbnail);
            }
            // Simpan foto baru
            $data['thumbnail'] = $request->file('thumbnail')->store('houses', 'public');
        }

        $house->update($data);

        return redirect()->route('houses.index')->with('message', 'Data rumah berhasil diperbarui!');
    }

    // Tambahkan fungsi hapus di sini
    public function destroy($id)
    {
        $house = House::findOrFail($id);

        // Hapus file gambar dari storage agar tidak menumpuk
        if ($house->thumbnail && !filter_var($house->thumbnail, FILTER_VALIDATE_URL)) {
            // Kita gunakan Storage:: yang sudah di-import di atas
            Storage::disk('public')->delete($house->thumbnail);
        }

        $house->delete();

        return redirect()->route('houses.index')->with('message', 'Rumah berhasil dihapus!');
    }
}
