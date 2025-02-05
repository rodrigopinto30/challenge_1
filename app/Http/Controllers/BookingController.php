<?php

namespace App\Http\Controllers;

use App\Exports\BookingsExport;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\BookingUpdateRequest;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\BookingResource;
use Maatwebsite\Excel\Facades\Excel;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::query();

        if ($request->has('start_date')) {
            $query->where('booking_date', '>=', $request->start_date);
        }

        if ($request->has('end_date')) {
            $query->where('booking_date', '<=', $request->end_date);
        }

        $bookings = $query->with(['tour', 'hotel'])->paginate(10);

        return BookingResource::collection($bookings);
    }

    public function store(BookingRequest $request)
    {
        $bookingValidated = $request->validated();

        $booking = Booking::create($bookingValidated);
        return response()->json($booking, 201);
    }

    public function show(Booking $booking): JsonResponse
    {
        return response()->json($booking, 200);
    }

    public function update(BookingUpdateRequest $request, Booking $booking): JsonResponse
    {
        $bookingValidated = $request->validated();
        $booking->update($bookingValidated);
        return response()->json($booking, 200);
    }

    public function destroy(Booking $booking): JsonResponse
    {
        $booking->delete();
        return response()->json(null, 204);
    }

    public function search(Request $request): JsonResponse {

        $search = $request->input('search');
        $booking = Booking::with(['tour', 'hotel'])
            ->search($search)
            ->paginate(5);

        return response()->json($booking);
    }

    public function export() {
        return Excel::download(new BookingsExport, 'bookings.csv');
    }
}
