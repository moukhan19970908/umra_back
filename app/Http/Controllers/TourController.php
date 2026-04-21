<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    public function getTours()
    {
        $tours = Tour::with('hotel.firstImage', 'packet')->where('start_date', '>=', date('Y-m-d'))->where('quantity', '>', 0)->get();
        return response()->json(['data' => $tours]);
    }

    public function getTourById($id)
    {
        $tour = Tour::with('hotel.images', 'packet')->find($id);
        return response()->json(['data' => $tour]);
    }

    public function bookTour(Request $request)
    {
        $request->validate([
            'passport' => 'required|file|max:10240',
            'tour_id' => 'required|integer',
            'add_first' => 'required|file|max:10240',
            'full_name' => 'required|string',
            'country_id' => 'required|integer',
            'address' => 'required|string',
            'marital_status_id' => 'required|integer',
            'profession' => 'required|string',
            'work_address' => 'required|string',
            'whatsapp_number' => 'required|string',
            'size' => 'required|integer'
        ]);
        $passport = $request->file('passport');
        $additionalFirst = $request->file('additional_first');
        $additionalSecond = $request->file('additional_second');
        $user = Auth::user();
        if ($passport && $passport->getSize() < 1) {
            return response()->json(['messages' => 'Паспорт объязателен к отправке'], 500);
        }
        $passport_path = $passport->store('uploads');
        if (!$passport_path) {
            return response()->json(['messages' => 'Попробуйте позже'], 500);
        }
        $additionalFirstPath = null;
        if ($additionalFirst && $additionalFirst->getSize() > 0) {
            $additionalFirstPath = $additionalFirst->store('uploads');
        }
        $additionalSecondPath = null;
        if ($additionalSecond && $additionalSecond->getSize() > 0) {
            $additionalSecondPath = $additionalSecond->store('uploads');
        }
        $create = Book::create([
            'tour_id' => $request->input('tour_id'),
            'user_id' => $user->id,
            'passport' => $passport_path,
            'add_first' => $additionalFirstPath,
            'add_second' => $additionalSecondPath,
            'full_name' => $request->input('full_name'),
            'country_id' => $request->input('country_id'),
            'address' => $request->input('address'),
            'marital_status_id' => $request->input('marital_status_id'),
            'profession' => $request->input('profession'),
            'work_address' => $request->input('work_address'),
            'whatsapp_number' => $request->input('whatsapp_number'),
            'size' => $request->input('size'),
        ]);
        if (!$create) {
            return response()->json(['messages' => 'Попробуйте позже']);
        }
        Tour::where('id', $request->input('tour_id'))->decrement('quantity');
        return response()->json(['success' => true]);
    }
}
