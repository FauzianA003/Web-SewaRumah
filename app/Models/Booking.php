<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    // Tambahkan 'user_id' ke dalam fi;;able
    protected $fillable = [
        'user_id', 'house_id', 'user_name', 'user_phone', 'start_date', 'duration_months', 'total_price', 'status', 'snap_token'
    ];

    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function index()
    {
    // Mengambil semua booking dan data rumah terkaitnya (Eager Loading)
    $bookings = Booking::with(['house', 'user'])->latest()->get();

    return view('bookings.index', compact('bookings'));
    }

}

