<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Menampilkan daftar pesanan (Admin)
     */
    public function index()
    {
        // Mengambil semua data booking beserta info rumah dan usernya
        $bookings = Booking::with(['house', 'user'])->latest()->get();
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Menampilkan riwayat sewa milik user yang sedang login (User + Midtrans)
     */
    public function myBookings()
    {
        // 1. Ambil data sewa milik user yang login
        $bookings = Booking::where('user_id', Auth::id())
                    ->with('house')
                    ->latest()
                    ->get();

        // 2. Konfigurasi Kredensial Midtrans Sandbox
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // 3. Loop untuk generate snap_token jika status masih pending
        foreach ($bookings as $booking) {
            if ($booking->status == 'pending' && !$booking->snap_token) {
                $params = [
                    'transaction_details' => [
                        'order_id' => 'BOOK-' . $booking->id . '-' . time(),
                        'gross_amount' => (int) $booking->total_price,
                    ],
                    'customer_details' => [
                        'first_name' => $booking->user_name,
                        'phone' => $booking->user_phone,
                    ],
                ];

                try {
                    $snapToken = \Midtrans\Snap::getSnapToken($params);
                    $booking->update(['snap_token' => $snapToken]);
                } catch (\Exception $e) {
                    // Biarkan kosong jika gagal akibat kendala jaringan
                }
            }
        }

        return view('bookings.my_bookings', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
    $booking = Booking::with('house')->findOrFail($id);
    $booking->update(['status' => $request->status]);

    // Jika admin mengubah status menjadi 'confirmed' atau 'completed'
    if (in_array($request->status, ['confirmed', 'completed'])) {
        // Update rumah terkait menjadi tidak tersedia (Sudah Dihuni)
        $booking->house->update(['is_available' => false]);
    }
    // Jika admin membatalkan atau mengembalikan ke 'pending'
    elseif (in_array($request->status, ['pending', 'cancelled'])) {
        // Kembalikan rumah menjadi tersedia lagi
        $booking->house->update(['is_available' => true]);
    }

    return back()->with('message', 'Status pesanan dan ketersediaan rumah berhasil diperbarui!');
}


    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return back()->with('message', 'Pesanan berhasil dihapus!');
    }

    /**
     * Menyimpan data pemesanan ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi Input dari Form
        $request->validate([
            'house_id' => 'required|exists:houses,id',
            'user_name' => 'required|string|max:255',
            'user_phone' => 'required|string|max:20',
            'start_date' => 'required|date|after:today',
            'duration_months' => 'required|integer|min:1',
        ]);

        // 2. Ambil data rumah untuk mendapatkan harga per bulan
        $house = House::findOrFail($request->house_id);

        // 3. Hitung Total Harga (Durasi x Harga per bulan)
        $totalPrice = $request->duration_months * $house->price_per_month;

        // 4. Simpan ke Database
        Booking::create([
            'user_id' => Auth::id(),
            'house_id' => $request->house_id,
            'user_name' => $request->user_name,
            'user_phone' => $request->user_phone,
            'start_date' => $request->start_date,
            'duration_months' => $request->duration_months,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // 5. Kembalikan ke halaman sukses
        return redirect()->route('bookings.my')->with('message', 'Pesanan Anda berhasil dikirim silahkan lakukan pembayaran.');
    }
}
