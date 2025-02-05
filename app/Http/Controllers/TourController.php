<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourRequest;
use App\Http\Requests\TourUpdateRequest;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $query = Tour::query();

        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->has('start_date')) {
            $query->where('start_date', '>=', $request->start_date);
        }

        if ($request->has('end_date')) {
            $query->where('end_date', '<=', $request->end_date);
        }

        return response()->json($query->get(), 200);
    }

    public function store(TourRequest $request)
    {
        $tourValidated = $request->validated();

        $tour = Tour::create($tourValidated);
        return response()->json($tour, 201);
    }

    public function show(Tour $tour)
    {
        return response()->json($tour, 200);
    }

    public function update(TourUpdateRequest $request, Tour $tour)
    {
        $tourValidated = $request->validated();

        $tour->update($tourValidated);
        
        return response()->json($tour, 200);
    }

    public function destroy(Tour $tour)
    {
        $tour->delete();
        return response()->json(null, 204);
    }
}
