<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function myBooks(){
        $userId  = Auth::user()['id'];
        $data = Book::with('tour.packet')->where('user_id',$userId)->select('books.tour_id','books.status')->get();
        return response()->json(['data' => $data]);
    }
}
