<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function getTours()
    {
        $tours = Tour::with('hotel.firstImage', 'packet')->where('start_date', '>=', date('Y-m-d'))->where('quantity', '>', 0)->get();
        return response()->json(['data' => $tours]);
    }

    public function getTourById($id)
    {
        $tour = Tour::with('hotel.firstImage', 'packet')->find($id);
        return response()->json(['data' => $tour]);
    }
}
