<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung statistik untuk kotak info admin
        $totalHouses = House::count();
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();

        // Ambil riwayat sewa terbaru khusus milik user yang sedang login
        $myRecentBookings = Booking::where('user_id', Auth::id())->with('house')->latest()->take(3)->get();

        return view('dashboard', compact('totalHouses', 'totalBookings', 'pendingBookings', 'myRecentBookings'));
    }
}
