<?php

namespace App\Http\Controllers\API;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;

class AdminController extends Controller
{
    public function store(ServiceRequest $request)
{
    return Service::create($request->validated());
}

public function update(ServiceRequest $request, $id)
{
    $service = Service::findOrFail($id);
    $service->update($request->validated());
    return $service;
}

public function destroy($id)
{
    Service::findOrFail($id)->delete();
    return response()->json(['message' => 'Deleted']);
}

public function bookings()
{
    return Booking::with(['user', 'service'])->get();
}
//
}
