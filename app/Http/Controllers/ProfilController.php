<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ProfilController extends Controller {
    public function index() {
        $data = [
            'nama' => 'M. Fauzian Afshor',
            'nim' => '4124033',
            'prodi' => 'Sistem Informasi',
            'semester' => 4,
            'keahlian' => ['PHP', 'Laravel', 'HTML', 'CSS', 'JavaScript']
        ];
        return view('katalog.profil', $data);
    }
    public function show($nim) {
        return "Menampilkan Detail Profil untuk NIM: " . $nim;
    }
}
