<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class KatalogController extends Controller {
    public function index() {
        $produk = [
            ['id' => 1, 'nama' => 'Laptop Gaming', 'harga' => 15000000],
            ['id' => 2, 'nama' => 'Mouse Wireless', 'harga' => 250000],
            ['id' => 3, 'nama' => 'Keyboard Mechanical', 'harga' => 800000],
            ['id' => 4, 'nama' => 'Monitor 24 Inch', 'harga' => 2000000],
            ['id' => 5, 'nama' => 'Headset RGB', 'harga' => 500000],
        ];
        return view('katalog.index', compact('produk'));
    }

    public function show($id) {
        return "Menampilkan Detail Produk dengan ID: " . $id;
    }
}
