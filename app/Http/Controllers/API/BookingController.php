<?php

namespace App\Http\Controllers\API;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;

class BookingController extends Controller
{
    public function index()
{
    return Booking::with('service')->where('user_id', auth('sanctum')->id())->get();
}


public function store(BookingRequest $request)
{
    if ($request->booking_date < today())
        return response()->json(['message' => 'Date must not be in past.'], 422);

    $booking = Booking::create([
        'user_id' => auth('sanctum')->id(),
        'service_id' => $request->service_id,
        'booking_date' => $request->booking_date,
    ]);

    return response()->json($booking, 201);
    }

}
